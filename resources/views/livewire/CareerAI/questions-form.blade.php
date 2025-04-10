@push('styles')
<link rel="stylesheet" href="{{asset('careerAI-css/questions-form.css')}}">
@endpush
<div>
    <div x-data="jobDesc()" class="min-h-screen flex flex-col justify-between">
        <!-- Page Content -->
        <div class="form-container">
            <h3 class="text-end mb-4">ارفع سيرتك الذاتية وأدخل المسمى الوظيفي</h3>

            <!-- Use Alpine bindings and events -->
            <form @submit.prevent="saveData">
                <!-- CV File -->
                <div class="mb-3">
                    <label class="form-label">ارفع سيرتك الذاتية (PDF أو DOCX):</label>
                    <input type="file" class="form-control" title="ارفع سيرتك الذاتية" @change="validateFile">
                    <div x-text="errors.cv" class="text-danger"></div>
                </div>

                <!-- Job Title -->
                <div class="mb-3">
                    <label class="form-label">المسمى الوظيفي المطلوب:</label>
                    <input type="text" class="form-control" placeholder="مثلاً: مهندس برمجيات" x-model="jobTitle">
                    <div x-text="errors.title" class="text-danger"></div>
                </div>

                <!-- Job Description (Generated) -->
                <div class="mb-4">
                    <label class="form-label">وصف الوظيفة:</label>
                    <button type="button" class="btn btn-dark w-100 mb-3" @click="generateDescription"
                        :disabled="isLoading">
                        <!-- Non-loading state -->
                        <span x-show="!isLoading">
                            <i class="fas fa-file-alt"></i>انشاء وصف الوظيفة
                        </span>

                        <!-- Loading state -->
                        <span x-show="isLoading">
                            <i class="fa-solid fa-hourglass-end"></i>
                            جاري التوليد...
                        </span>
                    </button>

                    <textarea class="form-control" rows="4" placeholder="مثلاً: مسؤول عن تطوير التطبيقات البرمجية"
                        x-model="jobDescription"></textarea>
                    <div x-text="errors.desc" class="text-danger"></div>
                </div>

                <!-- Generate Description Button -->

                <!-- Submit (Save) Button -->
                <button type="submit" class="btn btn-primary w-100">
                    الانتقال إلى الخطوة التالية
                </button>
            </form>
        </div>

        <!-- Footer -->
        <footer class="footer bg-dark text-light mt-auto">
            <div class="container-fluid">
                <p>© 2025 Falcons. جميع الحقوق محفوظة.</p>
                <p>صُمم لمساعدتك على النجاح في حياتك المهنية.</p>
            </div>
        </footer>
    </div>

    <!-- Alpine.js Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('jobDesc', () => ({
                API_KEY: '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',
                MODEL: 'deepseek/deepseek-r1:free',

                jobTitle: '',
                jobDescription: '',
                isLoading: false,
                errors: {
                    cv: null,
                    title: null,
                    desc: null
                },

                promptTemplate(jobTitle) {
                    return `أنشئ وصفًا وظيفيًا بالعربية للوظيفة: "${jobTitle}":━━━━━━━━━━━━━━━━━━━━━━━
🎯 المهام الأساسية
━━━━━━━━━━━━━━━━━━━━━━━
• تنفيذ [المهام التشغيلية اليومية]
• تطوير [النقاط الرئيسية للتحسين]
• تنسيق [نوع التعاون مع الفرق]

━━━━━━━━━━━━━━━━━━━━━━━
💻 المتطلبات التقنية
━━━━━━━━━━━━━━━━━━━━━━━
🔹 تقنيات متقدمة:
🔹 أساسيات ضرورية:

━━━━━━━━━━━━━━━━━━━━━━━
🤝 المهارات الشخصية
━━━━━━━━━━━━━━━━━━━━━━━
◉ إدارة الاجتماعات الفعّالة
◉ قيادة فريق مكون من [عدد]+ أعضاء
◉ حل النزاعات خلال [إطار زمني]

━━━━━━━━━━━━━━━━━━━━━━━
📜 المؤهلات والشروط
━━━━━━━━━━━━━━━━━━━━━━━
✔ بكالوريوس في [التخصص الدقيق]
✔ خبرة [عدد] سنوات في [مجال الخبرة]
✔ شهادة [اسم الشهانة] (اختياري)

━━━━━━━━━━━━━━━━━━━━━━━
✨ ملاحظات هامة
━━━━━━━━━━━━━━━━━━━━━━━
❶ استخدم أفعال مثل: يُحلِّل، يُنفِّذ، يُطوِّر
❷ تجنب المصطلحات العامة
❸ ركز على الأدوات المستخدمة فعليًا بالمجال
◆ إذا كانت الوظيفة غير معروفة، اطلب من المستخدم توضيحها بدلاً من إنشاء وصف عام`;
                },

                // Generate Job Description from API
                async generateDescription() {
                    this.clearErrors();

                    if (!this.jobTitle) {
                        this.errors.title = 'يرجى إدخال اسم الوظيفة أولاً';
                        return;
                    }

                    try {
                        this.isLoading = true;
                        const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
                            method: 'POST',
                            headers: {
                                'Authorization': `Bearer ${this.API_KEY}`,
                                'Content-Type': 'application/json',
                                'HTTP-Referer': window.location.href,
                                'X-Title': 'Job Description Generator'
                            },
                            body: JSON.stringify({
                                model: this.MODEL,
                                messages: [
                                    { role: 'user', content: this.promptTemplate(this.jobTitle) }
                                ]
                            })
                        });

                        const data = await response.json();
                        console.log(data);
                        const generatedText = data.choices?.[0]?.message?.content || '';
                        if (this.isUnknownJob(generatedText)) {
                            this.errors.desc = 'عذرًا، لم نتمكن من التعرف على هذه الوظيفة. يرجى إدخال اسم وظيفة أوضح أو تقديم المزيد من التفاصيل.';
                            this.jobDescription = '';
                        } else {
                            this.jobDescription = generatedText;
                        }
                        console.log(this.jobDescription);
                    }
                    catch (error) {
                        this.errors.desc = `خطأ في التوليد: ${error.message}`;
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Basic check if the API returned an "unknown" job
                isUnknownJob(text) {
                    const unknownIndicators = [
                        /\[.*?\]/g, // اكتشاف الأقواس الفارغة
                        /\.\.\./g,  // اكتشاف النقاط المتتالية
                        /غير معروف/gi,
                        /يرجى توضيح/gi,
                        /المهام التشغيلية اليومية/g
                    ];
                    return unknownIndicators.some(pattern => pattern.test(text));
                },

                // Validate File Input
                validateFile(e) {
                    const file = e.target.files[0];
                    this.errors.cv = null;

                    if (!file) return;

                    const validTypes = [
                        'application/pdf',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!validTypes.includes(file.type)) {
                        this.errors.cv = 'نوع الملف غير مدعوم';
                        e.target.value = '';
                    } else if (file.size > maxSize) {
                        this.errors.cv = 'الحجم الأقصى 2MB';
                        e.target.value = '';
                    }
                },

                // Save data to localStorage and go to next page
                saveData() {
                    this.clearErrors();

                    if (!this.jobTitle || !this.jobDescription) {
                        alert('يرجى إكمال جميع الحقول المطلوبة');
                        return;
                    }

                    // Store data in localStorage
                    localStorage.setItem('jobData', JSON.stringify({
                        title: this.jobTitle,
                        description: this.jobDescription
                    }));

                    // Navigate to the next page
                    window.location.href = 'http://127.0.0.1:8000/generateQuestines';
                },

                clearErrors() {
                    this.errors = { cv: null, title: null, desc: null };
                }
            }));
        });
    </script>
</div>
