<div class="job-details bg-white p-4 rounded-3 shadow-sm"
    style="position: sticky; top: 6rem; height: 72vh;
    overflow: auto;">

    <div class="h-100 d-flex flex-column justify-content-center align-items-center"
        x-bind:class="selectedJob ? 'd-none' : ''">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">جاري تحميل تفاصيل الوظيفة...</p>
    </div>


    <div x-show="selectedJob" x-cloak x-data="jobData(selectedJob)">
        <!-- Job Title -->
        <h4 class="mb-2 fw-bolder text-primary d-inline" x-text="jobTitle"></h4>
        <small class="badge bg-light text-muted border" x-text="jobTiming"></small>


        <!-- Location, Timing, and Post Date -->
        <div class="d-flex flex-wrap align-items-center text-muted fw-semibold mb-3 gap-2">
            <small x-text="jobLocation"></small>
            <small class="small">•</small><br>
            <small x-text="createdAt"></small>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2 mb-4">
            <button class="btn btn-primary btn-sm px-3 py-2 rounded fw-bold">تقديم طلب</button>
        </div>

        <!-- About Section -->
        <div class="mb-4">
            <h6 class="fw-bold text-dark mb-2">عن الوظيفة</h6>
            <div class="mb-3">
                <p class="mb-0">
                    <small class="fw-semibold">الشركة او المؤسس:</small>
                    <small x-text="getCompanyName()"></small>
                </p>
                <p class="mb-0">
                    <small class="fw-semibold">الموقع:</small>
                    <small x-text="jobLocation"></small>
                </p>
                <p class="mb-0">
                    <small class="fw-semibold">فترة العمل:</small>
                    <small x-text="jobTiming"></small>
                </p>
            </div>

            <template x-if="aboutJob">
                <div class="mb-3">
                    <p class="fw-semibold m-0 text-dark">نظرة عامة على الوظيفة:</p>
                    <small x-text="aboutJob"></sma>
                </div>
            </template>
        </div>

        <!-- Key Responsibilities -->
        <template x-if="jobTasks && jobTasks.trim()">
            <div class="mb-4">
                <h6 class="fw-bold mb-2 text-dark">المسؤوليات الرئيسية:</h6>
                <small x-html="formatBulletPoints(jobTasks)"></small>
            </div>
        </template>

        <!-- Job Conditions -->
        <template x-if="jobConditions && jobConditions.trim()">
            <div class="mb-4">
                <h6 class="fw-bold mb-2 text-dark">شروط الوظيفة:</h6>
                <small x-html="formatBulletPoints(jobConditions)"></small>
            </div>
        </template>

        <!-- Required Skills -->
        <template x-if="jobSkills">
            <div class="mb-0">
                <h6 class="fw-bold mb-2 text-dark">المهارات المطلوبة:</h6>
                <div class="d-flex flex-wrap gap-2">
                    <template x-for="skill in jobSkills.split(',')">
                        <span class="badge bg-primary bg-opacity-10 text-primary" x-text="skill.trim()"></span>
                    </template>
                </div>
            </div>
        </template>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('jobData', (selectedJob) => ({
                // Variables
                user: selectedJob?.user,
                personalDetails: selectedJob?.user?.personal_details,
                jobTitle: selectedJob?.job_title,
                jobLocation: selectedJob?.job_location,
                jobTiming: selectedJob?.job_timing,
                createdAt: selectedJob?.created_at ? new Date(selectedJob.created_at)
                    .toLocaleDateString() : '',
                aboutJob: selectedJob?.about_job,
                jobTasks: selectedJob?.job_tasks,
                jobConditions: selectedJob?.job_conditions,
                jobSkills: selectedJob?.job_skills,

                getCompanyName() {
                    return this.personalDetails?.page_name || this.getFullName() || 'Company';
                },

                getFullName() {
                    return (this.personalDetails?.first_name || '') + ' ' + (this.personalDetails
                        ?.last_name || '');
                },

                formatBulletPoints(text) {
                    if (!text || !text.trim()) return '';
                    return '• ' + text.trim().replace(/\n+/g, '<br>• ');
                },



                // If you need to react to changes in selectedJob
                init() {
                    this.$watch('selectedJob', (newValue) => {
                        this.updateData(newValue);
                    });
                },


                updateData(job) {
                    this.user = job?.user;
                    this.personalDetails = job?.user?.personal_details;
                    this.jobTitle = job?.job_title;
                    this.jobLocation = job?.job_location;
                    this.jobTiming = job?.job_timing;
                    this.createdAt = job?.created_at ? new Date(job.created_at).toLocaleDateString() :
                        '';
                    this.aboutJob = job?.about_job;
                    this.jobTasks = job?.job_tasks;
                    this.jobConditions = job?.job_conditions;
                    this.jobSkills = job?.job_skills;
                }
            }));
        });
    </script>

</div>
