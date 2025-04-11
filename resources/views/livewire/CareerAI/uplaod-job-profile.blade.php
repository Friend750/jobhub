@push('styles')
<link rel="stylesheet" href="{{asset('careerAI-css/uplaod-job-profile.css')}}">
@endpush
<div>
    <div x-data="jobDesc()" x-init="watchJobDescription" class="flex flex-col justify-between">
        <!-- Page Content -->
        <div class="form-container col-4">
            <h5 class="text-end mb-4">ارفع سيرتك الذاتية وأدخل المسمى الوظيفي</h5>

            <!-- Use Alpine bindings and events -->
            <form @submit.prevent="saveData">
                <!-- CV File -->
                <div class="mb-3">
                    <label class="form-label">ارفع سيرتك الذاتية (PDF):</label>
                    <input id="cvInput" type="file" class="form-control" title="ارفع سيرتك الذاتية"
                        @change="validateFile">
                    <div x-text="errors.cv" class="text-danger"></div>
                </div>

                <!-- Job Title Search Input -->
                <div class="mb-3">
                    <label class="form-label">المسمى الوظيفي المطلوب:</label>
                    <input type="text" class="form-control" placeholder="مثلاً: مهندس برمجيات" x-model="jobTitleQuery"
                        @click="showList = true">
                    <div x-text="errors.title" class="text-danger"></div>
                </div>

                <div class="position-relative">
                    <!-- Filtered Job Titles List -->
                    <div class="parent position-absolute bg-light w-100 p-3 rounded-3 shadow z-3" x-show="showList"
                        x-cloak @click.away="showList = false">
                        <ul class="list-unstyled rounded-3 card-control">
                            <template x-for="position in filteredPositions" :key="position . id">
                                <li class="w-100 text-end p-2 pointer" @click="selectPosition(position)">
                                    <span x-text="position.name"></span>
                                </li>
                            </template>
                            <template x-if="filteredPositions.length === 0">
                                <li class="p-2 text-muted text-end">No job titles found.</li>
                            </template>
                        </ul>
                    </div>
                </div>

                <!-- Job Description (Generated) -->
                <div class="mb-4">
                    <label class="form-label">وصف الوظيفة (افتراضي وقابل للتعديل):</label>
                    <textarea class="form-control" rows="4" placeholder="مثلاً: مسؤول عن تطوير التطبيقات البرمجية"
                        x-model="jobDescription" x-init="autoResize($el)" x-on:input="autoResize($el)"
                        style="resize: none; overflow: hidden; max-height: 400px;"></textarea>
                    <div x-text="errors.desc" class="text-danger"></div>
                </div>

                <!-- Submit (Save) Button -->
                <button type="submit" class="btn btn-dark w-100 button" :class="isLoading === false ? ' ' : ''">
                    <div x-show="isLoading === true" x-cloak>
                        <div class="d-flex gap-2 align-items-center justify-content-center">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            يتم تحليل البيانات ثواني من فضلك...
                            <span class="gradient-container">
                                <span class="gradient"></span>
                            </span>
                        </div>
                    </div>
                    <span x-show="isLoading === false" x-cloak>
                        متابعة
                    </span>
                </button>


            </form>

        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

    <!-- Alpine.js Logic -->
    <script>
        window.env =
        {
            API_KEY: "{{ env('API_KEY') }}",
            MODEL: "{{ env('MODEL') }}"
        };
        document.addEventListener('alpine:init', () => {

            Alpine.data('jobDesc', () => ({

                API_KEY: window.env.API_KEY,
                MODEL: window.env.MODEL,
                jobTitle: '',
                jobDescription: '',
                cvAnalysis: null,
                isLoading: false,
                errors: {
                    cv: null,
                    title: null,
                    desc: null
                },

                // Validate File Input
                validateFile(e)
                {
                    const file = e.target.files[0];
                    this.errors.cv = null;

                    if (!file) return;

                    const validTypes =
                        [
                            'application/pdf',
                        ];
                    const maxSize = 2 * 1024 * 1024

                    if (!validTypes.includes(file.type))
                    {
                        this.errors.cv = 'نوع الملف غير مدعوم';
                        e.target.value = '';
                    }
                    else if (file.size > maxSize)
                    {
                        this.errors.cv = 'الحجم الأقصى 2MB';
                        e.target.value = '';
                    }
                },
                async analyzeCV()
                {
                    const fileInput = document.getElementById('cvInput');
                    const file = fileInput ? fileInput.files[0] : null;
                    this.errors.cv = null;

                    const exFile = await this.extractTextFromPDF(file);
                    // التحقق من وجود الملف
                    if (!file) {
                        this.errors.cv = 'يرجى تحميل ملف السيرة الذاتية بصيغة PDF';
                        return;
                    }

                    const prompt = `
قم بتحليل السيرة الذاتية المرفقة بالملف، وقم بتقييم الجوانب التالية بنسبة من 0 إلى 100:
1. مدى توافق السيرة الذاتية مع نظام ATS، مع تقديم نصائح لتحسينها.
2. مدى تطابق الخبرات الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
3. مدى تطابق التعليم الموجود في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
4. مدى تطابق المهارات الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
5. مدى تطابق المشاريع الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
6. مدى تطابق الشهادات الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
7. مدى تطابق الملخص المهني الموجود في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.

السيرة الذاتية:
${exFile}
---
العنوان الوظيفي: ${this.jobTitle}
الوصف الوظيفي: ${this.jobDescription}

يرجى تقديم النتيجة باللغة العربية بالكامل وبصيغة JSON كما يلي:
\\boxed{
{
  "ATS": { "score": <الدرجة>, "recom": "<النصائح>" },
  "Work Experience": { "score": <الدرجة>, "recom": "<النصائح>" },
  "Education": { "score": <الدرجة>, "recom": "<النصائح>" },
  "Skills": { "score": <الدرجة>, "recom": "<النصائح>" },
  "Projects": { "score": <الدرجة>, "recom": "<النصائح>" },
  "Certifications": { "score": <الدرجة>, "recom": "<النصائح>" },
  "Professional Summary": { "score": <الدرجة>, "recom": "<النصائح>" }
}
                }
يرجى التأكد من استخدام أسماء المفاتيح المذكورة أعلاه دون أي تغيير أو إضافة مفاتيح جديدة.
`;


                    this.isLoading = true;

                    try {
                        const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
                            method: 'POST',
                            headers: {
                                'Authorization': `Bearer ${this.API_KEY}`,
                                'Content-Type': 'application/json' // تأكد من تحديد نوع البيانات
                            },
                            body: JSON.stringify({
                                model: this.MODEL,
                                messages: [{ role: "user", content: prompt }], // البيانات المناسبة
                                temperature: 0.7
                            })
                        });

                        const data = await response.json();
                        this.cvAnalysis = data;

                    } catch (error) {
                        console.error(error);
                        this.errors.cv = 'حدث خطأ أثناء تحليل السيرة الذاتية';
                    } finally {
                        this.isLoading = false;
                    }

                }
                ,

                async extractTextFromPDF(file) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();

                        reader.onload = async function () {
                            try {
                                const pdfData = new Uint8Array(reader.result);
                                const pdf = await pdfjsLib.getDocument({ data: pdfData }).promise;
                                let text = "";

                                for (let i = 1; i <= pdf.numPages; i++) {
                                    const page = await pdf.getPage(i);
                                    const content = await page.getTextContent();
                                    text += content.items.map(item => item.str).join(" ") + "\n";
                                }

                                resolve(text);
                            } catch (error) {
                                reject(error);
                            }
                        };

                        reader.onerror = reject;
                        reader.readAsArrayBuffer(file);
                    });
                },
                async saveData() {
                    this.clearErrors();

                    if (!this.jobTitle || !this.jobDescription || !this.analyzeCV) {
                        this.errors.cv = 'رفع ملف مطلوب';
                        this.errors.title = 'اسم الوظيفة مطلوب';
                        this.errors.desc = 'وصف الوظيفة مطلوب';
                        return;
                    }

                    let jobData = {
                        title: this.jobTitle,
                        description: this.jobDescription,
                        cv: null, // سيتم تحديثه لاحقًا
                    };

                    localStorage.setItem('jobData', JSON.stringify(jobData));

                    // ابدأ تحليل السيرة الذاتية
                    await this.analyzeCV(); // انتظر اكتمال التحليل

                    if (this.cvAnalysis && this.cvAnalysis.choices && this.cvAnalysis.choices[0].message.content) {
                        // استرجاع البيانات من localStorage لتحديثها
                        let updatedJobData = JSON.parse(localStorage.getItem('jobData')) || {};
                        updatedJobData.cv = this.cvAnalysis.choices[0].message.content;
                        localStorage.setItem('jobData', JSON.stringify(updatedJobData));
                    }

                    // انتقل بعد تحديث localStorage
                    if (!this.errors.cv) {
                        window.location.href = 'http://127.0.0.1:8000/interview_type';
                    }
                }


                ,

                clearErrors() {
                    this.errors = { cv: null, title: null, desc: null };
                },


                // job title functions
                positions: @json($positions),
                jobTitleQuery: '',
                showList: false,
                selectedPosition: null,

                get filteredPositions() {

                    return this.positions.filter(position =>
                        position.name.toLowerCase().includes(this.jobTitleQuery.toLowerCase())
                    );
                },

                selectPosition(position) {
                    this.selectedPosition = position;
                    this.jobDescription = position.default_description;
                    this.jobTitle = position.name;
                    this.jobTitleQuery = position.name; // Update input field with selected job title
                    this.showList = false; // Hide the list after selection
                },



            }
            )
            );
        });
    </script>

    <script>
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = `${textarea.scrollHeight}px`;
            if (textarea.scrollHeight > 400) {
                textarea.style.overflowY = 'auto';
            } else {
                textarea.style.overflowY = 'hidden';
            }
        }

        function watchJobDescription() {
            this.$watch('jobDescription', (value) => {
                const textarea = this.$el.querySelector('textarea');
                autoResize(textarea);
            });
        }
    </script>

</div>
