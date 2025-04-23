@push('styles')
    <link rel="stylesheet" href="{{ asset('careerAI-css/welcome.css') }}">
@endpush
<div lang="ar" dir="rtl">
    <section class="container text-center">
        <h2>تعرف على نفسك بشكل أفضل</h2>
        <p class="fs-4">باستخدام الذكاء الاصطناعي، يمكن لأي شخص إجراء مقابلة والحصول على تحليل لكفاءاته وشخصيته وفحص
            درجة السيرة
            الذاتية.</p>

        <div class="d-flex w-100 justify-content-center gap-3 mt-3">
            <!-- زر ابدأ المقابلة -->
            <a href="{{ route('Uplaod_Job_Profile') }}" class="button bg-dark text-decoration-none">
                <span class="label text-light">ابدأ المقابلة</span>
                <span class="gradient-container">
                    <span class="gradient"></span>
                </span>
            </a>
        </div>

    </section>

    <div class="container mt-4">
        <section class="row align-items-center">
            <div class="col-md-6 fs-4">
                <h3 class="section-header fw-bold">تقرير تحليل الشخصية</h3>
                <p class="bolder-weight">احصل على تقرير تحليل الشخصية في خمسة مجالات رئيسية</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>الانفتاح:</strong> حب التجربة، والخيال، والفضول، وتقبّل الأفكار الجديدة.
                        <br>مثال: الشخص المنفتح يحب تعلّم أشياء جديدة، تجربة أطعمة غريبة، أو السفر لأماكن مختلفة.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>الوعي:</strong> التنظيم، والانضباط، وتحمل المسؤولية، والعمل بجد.
                        <br>مثال: الشخص الواعي يخطط لوقته، ينجز واجباته في وقتها، ويهتم بالتفاصيل.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>الانبساطية:</strong> حب التفاعل الاجتماعي، والتحدث مع الآخرين، والحيوية.
                        <br>مثال: الشخص المنبسط يحب التحدث مع الناس، يكون نشيطًا في الاجتماعات، ويشعر بالسعادة عند وجوده مع الآخرين.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>التوافق:</strong> اللطف، والتعاون، والتعاطف مع الآخرين.
                        <br>مثال: الشخص المتوافق يساعد الآخرين، يحب الخير، ويحب أن يكون هناك انسجام في العلاقات.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>العصابية:</strong> الميل للقلق، والتوتر، والتقلبات المزاجية.
                        <br>مثال: الشخص العصابي قد يشعر بسرعة بالغضب أو الحزن، أو يقلق كثيرًا من الأمور البسيطة.
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-placeholder-left">
                    <img src="{{ asset('images/personalAnalysis.jpg') }}"
                        class="l-img-raduis" alt="التقرير التحليلي">
                </div>
            </div>
        </section>

        <section class="row align-items-center mt-4">
            <div class="col-md-6">
                <div class="img-placeholder">
                    <img src="{{ asset('images/performace.jpg') }}" class="r-img-raduis" alt="التقرير الأدا��">
                </div>
            </div>
            <div class="col-md-6 fs-4" dir="ltr">
                <h3 class="section-header fw-bold">تقرير الأداء</h3>
                <p class="bolder-weight">احصل على تقرير أداء حول مهاراتك الفنية والمهنية:</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li><i class="fa-regular fa-circle-check fs-5"></i> تحسين إجاباتك مع ملاحظات فورية</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> تعرف على ما يمكن توقعه في مقابلات العمل</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> احصل على ملاحظات مخصصة من مساعدي الذكاء
                        الاصطناعي</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> أظهر جاهزيتك للعمل</li>
                </ul>
            </div>
        </section>

        <section class="row align-items-center mt-4">
            <div class="col-md-6 fs-4">
                <h3 class="section-header fw-bold">تقرير المقابلة السلوكية والمهارات</h3>
                <p class="bolder-weight">تعرف على المهارات التي تتقنها والتي تحتاج إلى تحسين</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>حل المشكلات:</strong> القدرة على التفكير وإيجاد حلول عند مواجهة صعوبات.
                        <br>مثال: إذا توقف الكمبيوتر عن العمل، يحاول الشخص <br> فهم السبب وإصلاحه بدلاً من الاستسلام.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>التواصل:</strong> التعبير عن الأفكار بوضوح، والاستماع للآخرين بطريقة فعالة.
                        <br>مثال: التحدث بوضوح في اجتماع، أو كتابة رسالة بريدية مفهومة.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>العمل الجماعي:</strong> التعاون مع الآخرين لإنجاز المهام بشكل أفضل.
                        <br>مثال: مشاركة الأفكار مع الفريق والعمل معًا لإنهاء مشروع.
                    </li>
                    <li>
                        <i class="fa-regular fa-circle-check fs-5"></i>
                        <strong>التكيف:</strong> القدرة على التغير مع الظروف الجديدة أو غير المتوقعة.
                        <br>مثال: إذا تغير نظام العمل في الشركة، يتعلّم الشخص الطريقة الجديدة بسرعة ويكمل عمله.
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-placeholder-left">
                    <img wire:lazy src="{{ asset('images/begavior.avif') }}" class="l-img-raduis" alt="التقرير السلوكي والمهارات">
                </div>
            </div>
        </section>

        <section class="row align-items-center mt-4" dir="ltr">
            <div class="col-md-6 fs-4">
                <h3 class="section-header fw-bold">تحليل السيرة الذاتية والتقرير</h3>
                <p class="bolder-weight">اكتشف درجة سيرتك الذاتية مع تقرير الملاحظات</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li><i class="fa-regular fa-circle-check fs-5"></i> اختيار الوصف الوظيفي المناسب</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الحصول على تقرير مفصل عن كل جزء من سيرتك الذاتية
                    </li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الحصول على ملاحظات لتحسين الأداء في المستقبل
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-placeholder">
                    <img wire:lazy src="{{ asset('images/resumeAnalysis.jpg') }}" class="r-img-raduis" alt="التقرير الأدا��">
                </div>
            </div>
        </section>

    </div>
</div>
