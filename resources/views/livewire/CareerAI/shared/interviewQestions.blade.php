<style>
    .overall-rating {
        min-width: 200px;
        padding: 15px;
        border-radius: 10px;
    }

    .ai-notes li {
        padding-right: 1.5rem;
        position: relative;
    }

    .ai-notes li:before {
        position: absolute;
        right: -1.2rem;
    }

    .highlight {
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    circle {
        transition: stroke-dashoffset 0.5s ease, stroke 0.3s ease;
    }
</style>
</head>

<body>
    <div x-data="interviewReport()" class="container py-5">
        <!-- التنقل بين الأسئلة -->
        <div class="card shadow-sm p-4 rounded-4 mb-4">
            <h5 class="fw-bold mb-2">السؤال <span x-text="currentQuestionIndex + 1"></span>:
                <span x-text="questions[currentQuestionIndex].text"></span>
            </h5>

            <p class="p-0">
                <span class="fw-bold">إجابتك:</span>
                <span x-text="questions[currentQuestionIndex].answer"></span>
            </p>

            <div class="text-start mt-3">
                <button class="btn btn-dark rounded-3 me-2" @click="previousQuestion" x-show="currentQuestionIndex > 0">
                    <i class="bi bi-chevron-right"></i>
                </button>
                <button class="btn btn-dark rounded-3" @click="nextQuestion"
                    x-show="currentQuestionIndex < questions.length - 1">
                    السؤال التالي<i class="bi bi-chevron-left me-2"></i>
                </button>
            </div>
        </div>

        <!-- التقييم العام -->
        <div class="card shadow-sm p-4 rounded-4 mb-4 highlight">
            <div class="d-flex gap-4 align-items-start">
                <div class="overall-rating">
                    <h5 class="fw-bold mb-2 text-muted"><i class="bi bi-stars"></i> تقييم الإجابة:</h5>
                    <div class="d-flex align-items-center gap-2">
                        <svg width="50" height="50" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" stroke="#eee" stroke-width="8" fill="none" />
                            <circle cx="50" cy="50" r="40"
                                :stroke="getRatingColor(questions[currentQuestionIndex].rating)" stroke-width="8"
                                fill="none" stroke-dasharray="251.2"
                                :stroke-dashoffset="251.2 - (questions[currentQuestionIndex].rating * 251.2 / 10)" />
                        </svg>
                        <div>
                            <span class="fw-bold fs-4 d-block"
                                x-text="`${questions[currentQuestionIndex].rating.toFixed(1)}/10`"></span>

                        </div>
                    </div>
                </div>

                <!-- ملاحظات الذكاء الاصطناعي -->
                <div class="ai-notes flex-grow-1">
                    <template x-if="questions[currentQuestionIndex].strengths.length">
                        <div class="mb-3">
                            <h6 class="text-dark fw-bold"><i class="bi bi-check-circle"></i> نقاط القوة:</h6>
                            <ul class="list-unstyled">
                                <template x-for="strength in questions[currentQuestionIndex].strengths">
                                    <li class="mb-2">✓ <span x-text="strength"></span></li>
                                </template>
                            </ul>
                        </div>
                    </template>

                    <template x-if="questions[currentQuestionIndex].weaknesses.length">
                        <div class="mb-3">
                            <h6 class="text-dark fw-bold"><i class="bi bi-exclamation-circle"></i> نقاط الضعف:</h6>
                            <ul class="list-unstyled">
                                <template x-for="weakness in questions[currentQuestionIndex].weaknesses">
                                    <li class="mb-2"> • <span x-text="weakness"></span></li>
                                </template>
                            </ul>
                        </div>
                    </template>

                    <template x-if="questions[currentQuestionIndex].improvements.length">
                        <div>
                            <h6 class="text-dark fw-bold"><i class="bi bi-lightbulb"></i> تحسينات مقترحة:</h6>
                            <ul class="list-unstyled">
                                <template x-for="improvement in questions[currentQuestionIndex].improvements">
                                    <li class="mb-2"> • <span x-text="improvement"></span></li>
                                </template>
                            </ul>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
    Alpine.data('interviewReport', () => ({
        // البيانات الأولية
        questions: [],
        currentQuestionIndex: 0,

        // تهيئة المكون
        init() {
            this.loadInitialData();
            this.loadReportData();
        },

        // تحميل الأسئلة من sessionStorage
        loadInitialData() {
            const savedAnswers = JSON.parse(sessionStorage.getItem('answers')) || [];
            this.questions = savedAnswers.map(answer => ({
                text: answer.question,
                answer: answer.answer,
                rating: 0,
                ratingDescription: 'جاري التحليل...',
                strengths: [],
                weaknesses: [],
                improvements: []
            }));
        },

        // تحميل التقرير من sessionStorage
        loadReportData() {
            try {
                const rawReport = sessionStorage.getItem('report') || '{}';

                // 1. إزالة \boxed{ و }
                const cleanedReport = rawReport
                    .replace(/^\s*\\boxed\{\s*\{/, '{') // إزالة \boxed{ في البداية
                    .replace(/\}\s*\}\s*$/, '}'); // إزالة } في النهاية

                // 2. تنظيف النص من الرموز غير المرغوبة (إن وجدت)
                const finalReport = cleanedReport
                    .replace(/\\n/g, '') // إزالة \n
                    .replace(/\\"/g, '"') // استبدال \" بـ "
                    .trim(); // إزالة المسافات الزائدة

                // 3. تحويل النص إلى كائن JSON
                const report = JSON.parse(finalReport);

                // 4. تحميل البيانات إلى الأسئلة
                this.questions = this.questions.map(question => {
                    const analysis = report.analysis.find(item =>
                        item.question === question.text
                    );

                    return {
                        ...question,
                        rating: report.analysis[this.currentQuestionIndex]?.report?.score || 0,
                        ratingDescription: this.generateRatingDescription(report.analysis[this.currentQuestionIndex]?.report?.score),
                        strengths: report.analysis[this.currentQuestionIndex]?.report?.strengths || [],
                        weaknesses: report.analysis[this.currentQuestionIndex]?.report?.weaknesses || [],
                        improvements: report.analysis[this.currentQuestionIndex]?.report?.improvements || []
                    };
                });
            } catch (error) {
                console.error('Error loading report:', error);
                alert('حدث خطأ في تحميل التقرير');
            }
        },

        // توليد وصف التقييم
        generateRatingDescription(score) {
            if (score >= 9) return 'أداء متميز 🏆';
            if (score >= 7) return 'جيد مع إمكانية التحسين 👍';
            if (score >= 5) return 'مقبول يحتاج تطوير 💡';
            return 'يحتاج مراجعة عاجلة ⚠️';
        },

        // توليد لون التقييم
        getRatingColor(rating) {
            const hue = Math.floor((rating / 10) * 120);
            return `hsl(${hue}, 70%, 45%)`;
        },

        // التنقل بين الأسئلة
        nextQuestion() {
            if (this.currentQuestionIndex < this.questions.length - 1) {
                this.currentQuestionIndex++;
                this.loadReportData();
            }
        },

        previousQuestion() {
            if (this.currentQuestionIndex > 0) {
                this.currentQuestionIndex--;
                this.loadReportData();
            }
        }
    }));
});
    </script>
