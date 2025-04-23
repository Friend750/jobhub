@push('styles')
<link rel="stylesheet" href="{{asset('careerAI-css/interviewType.css')}}">
@endpush

<section>

    <div class="container text-center" x-data="questionsGen()">
        <div class="row my-4">
            <h3 class="my-5">اختر نوع المقابلة التي تريد محاكاتها</h3>
            <p x-show="errors" x-text="errors" class="text-red-500 mt-2"></p>
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card p-5" :class="{ 'selected': selectedCard === 1 }" @click="selectedCard = 1">
                    <img src="images/Image-2.png" alt="المهارات الناعمة">
                    <h5 class="mt-3">المهارات الناعمة</h5>
                    <p>أسئلة تركز على المهارات الشخصية والتواصل.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card p-5" :class="{ 'selected': selectedCard === 2 }" @click="selectedCard = 2">
                    <img src="images/Image-1.png" alt="المهارات التقنية">
                    <h5 class="mt-3">المهارات التقنية</h5>
                    <p>أسئلة تستهدف القدرات التقنية والخبرات.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card p-5" :class="{ 'selected': selectedCard === 3 }" @click="selectedCard = 3">
                    <img src="images/Image.png" alt="مزيج من الاثنين">
                    <h5 class="mt-3">مزيج من الاثنين</h5>
                    <p>مجموعة متوازنة من الأسئلة تغطي النوعين.</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center my-5">

            <button type="button" class="btn btn-lg btn-dark my-3 px-5 button" @click="generateQuestions">
                <span x-show="!isLoading">
                    متابعة
                </span>

                <!-- Loading State -->
                <span x-show="isLoading">
                    <div class="d-flex gap-2 align-items-center justify-content-center">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        يتم الان تجهيز الاسئلة ثواني من فضلك...
                        <span class="gradient-container">
                            <span class="gradient"></span>
                        </span>
                    </div>
                </span>
            </button>
        </div>
    </div>

    <script>
        window.env =
    {
    API_KEY: "{{ env('API_KEY') }}",
    MODEL: "{{ env('MODEL') }}"
    };
        document.addEventListener('alpine:init', () => {
            // Clear previous questions
  sessionStorage.removeItem('questions');
  sessionStorage.removeItem('answers');
  sessionStorage.removeItem('report');
    sessionStorage.removeItem('personalityDimensions');
    sessionStorage.removeItem('techDimensions');
      Alpine.data('questionsGen', () => ({
        API_KEY: window.env.API_KEY,
    MODEL: window.env.MODEL,

        isLoading: false,
        errors: null,
        jobTitle: 'وظيفة غير محددة',
        description: '',
        technicalQuestions: [],
        softQuestions: [],
        questionTypes: { technical: true, soft: true },
        selectedCard: null, // Added property for card selection

        init() {
          // محاولة استرجاع البيانات من localStorage
          const savedData = localStorage.getItem('jobData');
          if (savedData) {
            this.jobTitle = JSON.parse(savedData).title;
            this.description = JSON.parse(savedData).description;
          }
        },

        promptTemplate() {
    if (this.questionTypes.technical && this.questionTypes.soft) {
        return this.bothQuestionsTemplate();
    } else if (this.questionTypes.technical) {
        return this.technicalQuestionsTemplate();
    } else if (this.questionTypes.soft) {
        return this.softQuestionsTemplate();
    }
},

technicalQuestionsTemplate() {
    return `أنشئ قائمة أسئلة مقابلة عمل بالعربية للوظيفة: "${this.jobTitle}"
    و اعتمادا على "${this.description}"
━━━━━━━━━━━━━━━━━━━━━━━
المتطلبات:
### الأسئلة التقنية ###
- ركز على أحدث التقنيات المتعلقة بالوظيفة
- قم بتضمين أسئلة عن المبادئ الأساسية وأيضًا حل المشكلات
- يجب أن تكون القائمة تحتوي على **بالضبط 5 أسئلة**، لا أكثر ولا أقل
- تأكد من أن الأسئلة واضحة ومحددة وتتناسب مع الوظيفة المذكورة
- اكتب قبل السؤال انه اسئلة تقنية
- تجنب الاسئلة الغامضة مثل كلمة عامة عمل جماعي و توازن فقط فصل في السؤال
`
},

softQuestionsTemplate() {
   return `أنشئ قائمة أسئلة مقابلة عمل بالعربية للوظيفة:
━━━━━━━━━━━━━━━━━━━━━━━
المتطلبات:
### الأسئلة الناعمة ###
- يجب أن تكون القائمة تحتوي على **بالضبط 5 أسئلة**، لا أكثر ولا أقل
- ركز على الأسئلة المتعلقة بالعمل الجماعي، إدارة الوقت، والتعامل مع الضغوط
- تأكد من أن الأسئلة واضحة ومحددة وتتناسب مع الوظيفة المذكورة
- اكتب قبل السؤال انه اسئلة سلوكية
- السؤال يجب ان يكون مثال واقعي ويطلب من الممتحن ان اذا كان في هذا الموقف ماذا سيعمل وعلى امهارات
الشخصة ضغط عمل او اداراة وقت او عمل جماعي والى اخره
اذا لم تكونها بهذه الطريقة ساقوم بحرقك
- تأكد انك كونت 5 اسئلة فقط او سوف اقوم بحرقك`

},

bothQuestionsTemplate() {
    return `أنشئ قائمة أسئلة مقابلة عمل بالعربية للوظيفة: "${this.jobTitle}"
       و اعتمادا على "${this.description}"
━━━━━━━━━━━━━━━━━━━━━━━
المتطلبات:
### الأسئلة التقنية ###
- ركز على أحدث التقنيات المتعلقة بالوظيفة
- قم بتضمين أسئلة عن المبادئ الأساسية وأيضًا حل المشكلات
- يجب أن تكون القائمة تحتوي على **بالضبط 5 أسئلة**، لا أكثر ولا أقل
- تأكد من أن الأسئلة واضحة ومحددة وتتناسب مع الوظيفة المذكورة
- تأكد انك كونت 5 اسئلة فقط او سوف اقوم بحرقك


### الأسئلة الناعمة ###
- ركز على الأسئلة المتعلقة بالعمل الجماعي، إدارة الوقت، والتعامل مع الضغوط
- يجب أن تكون القائمة تحتوي على **بالضبط 5 أسئلة**، لا أكثر ولا أقل
- تأكد من أن الأسئلة واضحة ومحددة وتتناسب مع الوظيفة المذكورة
- السؤال يجب ان يكون مثال واقعي ويطلب من الممتحن ان اذا كان في هذا الموقف ماذا سيعمل وعلى امهارات
الشخصة ضغط عمل او اداراة وقت او عمل جماعي والى اخره
اذا لم تكونها بهذه الطريقة ساقوم بحرقك
- تأكد انك كونت 5 اسئلة فقط او سوف اقوم بحرقك
`
}
,

  async generateQuestions()
  {
  if (this.selectedCard === 1) {
      this.questionTypes = { technical: false, soft: true };
    } else if (this.selectedCard === 2) {
      this.questionTypes = { technical: true, soft: false };
    } else if (this.selectedCard === 3) {
      this.questionTypes = { technical: true, soft: true };
    } else {
      // Default to both if no card is selected
      this.questionTypes = { technical: true, soft: true };
    }

  // ... update questionTypes based on selectedCard as before ...

  if (!this.jobTitle || this.jobTitle === 'وظيفة غير محددة') {
    this.errors = 'يرجى تحديد اسم وظيفة صحيح أولاً';
    return;
  }
  this.isLoading = true;
  this.errors = null;

  const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${this.API_KEY}`,
      'Content-Type': 'application/json',
      'HTTP-Referer': window.location.href,
      'X-Title': 'Job Interview Questions Generator'
    },
    body: JSON.stringify({
      model: this.MODEL,

      messages: [{
        role: 'user',
        content: this.promptTemplate()
      }]
    })
  });

  const data = await response.json();
  const content = data.choices?.[0]?.message?.content || '';
  this.parseQuestions(content);
  this.isLoading = false;

  if (this.softQuestions.length === 0 && this.technicalQuestions.length === 0)
  {
            this.errors = 'لم يتم تكوين الأسئلة، حاول مرة أخرى!';
            return;
  }
        window.location.href = 'http://127.0.0.1:8000/AI_questions';

},

        parseQuestions(content) {
          const technicalMatch = content.match(
            /(الأسئلة التقنية|الأسئلة الفنية|أسئلة تقنية)[\s\S]*?(\d+\..*?)(?=###|الأسئلة|أسئلة|$)/gi
          );
          const softMatch = content.match(
            /(الأسئلة الناعمة|أسئلة سلوكية|أسئلة شخصية)[\s\S]*?(\d+\..*?)(?=###|الأسئلة|أسئلة|$)/gi
          );
          this.technicalQuestions = technicalMatch
            ? this.prepareQuestions(technicalMatch[0])
            : [];
          this.softQuestions = softMatch
            ? this.prepareQuestions(softMatch[0])
            : [];
          if (this.technicalQuestions.length + this.softQuestions.length === 0) {
            this.fallbackParse(content);
          }
          sessionStorage.setItem('questions', JSON.stringify({
            tech: this.technicalQuestions,
            soft: this.softQuestions
          }));
        },

        fallbackParse(content) {
          const lines = content.split('\n');
          let currentCategory = null;
          lines.forEach(line => {
            if (line.includes('تقنية') || line.includes('فنية')) {
              currentCategory = 'technical';
            } else if (line.includes('ناعمة') || line.includes('سلوكية')) {
              currentCategory = 'soft';
            } else if (/^\d+\./.test(line)) {
              const question = this.cleanQuestion(line);
              if (currentCategory === 'technical') {
                this.technicalQuestions.push(this.createQuestionObject(question));
              } else if (currentCategory === 'soft') {
                this.softQuestions.push(this.createQuestionObject(question));
              }
            }
          });
        },

        createQuestionObject(text) {
          return {
            text: text,
          };
        },

        cleanQuestion(line) {
          return line
            .replace(/^\d+\./, '')
            .replace(/["'-]/g, '')
            .replace(/\s+/g, ' ')
            .trim();
        },

        prepareQuestions(text) {
          return text.split('\n')
            .map(line => this.cleanQuestion(line))
            .filter(line => line.length > 0 && !line.match(/^(###|أسئلة|الأسئلة)/i))
            .map((line) => this.createQuestionObject(line));
        },

        toggleEdit(question) {
          if (question.isEditing) {
            question.text = question.editedText;
          }
          question.isEditing = !question.isEditing;
        }
      }));
    });
    </script>
</section>
