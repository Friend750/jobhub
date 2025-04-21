@push('styles')
    <link rel="stylesheet" href="{{ asset('careerAI-css/uplaod-job-profile.css') }}">
@endpush
<div>
    <div x-data="jobDesc()" x-init="watchJobDescription" class="col-12"
        style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    ">
        <!-- Page Content -->
        <div class="form-container container col-8 bg-white">
            <h5 class="text-center mb-5">ارفع سيرتك الذاتية وأدخل المسمى الوظيفي</h5>

            <!-- Use Alpine bindings and events -->
            <form @submit.prevent="saveData" class="row g-3">

                <div class="col-md-6">
                    <!-- Right Column - Other Form Elements -->
                    <div class="card border-0 h-100 shadow-sm">
                        <div class="card-body">



                            <!-- Job Title Search Input -->
                            <div class="mb-3">
                                <label class="form-label">المسمى الوظيفي المطلوب:</label>
                                <input type="text" class="form-control" placeholder="مثلاً: مهندس برمجيات"
                                    x-model="jobTitleQuery" @click="showList = true">
                                <div x-text="errors.title" class="text-danger"></div>
                            </div>
                            <div class="position-relative">
                                <!-- Filtered Job Titles List -->
                                <div class="parent position-absolute bg-light w-100 p-3 rounded-3 shadow z-3 ps-0"
                                    x-show="showList" x-cloak @click.away="showList = false">
                                    <ul class="list-unstyled rounded-3 card-control pe-0 mb-0">
                                        <template x-for="position in filteredPositions" :key="position.id">
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

                            <!-- From Uiverse.io by Yaya12085 -->
                            <label class="custum-file-upload w-100" for="cvInput">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill=""
                                                d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="text">
                                    <span>ارفع سيرتك الذاتية (PDF)</span>
                                </div>
                                <input id="cvInput" type="file" title="ارفع سيرتك الذاتية" @change="validateFile">
                                <div x-text="errors.cv" class="text-danger"></div>
                            </label>


                            <!-- CV File -->
                            {{-- <div class="mb-3">
                                <label class="form-label">ارفع سيرتك الذاتية (PDF):</label>
                                <input id="cvInput" type="file" class="form-control" title="ارفع سيرتك الذاتية"
                                    @change="validateFile">
                                <div x-text="errors.cv" class="text-danger"></div>
                            </div> --}}









                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Left Column - Job Description -->
                    <div class="card border-0 h-100 shadow-sm">
                        <div class="p-3 pb-1">
                            <h5 class="mb-0">وصف الوظيفة (افتراضي وقابل للتعديل)</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control h-100" rows="8" placeholder="سيتم ملئه تلقائيا بعد عملية اختيار المسمى الوظيفي.."
                                x-model="jobDescription" x-init="autoResize($el)" x-on:input="autoResize($el)"
                                style="resize: none; min-height: 50vh;"></textarea>
                            <div x-text="errors.desc" class="text-danger mt-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button - Full Width Below Both Columns -->
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-dark w-100 button rounded"
                        :class="isLoading === false ? ' ' : ''">
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
                </div>
            </form>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

    <!-- Alpine.js Logic -->
    <script>
        window.env = {
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
                validateFile(e) {
                    const file = e.target.files[0];
                    this.errors.cv = null;

                    if (!file) return;

                    const validTypes = [
                        'application/pdf',
                    ];
                    const maxSize = 2 * 1024 * 1024

                    if (!validTypes.includes(file.type)) {
                        this.errors.cv = 'نوع الملف غير مدعوم';
                        e.target.value = '';
                    } else if (file.size > maxSize) {
                        this.errors.cv = 'الحجم الأقصى 2MB';
                        e.target.value = '';
                    }
                },
                async analyzeCV() {
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
                        const response = await fetch(
                            'https://openrouter.ai/api/v1/chat/completions', {
                                method: 'POST',
                                headers: {
                                    'Authorization': `Bearer ${this.API_KEY}`,
                                    'Content-Type': 'application/json' // تأكد من تحديد نوع البيانات
                                },
                                body: JSON.stringify({
                                    model: this.MODEL,
                                    messages: [{
                                        role: "user",
                                        content: prompt
                                    }], // البيانات المناسبة
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

                },

                async extractTextFromPDF(file) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();

                        reader.onload = async function() {
                            try {
                                const pdfData = new Uint8Array(reader.result);
                                const pdf = await pdfjsLib.getDocument({
                                    data: pdfData
                                }).promise;
                                let text = "";

                                for (let i = 1; i <= pdf.numPages; i++) {
                                    const page = await pdf.getPage(i);
                                    const content = await page.getTextContent();
                                    text += content.items.map(item => item.str)
                                        .join(" ") + "\n";
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

                        if (this.cvAnalysis && this.cvAnalysis.choices && this.cvAnalysis.choices[0]
                            .message.content) {
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
                    this.errors = {
                        cv: null,
                        title: null,
                        desc: null
                    };
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



            }));
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
