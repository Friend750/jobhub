@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jobList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container" style="margin-top: 5rem;">
    <!-- Filters Section -->
    @include('livewire.includes.jobs.filters')

    <!-- Job Content -->
    <div class="row" x-data="jobSelector(@js($jobs), @js($initialJob))">
        <div class="col-4" style="
        max-height: 72vh;
        overflow: auto;">
            @forelse ($jobs as $job)
                <div>
                    @include('livewire.includes.jobs.job-card')
                </div>
            @empty
                @include('livewire.includes.jobs..no-jobs')
            @endforelse
        </div>

        <div class="col-8">
            @include('livewire.includes.jobs..job-details')
        </div>
    </div>
</div>


<script>
    function searchableDropdown() {
        return {
            query: '',
            selected: '',
            open: false,
            governorates: [
                'كل المحافظات',
                'صنعاء',
                'عدن',
                'تعز',
                'حضرموت',
                'المهرة',
                'الحديدة',
                'إب',
                'الضالع',
                'المحويت',
                'ذمار',
                'البيضاء'
            ],
            dropdownPosition: {
                top: '0',
                right: '0'
            },

            get filteredGovernorates() {
                return this.governorates.filter(
                    gov => gov.toLowerCase().includes(this.query.toLowerCase())
                );
            },

            toggleDropdown() {
                this.open = !this.open;
            },

            closeDropdown() {
                this.open = false;
            },

            selectItem(gov) {
                this.selected = gov;
                this.closeDropdown();
                this.$dispatch('governorate-selected', gov);
            },

        }
    }
</script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('jobSelector', (jobs, initialJob) => ({
            jobs: jobs,
            selectedJob: null,

            init() {
                // Set first job as selected by default
                if (initialJob) {
                    this.selectedJob = initialJob;
                } else if (this.jobs.length > 0) {
                    this.selectedJob = this.jobs[0];
                }

                console.log('Initialized with:', {
                    jobs: this.jobs,
                    initialJob: initialJob,
                    selectedJob: this.selectedJob
                });
            },

            // selectJob(jobId) {
            //     this.selectedJob = this.jobs.find(j => j.id === jobId);
            // },
            selectJob(jobId) {
                // Convert the proxy to a real array.
                const jobsArray = Object.values(this.jobs);
                // Find the job in the newly created array.
                const job = jobsArray.find(j => j.id === jobId);
                this.selectedJob = job;
            },
            isSelected(jobId) {
                return this.selectedJob && this.selectedJob.id === jobId;
            }
        }));
    });
</script>
