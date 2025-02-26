<form wire:submit.prevent="SubmitJobOfferForm">

    <!-- Job Title -->
    <div class="form-group">
        <label for="job_title">Job Title</label>
        <input type="text" id="job_title" class="form-control @error('JOForm.job_title') is-invalid @enderror"
            wire:model="JOForm.job_title" placeholder="Enter the title of the job">
        @error('JOForm.job_title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <!-- Job Location -->
        <div class="form-group col-md-6">
            <label for="job_location">Job Location</label>
            <input type="text" id="job_location" class="form-control @error('JOForm.job_location') is-invalid @enderror"
                wire:model="JOForm.job_location" placeholder="Enter the job location (e.g., New York, Remote)">
            @error('JOForm.job_location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Job Timing -->
        <div class="form-group col-md-6">
            <label for="job_timing">Job Timing</label>
            <input type="text" id="job_timing" class="form-control @error('JOForm.job_timing') is-invalid @enderror"
                wire:model="JOForm.job_timing" placeholder="(e.g., Full-time, Part-time)">
            @error('JOForm.job_timing')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- About Job -->
    <div class="form-group">
        <label for="about_job">About Job</label>
        <textarea id="about_job" class="form-control @error('JOForm.about_job') is-invalid @enderror"
            wire:model="JOForm.about_job" placeholder="Provide a brief description about the job"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.about_job')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Job Tasks -->
    <div class="form-group">
        <label for="job_tasks">Job Tasks</label>
        <textarea id="job_tasks" class="form-control @error('JOForm.job_tasks') is-invalid @enderror"
            wire:model="JOForm.job_tasks" placeholder="List the main tasks and responsibilities of the job"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.job_tasks')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Job Conditions -->
    <div class="form-group">
        <label for="job_conditions">Job Conditions</label>
        <textarea id="job_conditions" class="form-control @error('JOForm.job_conditions') is-invalid @enderror"
            wire:model="JOForm.job_conditions"
            placeholder="Mention any specific conditions for the job (e.g., travel requirements, physical demands)"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.job_conditions')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Job Skills -->
    <div class="form-group">
        <label for="job_skills">Job Skills</label>
        <textarea id="job_skills" class="form-control @error('JOForm.job_skills') is-invalid @enderror"
            wire:model="JOForm.job_skills"
            placeholder="List the required skills for the job (e.g., programming, communication)"
            oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
        @error('JOForm.job_skills')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary rounded" wire:loading.attr="disabled" style="height: fit-content;">
            <span>Post Offer</span>
        </button>
    </div>

</form>
