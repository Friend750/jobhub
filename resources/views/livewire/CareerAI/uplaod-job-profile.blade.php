@push('styles')
    <link rel="stylesheet" href="{{ asset('careerAI-css/uplaod-job-profile.css') }}">
@endpush
<div>
    <div x-data="jobDesc()" x-init="watchJobDescription" class="col-12 centerd">
        <!-- Page Content -->
        <div class="form-container container bg-white">
            <h5 class="text-center mb-5">ارفع سيرتك الذاتية وأدخل المسمى الوظيفي</h5>

            <!-- Use Alpine bindings and events -->
            <form @submit.prevent="saveData" class="row g-3">

                <div class="col-md-6">
                    <div class="card border-0 h-100 shadow-sm">
                        <div class="card-body">
                            @include('livewire.CareerAI.shared.search')
                            @include('livewire.CareerAI.shared.file-uplaod')
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    @include('livewire.CareerAI.shared.job-description')
                </div>

                <!-- Submit Button - Full Width Below Both Columns -->
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-dark w-100 button rounded"
                        x-bind:disabled="isLoading === true">
                        <div x-show="isLoading === true" x-cloak>
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                يتم تحليل البيانات ثواني من فضلك...
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

                uploadedFileName: '',
                filePreview: null,
                uploadedFileSize: '',
                fileDetails: {
                    name: '',
                    size: '',
                    type: ''
                },


                uploadState: 'idle', // 'idle', 'uploading', 'success', 'error'


                errors: {
                    cv: null,
                    title: null,
                    desc: null
                },

                // Validate File Input
                async validateFile(e) {
                    const file = e.target.files[0];
                    // Reset states
                    this.errors.cv = null;
                    this.filePreview = null;

                    if (!file) {
                        this.uploadState = 'idle';
                        return;
                    }

                    // Set file details
                    this.fileDetails = {
                        name: file.name,
                        size: this.formatFileSize(file.size),
                        type: file.type
                    };

                    // Generate preview if image
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => this.filePreview = e.target.result;
                        reader.readAsDataURL(file);
                    }

                    // // Simulate upload process with different states
                    this.uploadState = 'uploading';
                    await this.delay(1000);

                    // this.uploadState = 'Analyzing';
                    // await this.delay(1500);

                    // this.uploadState = 'Extracting';
                    // await this.delay(1000);

                    // Validate file
                    const validTypes = ['application/pdf'];
                    const maxSize = 2 * 1024 * 1024;

                    if (!validTypes.includes(file.type)) {
                        this.errors.cv = 'نوع الملف غير مدعوم';
                        e.target.value = '';
                        this.uploadState = 'error';
                    } else if (file.size > maxSize) {
                        this.errors.cv = 'الحجم الأقصى 2MB';
                        e.target.value = '';
                        this.uploadState = 'error';
                    } else {
                        this.uploadState = 'success';
                        this.uploadedFileName = file.name;
                        this.uploadedFileSize = this.formatFileSize(file.size);
                    }
                },

                formatFileSize(bytes) {
                    if (bytes === 0)
                        return '0 Bytes';

                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
                },

                delay(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                },

                retryUpload() {
                    this.uploadState = 'idle';
                    this.errors.cv = null;
                },

                async analyzeCV() {
                    const fileInput = document.getElementById('cvInput');
                    const file = fileInput ? fileInput.files[0] : null;
                    this.errors.cv = null;
                    this.uploadState = 'Analyzing';
                    this.isLoading = true;
                    console.log(this.uploadState);


                    try {
                        const exFile = await this.extractTextFromPDF(file);

                        if (!file) {
                            this.errors.cv = 'يرجى تحميل ملف السيرة الذاتية بصيغة PDF';
                            this.uploadState = 'error';
                            console.log(this.uploadState);

                            return;
                        }

                        this.uploadedFileName = file.name; // Set filename here too
                        console.log(this.uploadedFileName);

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


                        const response = await fetch(
                            'https://openrouter.ai/api/v1/chat/completions', {
                                method: 'POST',
                                headers: {
                                    'Authorization': `Bearer ${this.API_KEY}`,
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    model: this.MODEL,
                                    messages: [{
                                        role: "user",
                                        content: prompt
                                    }],
                                    temperature: 0.7
                                })
                            });

                        const data = await response.json();
                        this.cvAnalysis = data;
                        this.uploadState = 'successfully-analyzed';
                        console.log(this.uploadState);


                    } catch (error) {
                        console.error(error);
                        this.errors.cv = 'يرجى التأكد من رفع الملف';
                        this.uploadState = 'error';
                        console.log(this.uploadState);

                    }
                },

                async extractTextFromPDF(file) {
                    this.uploadState = 'Extracting';
                    console.log(this.uploadState);

                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();

                        reader.onload = async function() {
                            try {
                                const pdfData = new Uint8Array(reader
                                    .result);
                                const pdf = await pdfjsLib.getDocument({
                                    data: pdfData
                                }).promise;
                                let text = "";

                                for (let i = 1; i <= pdf
                                    .numPages; i++) {
                                    const page = await pdf.getPage(i);
                                    const content = await page
                                        .getTextContent();
                                    text += content.items.map(item =>
                                            item
                                            .str)
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
                            cv: null,
                        };
                        console.log(jobData);

                        localStorage.setItem('jobData', JSON.stringify(jobData));

                        // ابدأ تحليل السيرة الذاتية
                        await this.analyzeCV(); // انتظر اكتمال التحليل

                        if (this.cvAnalysis && this.cvAnalysis.choices && this
                            .cvAnalysis
                            .choices[0]
                            .message.content) {
                            // استرجاع البيانات من localStorage لتحديثها
                            let updatedJobData = JSON.parse(localStorage.getItem(
                                'jobData')) || {};
                            updatedJobData.cv = this.cvAnalysis.choices[0].message
                                .content;
                            localStorage.setItem('jobData', JSON.stringify(
                                updatedJobData));
                        }

                        // انتقل بعد تحديث localStorage
                        if (!this.errors.cv) {
                            window.location.href =
                                'http://127.0.0.1:8000/interview_type';
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
                        position.name.toLowerCase().includes(this.jobTitleQuery
                            .toLowerCase())
                    );
                },

                selectPosition(position) {
                    this.selectedPosition = position;
                    this.jobDescription = position.default_description;
                    this.jobTitle = position.name;
                    this.jobTitleQuery = position.name; // Update input field with selected job title
                    this.showList = false; // Hide the list after selection
                },

                handleJobTitleBlur() {
                    if (!this.selectedPosition || this.jobTitle === '') {
                        this.jobTitle = this.jobTitleQuery;
                    }
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
