<div dir="rtl" class="d-flex justify-content-center align-items-center" style="height: 90vh;" x-data="interviewReport()"
    x-init="analyzeAll()">
    <div class="container text-center">
        <template x-if="!isLoading && !analysisResult">
            <div>
                <h3>تهانينا! <span class="fs-3">🎉</span> تم إرسال مقابلتك بنجاح.</h3>
                <p>شكراً لإجراء المقابلة معنا. نحن حالياً نقوم بتحليل إجاباتك لإنشاء تقرير تفصيلي عن أدائك.</p>
                <button class="btn btn-dark p-3 py-2">عرض تقرير المقابلة</button>
            </div>
        </template>

        <template x-if="isLoading">
            <div class="loading-section">
                <h4>جاري تحليل الإجابات...</h4>
                <p>الوقت المنقضي: <span x-text="timer"></span> ثانية</p>
                <p class="alert alert-warning" x-show="timer > 30">
                    قد تستغرق عملية التحليل وقتًا أطول، وقد تصل مدة الانتظار إلى 200 ثانية...
                </p>
                <div class="spinner-border text-dark mb-3" role="status"></div>
            </div>
        </template>
    </div>
</div>

<script>
    window.env =
    {
        API_KEY: "{{ env('API_KEY') }}",
        MODEL: "{{ env('MODEL') }}"
    };
    document.addEventListener('alpine:init', () => {
        Alpine.data('interviewReport', () => ({
            API_KEY: window.env.API_KEY,
            MODEL: window.env.MODEL,

            isLoading: false,
            timer: 0,
            intervalId: null,
            analysisResult: null,

            async analyzeAnswers() {
    try {
        // استرجاع الإجابات من sessionStorage
        const answers = JSON.parse(sessionStorage.getItem('answers')) || [];

        // بناء prompt للذكاء الاصطناعي
        const prompt = this.buildAnalysisPrompt(answers);

        // إرسال الطلب إلى API
        const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${this.API_KEY}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                model: this.MODEL,
                messages: [{ role: "user", content: prompt }],
                temperature: 0.7
            })
        });

        const data = await response.json();
        this.analysisResult = data.choices[0].message.content;

        // حفظ النتيجة في sessionStorage
        sessionStorage.setItem('report', this.analysisResult);
        return this.analysisResult; // إرجاع النتيجة بدلاً من إعادة التوجيه هنا
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء التحليل، يرجى المحاولة مرة أخرى');
    }
}
            ,

            buildAnalysisPrompt(answers) {
                const prompt = `
### التوجيهات الأساسية:
1. اللغة المطلوبة: العربية فقط بشكل صارم (بدون أي كلمات إنجليزية)
2. التنسيق المطلوب: JSON صالح بدون أي نص إضافي
3. الهيكل المطلوب:
\\boxed{
{
  "analysis": [
    {
      "question": "نص السؤال هنا",
      "answer": "نص الإجابة هنا",
      "report": {
        "evaluation": "التقييم العام للأداء",
        "strengths": ["نقاط القوة 1", "نقاط القوة 2"],
        "weaknesses": ["نقاط الضعف 1", "نقاط الضعف 2"],
        "improvements": ["اقتراحات التحسين 1", "اقتراحات التحسين 2"],
        "score": 8.5
      }
    }
  ]
}
}


### البيانات الخام:
الأسئلة والإجابات:
${answers.map((a, i) =>
                    `${i + 1}. السؤال: ${a.question}\n   الإجابة: ${a.answer}`
                ).join('\n\n')}

### التعليمات التفصيلية:
- ابدأ التحليل بعبارة "بدأ التحليل" (كتعليق داخل الـ JSON)
- انهي التحليل بعبارة "انتهى التحليل" (كتعليق داخل الـ JSON)
- استخدم علامات الترقيم العربية بشكل صحيح
- تجنب أي محتوى غير عربي بشكل قطعي
- التزم الهيكل المحدد بدقة دون أي انحراف
- الدرجة تكون رقم عشري بين 0 و10 مع تعليق تفسيري قصير

### تحذيرات مهمة:
- أي خروج عن التنسيق المطلوب سيعتبر إجابة خاطئة
- المحتوى غير العربي سيتسبب في رفض الإجابة
- سيتم تحليل الإجابة آليًا، تأكد من صحة الـ JSON
`;

                return prompt;
            },



            buildAnalysisPromptPersonalityDimensions(answers) {
                const prompt = `
### التوجيهات الأساسية:
1. اللغة المطلوبة: العربية فقط بشكل صارم (بدون أي كلمات إنجليزية)
2. التنسيق المطلوب: JSON صالح بدون أي نص إضافي
3. الهيكل المطلوب:

\\boxed{
{
  "analysis": [
    {
    "evaluation": "التقييم العام للأداء بناءً على جميع الإجابات",
    "strengths": ["نقاط القوة 1", "نقاط القوة 2"],
    "weaknesses": ["نقاط الضعف 1", "نقاط الضعف 2"],
    "improvements": ["اقتراحات التحسين 1", "اقتراحات التحسين 2"],
    "score": {"openness": "8.5", "conscientiousness": "9.3","diligence": "9", "agreeableness": "7","neuroticism": "5"}
    "dimensions": {
      "openness": "تحليل مستوى الانفتاح استناداً إلى جميع الإجابات",
      "conscientiousness": "تحليل مستوى الوعي استناداً إلى جميع الإجابات",
      "diligence": "تحليل مستوى الاجتهاد استناداً إلى جميع الإجابات",
      "agreeableness": "تحليل مستوى التوافق استناداً إلى جميع الإجابات",
      "neuroticism": "تحليل مستوى العصابية استناداً إلى جميع الإجابات"
    }
    }
  ]
}
}
### البيانات الخام:
الأسئلة والإجابات:
${answers.map((a, i) =>
                    `${i + 1}. السؤال: ${a.question}\n   الإجابة: ${a.answer}`
                ).join('\n\n')}

### التعليمات التفصيلية:
- ابدأ التحليل بعبارة "بدأ التحليل" (كتعليق داخل الـ JSON)
- انهي التحليل بعبارة "انتهى التحليل" (كتعليق داخل الـ JSON)
- قم بتحليل جميع الإجابات بشكل عام كمجموعة، وليس كل سؤال على حدة
- يجب تحليل الأبعاد الخمس التالية استناداً إلى جميع الإجابات: openness، conscientiousness، diligence، agreeableness، neuroticism
- استخدم علامات الترقيم العربية بشكل صحيح
- تجنب أي محتوى غير عربي بشكل قطعي
- التزم الهيكل المحدد بدقة دون أي انحراف
- الدرجة تكون رقم عشري بين 0 و10 مع تعليق تفسيري قصير

### تحذيرات مهمة:
- أي خروج عن التنسيق المطلوب سيعتبر إجابة خاطئة
- المحتوى غير العربي سيتسبب في رفض الإجابة
- سيتم تحليل الإجابة آليًا، تأكد من صحة الـ JSON
`;

                return prompt;
            },

            async analyzeAnswersPersonalityDimensions() {
    try {
        // استرجاع الإجابات من sessionStorage
        const answers = JSON.parse(sessionStorage.getItem('answers')) || [];

        // بناء prompt للذكاء الاصطناعي
        const prompt = this.buildAnalysisPromptPersonalityDimensions(answers);

        // إرسال الطلب إلى API
        const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${this.API_KEY}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                model: this.MODEL,
                messages: [{ role: "user", content: prompt }],
                temperature: 0.7
            })
        });

        const data = await response.json();
        this.analysisResult = data.choices[0].message.content;

        // حفظ النتيجة في sessionStorage
        sessionStorage.setItem('personalityDimensions', this.analysisResult);
        return this.analysisResult;
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء التحليل، يرجى المحاولة مرة أخرى');
    }
},

            buildAnalysisPromptTechDimensions(answers) {
                const prompt = `
### التوجيهات الأساسية:
1. اللغة المطلوبة: العربية فقط بشكل صارم (بدون أي كلمات إنجليزية)
2. التنسيق المطلوب: JSON صالح بدون أي نص إضافي
3. الهيكل المطلوب:
{
  "analysis": {
    "evaluation": "التقييم العام للأداء بناءً على جميع الإجابات",
    "strengths": ["نقاط القوة 1", "نقاط القوة 2"],
    "weaknesses": ["نقاط الضعف 1", "نقاط الضعف 2"],
    "improvements": ["اقتراحات التحسين 1", "اقتراحات التحسين 2"],
    "score": {"problem_solving": "8.5", "communication": "9.3","teamwork": "9", "adaptability": "7"}
    "dimensions": {
      "problem_solving": "تحليل مستوى حل المشكلات استناداً إلى جميع الإجابات",
      "communication": "تحليل مستوى التواصل استناداً إلى جميع الإجابات",
      "teamwork": "تحليل مستوى العمل الجماعي استناداً إلى جميع الإجابات",
      "adaptability": "تحليل مستوى التكيف استناداً إلى جميع الإجابات"
    }
  }
}


### البيانات الخام:
الأسئلة والإجابات:
${answers.map((a, i) =>
                    `${i + 1}. السؤال: ${a.question}\n   الإجابة: ${a.answer}`
                ).join('\n\n')}

### التعليمات التفصيلية:
- ابدأ التحليل بعبارة "بدأ التحليل" (كتعليق داخل الـ JSON)
- انهي التحليل بعبارة "انتهى التحليل" (كتعليق داخل الـ JSON)
- قم بتحليل جميع الإجابات بشكل عام كمجموعة، وليس كل سؤال على حدة
- يجب تحليل الأبعاد الخمس التالية استناداً إلى جميع الإجابات: openness، conscientiousness، diligence، agreeableness، neuroticism
- استخدم علامات الترقيم العربية بشكل صحيح
- تجنب أي محتوى غير عربي بشكل قطعي
- التزم الهيكل المحدد بدقة دون أي انحراف
- الدرجة تكون رقم عشري بين 0 و10 مع تعليق تفسيري قصير

### تحذيرات مهمة:
- أي خروج عن التنسيق المطلوب سيعتبر إجابة خاطئة
- المحتوى غير العربي سيتسبب في رفض الإجابة
- سيتم تحليل الإجابة آليًا، تأكد من صحة الـ JSON
`;

                return prompt;
            },

            async analyzeAnswersTechDimensions() {
    try {
        // استرجاع الإجابات من sessionStorage
        const answers = JSON.parse(sessionStorage.getItem('answers')) || [];

        // بناء prompt للذكاء الاصطناعي
        const prompt = this.buildAnalysisPromptTechDimensions(answers);

        // إرسال الطلب إلى API
        const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${this.API_KEY}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                model: this.MODEL,
                messages: [{ role: "user", content: prompt }],
                temperature: 0.7
            })
        });

        const data = await response.json();
        this.analysisResult = data.choices[0].message.content;

        // حفظ النتيجة في sessionStorage
        sessionStorage.setItem('techDimensions', this.analysisResult);
        return this.analysisResult;
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء التحليل، يرجى المحاولة مرة أخرى');
    }
},

async analyzeAll() {
    try {
        this.isLoading = true;
        this.startTimer(); // تشغيل المؤقت هنا فقط مرة واحدة

        const [personalityResult, techResult, generalResult] = await Promise.all([
            this.analyzeAnswersPersonalityDimensions(),
            this.analyzeAnswersTechDimensions(),
            this.analyzeAnswers()
        ]);

        console.log("تحليل الشخصية:", personalityResult);
        console.log("تحليل المهارات التقنية:", techResult);
        console.log("التحليل العام:", generalResult);

        // إعادة التوجيه بعد انتهاء التحليل
        window.location.href = 'http://127.0.0.1:8000/ReportsAnalysis';

        return { personalityResult, techResult, generalResult };
    } catch (error) {
        console.error("حدث خطأ أثناء التحليل:", error);
    } finally {
        this.isLoading = false;
        this.stopTimer(); // إيقاف المؤقت هنا فقط
    }
},





            startTimer() {
                this.timer = 0;
                this.intervalId = setInterval(() => {
                    this.timer++;
                }, 1000);
            },

            stopTimer() {
                clearInterval(this.intervalId);
            }
        }));
    });
</script>