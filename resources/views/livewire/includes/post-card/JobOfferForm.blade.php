<form wire:submit.prevent="SubmitJobOfferForm">

    <!-- Job Title -->
    <div class="form-group">
        <label for="job_title">المسمى الوظيفي</label>
        <input type="text" id="job_title" class="form-control @error('JOForm.job_title') is-invalid @enderror"
            wire:model="JOForm.job_title" placeholder="أدخل عنوان الوظيفة">
        @error('JOForm.job_title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <!-- Job Location -->
        <div class="form-group col-md-6">
            <label for="job_location">مكان العمل</label>
            <input type="text" id="job_location" class="form-control @error('JOForm.job_location') is-invalid @enderror"
                wire:model="JOForm.job_location" placeholder="أدخل موقع العمل (على سبيل المثال، نيويورك، عن بعد)">
            @error('JOForm.job_location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Job Timing -->
        <div class="form-group col-md-6">
            <label for="job_timing">توقيت العمل</label>
            <input type="text" id="job_timing" class="form-control @error('JOForm.job_timing') is-invalid @enderror"
                wire:model="JOForm.job_timing" placeholder="(على سبيل المثال، دوام كامل، دوام جزئي)">
            @error('JOForm.job_timing')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- About Job -->
    <div class="form-group">
        <label for="about_job">عن الوظيفة</label>
        <textarea id="about_job" class="form-control @error('JOForm.about_job') is-invalid @enderror"
            wire:model="JOForm.about_job" placeholder="تقديم وصف مختصر عن الوظيفة"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.about_job')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Job Tasks -->
    <div class="form-group">
        <label for="job_tasks">المهام الوظيفية</label>
        <textarea id="job_tasks" class="form-control @error('JOForm.job_tasks') is-invalid @enderror"
            wire:model="JOForm.job_tasks" placeholder="قم بإدراج المهام والمسؤوليات الرئيسية للوظيفة"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.job_tasks')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Job Conditions -->
    <div class="form-group">
        <label for="job_conditions">شروط الوظيفة</label>
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
        <label for="job_skills">مهارات الوظيفة</label>
        <textarea id="job_skills" class="form-control @error('JOForm.job_skills') is-invalid @enderror"
            wire:model="JOForm.job_skills"
            placeholder="قم بإدراج المهارات المطلوبة للوظيفة (على سبيل المثال، البرمجة، والتواصل)"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.job_skills')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary rounded" wire:loading.attr="disabled" style="height: fit-content;">
            <span>نشر العرض</span>
        </button>
    </div>

</form>
