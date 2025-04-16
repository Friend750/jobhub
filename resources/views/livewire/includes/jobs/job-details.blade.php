<div class="job-details bg-white p-4 rounded-3 shadow-sm"
    style="position: sticky; top: 6rem; height: 72vh;
    overflow: auto;">

    <div class="h-100 d-flex flex-column justify-content-center align-items-center"
        x-bind:class="selectedJob ? 'd-none' : ''">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">Loading job details...</p>
    </div>


    <div x-show="selectedJob" x-cloak>


        <!-- Company Name - Using user's page_name if available -->
        <h6 class="text-muted mb-1"
            x-text="selectedJob.user.personal_details?.page_name || selectedJob.user.user_name || 'Company'"></h6>

        <!-- Job Title -->
        <h4 class="mb-2 fw-bold" x-text="selectedJob.job_title"></h4>

        <!-- Location, Timing, and Post Date -->
        <div class="d-flex flex-wrap align-items-center text-muted mb-3 gap-2">
            <span x-text="selectedJob.job_location"></span>
            <span class="small">•</span>
            <span x-text="new Date(selectedJob.created_at).toLocaleDateString()"></span>
            <span class="small">•</span>
            <span>X applicants</span> <!-- You might want to add applicants count to your query -->
        </div>

        <!-- Job Type Tags -->
        <div class="d-flex gap-2 mb-4">
            <span class="badge bg-light text-dark border" x-text="selectedJob.job_timing"></span>
            <span class="badge bg-light text-dark border">On-site</span> <!-- Hardcoded or add to your model -->
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
            <button class="btn btn-primary btn-sm px-3 py-2 rounded-1 fw-bold">Easy Apply</button>
            <button class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-1">Save</button>
        </div>

        <!-- About Section -->
        <div class="mb-4">
            <h6 class="fw-bold mb-2">About the job</h6>
            <div class="mb-3">
                <p class="mb-1">
                    <span class="fw-semibold">Company:</span>
                    <span x-text="selectedJob.user.personal_details?.page_name || selectedJob.user.user_name"></span>
                </p>
                <p class="mb-1">
                    <span class="fw-semibold">Location:</span>
                    <span x-text="selectedJob.job_location"></span>
                </p>
                <p class="mb-1">
                    <span class="fw-semibold">Job Type:</span>
                    <span x-text="selectedJob.job_timing"></span>
                </p>
            </div>

            <template x-if="selectedJob.about_job">
                <div class="mb-3">
                    <p class="fw-semibold">Position Overview:</p>
                    <p x-text="selectedJob.about_job"></p>
                </div>
            </template>
        </div>

        <!-- Key Responsibilities -->
        <template x-if="selectedJob.job_tasks && selectedJob.job_tasks.trim()">
            <div class="mb-4">
                <h6 class="fw-bold mb-2">Key Responsibilities:</h6>
                <div x-html="'• ' + selectedJob.job_tasks.trim().replace(/\n+/g, '<br>• ')"></div>
            </div>
        </template>
        <!-- Job Conditions -->
        <template x-if="selectedJob.job_conditions && selectedJob.job_conditions.trim()">
            <div class="mb-4">
                <h6 class="fw-bold mb-2">Job Conditions:</h6>
                <div x-html="'• ' + selectedJob.job_conditions.trim().replace(/\n+/g, '<br>• ')"></div>
            </div>
        </template>
        <!-- Required Skills -->
        <template x-if="selectedJob.job_skills">
            <div class="mb-4">
                <h6 class="fw-bold mb-2">Required Skills:</h6>
                <div class="d-flex flex-wrap gap-2">
                    <template x-for="skill in selectedJob.job_skills.split(',')">
                        <span class="badge bg-primary bg-opacity-10 text-primary" x-text="skill.trim()"></span>
                    </template>
                </div>
            </div>
        </template>

        <!-- Posted By -->
        <div class="mt-4 pt-3 border-top">
            <h6 class="fw-bold mb-2">Posted by</h6>
            <div class="d-flex align-items-center">
                <template x-if="selectedJob.user.user_image">
                    <img :src="selectedJob.user.user_image" alt="User image" class="rounded-circle me-2" width="40">
                </template>
                <div>
                    <div
                        x-text="selectedJob.user.personal_details?.first_name + ' ' + selectedJob.user.personal_details?.last_name">
                    </div>
                    <div class="small text-muted" x-text="selectedJob.user.personal_details?.specialist || ''"></div>
                </div>
            </div>
        </div>

    </div>
</div>
