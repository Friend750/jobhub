@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jobList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container" style="margin-top: 5rem;">
    <!-- Filters Section -->
    @include('livewire.includes.jobs.filters')

    <div class="row" x-data="jobSelector(@js($jobs), @js($initialJob))" wire:key="jobs-container-{{ count($jobs) }}-{{ $initialJob?->id }}">

        <!-- Jobs List Column -->
        <div class="col-4 custom-scrollbar" style="max-height: 72vh; overflow: auto;">
            @forelse ($jobs as $job)
                <div wire:key="job-card-{{ $job->id }}" x-on:click="selectJob({{ $job->id }})">
                    @include('livewire.includes.jobs.job-card', [
                        'isSelected' => $initialJob?->id === $job->id,
                    ])
                </div>
            @empty
            @endforelse
        </div>

        <!-- Job Details Column -->
        <div class="col-8">
            <div class="job-details bg-white p-4 rounded-3 shadow-sm custom-scrollbar"
                style="height: 72vh; overflow: auto;">

                <!-- Loading State (shows only when loading) -->
                <div x-show="loading" class="h-100">

                    <div class="h-100 d-flex flex-column align-items-center justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">جاري تحميل تفاصيل الوظيفة...</p>

                    </div>
                </div>

                <!-- Job Details Content (shows only when a job is selected and not loading) -->
                <template x-if="selectedJob && !loading">
                    <div x-data="jobData()" x-init="updateData(selectedJob)">
                        @include('livewire.includes.jobs.job-details')
                    </div>
                </template>

                <!-- Empty State -->
                <template x-if="!loading && jobs.length === 0">
                    @include('livewire.includes.jobs.no-jobs')
                </template>

            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('jobSelector', (jobs, initialJob) => ({
            jobs: Array.isArray(jobs) ? jobs : Object.values(jobs), // safer array conversion
            selectedJob: null,
            loading: false,

            init() {
                // Set initial job selection
                this.updateSelectedJob(initialJob);


                // Watch for Livewire re-renders
                this.$watch('jobs', (newJobs) => {
                    if (!this.selectedJob && newJobs.length > 0) {
                        this.updateSelectedJob(newJobs[0]);
                    }
                });
            },

            async selectJob(jobId) {
                this.loading = true;
                const foundJob = this.jobs.find(j => j.id === jobId);
                this.updateSelectedJob(foundJob);
                this.loading = false;
            },

            updateSelectedJob(job) {
                if (jobs.length > 0 && job === null) {
                    this.selectedJob = this.jobs[0];
                    return;
                }
                this.selectedJob = job || null;

            },

            isSelected(jobId) {
                return this.selectedJob?.id === jobId;
            }
        }));
    });


    document.addEventListener('alpine:init', () => {
        Alpine.data('jobData', () => ({
            user: null,
            personalDetails: null,
            jobTitle: null,
            jobLocation: null,
            jobTiming: null,
            createdAt: '',
            aboutJob: null,
            jobTasks: null,
            jobConditions: null,
            jobSkills: null,

            init() {
                // Initialize with parent's selected job if available
                if (this.selectedJob) {
                    this.updateData(this.selectedJob);
                }
                // Also watch parent's selectedJob in case it changes
                this.$watch('selectedJob', (job) => {
                    this.updateData(job);
                });
            },

            getCompanyName() {
                return this.personalDetails?.page_name || this.getFullName() || 'Company';
            },

            getFullName() {
                return (this.personalDetails?.first_name || '') + ' ' +
                    (this.personalDetails?.last_name || '');
            },

            formatBulletPoints(text) {
                if (!text || !text.trim()) return '';
                const points = text.trim().split('\n')
                    .filter(point => point.trim())
                    .map(point => `• ${point.trim()}`)
                    .join('<br>');
                return points || '';
            },

            updateData(job) {
                if (!job) {
                    // Clear all data
                    this.user = null;
                    this.personalDetails = null;
                    this.jobTitle = null;
                    this.jobLocation = null;
                    this.jobTiming = null;
                    this.createdAt = '';
                    this.aboutJob = null;
                    this.jobTasks = null;
                    this.jobConditions = null;
                    this.jobSkills = null;
                    return;
                }

                // Update with new job data
                this.user = job.user;
                this.personalDetails = job.user?.personal_details;
                this.jobTitle = job.job_title;
                this.jobLocation = job.job_location;
                this.jobTiming = job.job_timing;
                this.createdAt = job.created_at ? new Date(job.created_at).toLocaleDateString() :
                    '';
                this.aboutJob = job.about_job;
                this.jobTasks = job.job_tasks;
                this.jobConditions = job.job_conditions;
                this.jobSkills = job.job_skills;
            }
        }));
    });
</script>
