<div class="row justify-content-center mt-7" dir="rtl">
    <div class="col-lg-5 text-center">
        <!-- Logo -->
        <a href="index.html">
            <img src="assets/img/svg/logo.svg" alt="">
        </a>

        <!-- Card -->
        <div class="card mt-5">
            <div class="card-body py-5 px-lg-5">
                <!-- SVG Icon -->
                <div class="svg-icon svg-icon-xl text-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 512 512">
                        <title>ionicons-v5-g</title>
                        <path d="M336,208V113a80,80,0,0,0-160,0v95"
                            style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                        </path>
                        <rect x="96" y="208" width="320" height="272" rx="48" ry="48"
                            style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                        </rect>
                    </svg>
                </div>

                <!-- Title -->
                <h3 class="fw-normal text-dark mt-4">
                    التحقق بخطوتين
                </h3>

                <!-- Messages -->
                @if (session()->has('message'))
                    <p class="text-green-500 mt-4 mb-1">{{ session('message') }}</p>
                @endif
                @if (session()->has('error'))
                    <p class="text-red-500 mt-4 mb-1">{{ session('error') }}</p>
                @endif

                <!-- Description -->
                <p class="mt-4 mb-1">
                    لقد أرسلنا رمز التحقق إلى بريدك الإلكتروني.
                </p>
                <p>
                    الرجاء إدخال الرمز في الحقل أدناه.
                </p>

                <!-- OTP Input Fields -->
                <div class="row mt-4 pt-2">
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            autofocus wire:model.live="otp.0">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            wire:model.live="otp.1">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            wire:model.live="otp.2">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            wire:model.live="otp.3">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            wire:model.live="otp.4">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            wire:model.live="otp.5">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-lg text-center py-4" maxlength="1"
                            wire:model.live="otp.6">
                    </div>
                </div>

                <!-- Verify Button -->
                <button wire:click="verifyOtp" class="btn btn-primary btn-lg w-100 hover-lift-light mt-4 rounded">
                    تحقق من حسابي
                </button>
            </div>
        </div>

        <!-- Resend Code Link -->
        <p class="text-center text-muted mt-4">
            لم تستلم الرمز؟
            <a href="#!" class="text-decoration-none ms-2">
                إعادة إرسال الرمز
            </a>
        </p>
    </div>
</div>
