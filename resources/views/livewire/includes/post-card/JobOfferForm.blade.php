<form wire:submit.prevent="SubmitJobOfferForm" x-data="{ step: 1 }">
    <!-- Part 1 - Visible initially -->
    <div x-show="step === 1">
        <!-- Job Title -->
        <div class="form-group">
            <label class="mb-1" for="job_title">المسمى الوظيفي</label>
            <input type="text" id="job_title" class="form-control @error('JOForm.job_title') is-invalid @enderror"
                wire:model="JOForm.job_title" placeholder="أدخل عنوان الوظيفة">
            @error('JOForm.job_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <!-- Job Location -->
            <div class="form-group col-md-6">
                <label class="mb-1" for="job_location">مكان العمل</label>
                <input type="text" id="job_location"
                    class="form-control @error('JOForm.job_location') is-invalid @enderror"
                    wire:model="JOForm.job_location" placeholder="أدخل موقع العمل (على سبيل المثال، نيويورك، عن بعد)">
                @error('JOForm.job_location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Job Timing -->
            <div class="form-group col-md-6">
                <label class="mb-1" for="job_timing">توقيت العمل</label>
                <input type="text" id="job_timing" class="form-control @error('JOForm.job_timing') is-invalid @enderror"
                    wire:model="JOForm.job_timing" placeholder="(على سبيل المثال، دوام كامل، دوام جزئي)">
                @error('JOForm.job_timing')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- About Job -->
        <div class="form-group">
            <label class="mb-1" for="about_job">عن الوظيفة</label>
            <textarea id="about_job" class="form-control @error('JOForm.about_job') is-invalid @enderror"
                wire:model="JOForm.about_job" placeholder="تقديم وصف مختصر عن الوظيفة"
                oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
            @error('JOForm.about_job')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-start align-items-center mt-3">
            <button type="button" @click="step = 2" class="btn btn-primary rounded">
                <span>استمرار</span>
            </button>
        </div>
    </div>

    <!-- Part 2 - Hidden initially -->
    <div x-show="step === 2">
        <!-- Job Tasks -->
        <div class="form-group">
            <label class="mb-1" for="job_tasks">المهام الوظيفية</label>
            <textarea id="job_tasks" class="form-control @error('JOForm.job_tasks') is-invalid @enderror"
                wire:model="JOForm.job_tasks" placeholder="قم بإدراج المهام والمسؤوليات الرئيسية للوظيفة"
                oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
            @error('JOForm.job_tasks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Job Conditions -->
        <div class="form-group">
            <label class="mb-1" for="job_conditions">شروط الوظيفة</label>
            <textarea id="job_conditions" class="form-control @error('JOForm.job_conditions') is-invalid @enderror"
                wire:model="JOForm.job_conditions"
                placeholder="اذكر أي شروط محددة للوظيفة (على سبيل المثال، متطلبات السفر، والمتطلبات البدنية)"
                oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
            @error('JOForm.job_conditions')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Job Skills -->
        <div class="form-group">
            <label class="mb-1" for="job_skills">مهارات الوظيفة</label>
            <textarea id="job_skills" class="form-control @error('JOForm.job_skills') is-invalid @enderror"
                wire:model="JOForm.job_skills"
                placeholder="قم بإدراج المهارات المطلوبة للوظيفة (على سبيل المثال، البرمجة، والتواصل)"
                oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
            @error('JOForm.job_skills')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-start align-items-center gap-2 mt-3">
            <button type="button" @click="step = 1" class="btn btn-secondary rounded">
                <span>رجوع</span>
            </button>
            <button class="btn btn-primary rounded" wire:loading.attr="disabled" style="height: fit-content;">
                <span>نشر العرض</span>
            </button>
        </div>
    </div>
</form>
