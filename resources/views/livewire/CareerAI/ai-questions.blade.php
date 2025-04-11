@push('styles')
<link rel="stylesheet" href="{{asset('careerAI-css/AI-questions.css')}}">
@endpush

<div style="margin-top: 100px">
    <div class="card p-4 my-3" style="width: 100%; max-width: 600px;">
        <h6 class="text-muted mb-3"><i class="bi bi-stars"></i> السؤال <span id="question-number">1</span></h6>
        <h5 class="mb-4 fw-bold"> <span id="question-text">كيف تصف مهاراتك في التواصل؟</span>
        </h5>
        <div class="textarea-container mt-3">
            <!-- رسالة الخطأ -->
            <div id="error-message" class="text-danger mb-2" style="display: none;">
                يرجى إدخال إجابة قبل الانتقال إلى السؤال التالي.
            </div>
            <textarea id="answer" class="form-control mb-4" rows="4" placeholder="اكتب إجابتك هنا."></textarea>
            <button class="btn btn-dark" id="submit-button">إرسال</button>
        </div>
    </div>
</div>

<script>
    sessionStorage.removeItem('report');
    sessionStorage.removeItem('personalityDimensions');
    sessionStorage.removeItem('techDimensions');
    // قراءة البيانات من sessionStorage
    const questionsData = JSON.parse(sessionStorage.getItem('questions'));

    // دمج الأسئلة من tech و soft في قائمة واحدة
    let allQuestions = [];
    if (questionsData) {
        if (questionsData.tech) allQuestions = allQuestions.concat(questionsData.tech);
        if (questionsData.soft) allQuestions = allQuestions.concat(questionsData.soft);
    }

    let currentQuestionIndex = 0; // الفهرس الحالي للسؤال

    // مصفوفة لتخزين الأسئلة والإجابات
    let answers = JSON.parse(sessionStorage.getItem('answers')) || [];

    // عرض السؤال الأول عند تحميل الصفحة
    function displayCurrentQuestion() {
        if (currentQuestionIndex < allQuestions.length) {
            document.getElementById('question-number').innerText = currentQuestionIndex + 1;
            document.getElementById('question-text').innerText = allQuestions[currentQuestionIndex].text;
        } else {
            // إذا انتهت الأسئلة، يمكن إظهار رسالة أو إجراء آخر
            document.getElementById('submit-button').disabled = true;
            document.getElementById('answer').value = ''; // مسح محتوى الـ textarea
            window.location.href = 'http://127.0.0.1:8000/cong';
        }
    }

    // عرض السؤال الأول عند تحميل الصفحة
    displayCurrentQuestion();

    // الانتقال إلى السؤال التالي عند النقر على "إرسال"
    document.getElementById('submit-button').addEventListener('click', function () {
        const currentAnswer = document.getElementById('answer').value.trim(); // الحصول على الإجابة مع إزالة المسافات الزائدة

        // التحقق من أن textarea غير فارغ
        if (!currentAnswer) {
            // عرض رسالة الخطأ فوق textarea
            document.getElementById('error-message').style.display = 'block';
            return; // إيقاف التنفيذ إذا كانت الإجابة فارغة
        } else {
            // إخفاء رسالة الخطأ إذا كانت الإجابة غير فارغة
            document.getElementById('error-message').style.display = 'none';
        }

        // حفظ الإجابة الحالية في المصفوفة
        if (currentQuestionIndex < allQuestions.length) {
            answers.push({
                question: allQuestions[currentQuestionIndex].text,
                answer: currentAnswer
            });

            // تحديث sessionStorage بالمصفوفة الجديدة
            sessionStorage.setItem('answers', JSON.stringify(answers));
        }

        // مسح محتوى الـ textarea قبل الانتقال إلى السؤال التالي
        document.getElementById('answer').value = '';
        document.getElementById('answer').style.height = 'auto'; // إعادة ضبط الارتفاع التلقائي

        currentQuestionIndex++; // زيادة الفهرس للسؤال التالي
        displayCurrentQuestion(); // عرض السؤال الجديد
    });

    // جعل textarea تتوسع تلقائيًا مع الكتابة
    const textarea = document.querySelector('.textarea-container textarea');
    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
</script>
