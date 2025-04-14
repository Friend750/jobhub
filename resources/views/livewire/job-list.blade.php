@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jobList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container" style="margin-top: 5rem;">
    <!-- Filters Section -->
    <div class="filters-section rounded shadow-sm" style="
    position: sticky;
    top: 1rem;">
        <div class="filters-container d-flex gap-2 justify-content-between align-items-center w-100">
            <div class="filters d-flex align-items-center gap-2">
                <div class="position-relative d-inline-block custom-select-container">
                    <select
                        class="filter form-select m-0 py-2 border-2 border-primary border-opacity-10 rounded-3 text-right custom-select">
                        <option>الاكثر صلة</option>
                        <option>الاحدث</option>
                    </select>
                    <span class="position-absolute top-50 start-0 translate-middle-y ps-2 custom-select-icon">
                        <i class="bi bi-chevron-down text-primary"></i>
                    </span>
                </div>
                <div class="position-relative d-inline-block custom-select-container">
                    <select
                        class="filter form-select m-0 py-2 border-2 border-primary border-opacity-10 rounded-3 text-right custom-select">
                        <option>اي وقت</option>
                        <option>هذا اسبوع</option>
                        <option>هذا الشهر</option>
                    </select>
                    <span class="position-absolute top-50 start-0 translate-middle-y ps-2 custom-select-icon">
                        <i class="bi bi-chevron-down text-primary"></i>
                    </span>
                </div>

                <div x-data="searchableDropdown()" x-cloak x-on:click.away="closeDropdown"
                    class="position-relative dropdown-container">
                    <div x-text="selected || 'كل المحافظات'" @click="open = !open"
                        class="form-control border-2 py-2 border-primary border-opacity-10 rounded-3 ps-5 text-right dropdown-trigger"
                        :class="{ 'text-gray-400': !selected }">
                    </div>

                    <div class="position-absolute top-50 start-0 translate-middle-y ps-3 dropdown-icon">
                        <i class="bi bi-chevron-down text-primary"></i>
                    </div>

                    <div x-show="open" x-transition.origin.top.right
                        class="fixed rounded z-50 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg overflow-auto position-absolute start-0 top-0 mt-5 custom-scrollbar dropdown-panel">

                        <input type="text" x-model="query" placeholder="بحث..."
                            class="w-full p-3 border-b border-gray-100 text-right dropdown-input focus:outline-none focus:ring-0 focus:border-gray-200"
                            @click.stop>

                        <div class="custom-scrollbar max-h-[220px]">
                            <template x-for="gov in filteredGovernorates" :key="gov">
                                <div x-text="gov" @click="selectItem(gov)"
                                    class="p-3 py-2 text-right hover:bg-gray-50 cursor-pointer transition-colors duration-100 item-hover">
                                </div>
                            </template>
                        </div>

                        <div x-show="filteredGovernorates.length === 0"
                            class="p-3 text-gray-400 text-right border-t border-gray-100">
                            لا توجد نتائج
                        </div>
                    </div>
                </div>
            </div>

            <div class="search flex-grow-1">
                <div class="position-relative">
                    <span class="position-absolute top-0 end-0 z-3 h-100 d-flex align-items-center px-3 search-icon">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text"
                        class="form-control border-2 border-primary border-opacity-10 rounded-3 focus:border-primary focus:border-opacity-50 focus:shadow-none search-input"
                        placeholder="ابحث على وظيفة" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
    </div>

    <!-- Job Content -->
    <div class="row">
        <div class="col-4">
            @for ($i = 0; $i < 10; $i++)
                <div class="container p-3 bg-light rounded mb-2 card-hover" style="height: fit-content;">
                    <div class="d-flex align-items-start p-3 bg-white rounded ">
                        <div class="ms-3">
                            <img src="https://ui-avatars.com/api" alt="Profile Photo" class="rounded-circle"
                                style="width: 60px; height: 60px; object-fit: cover;">
                        </div>
                        <div>
                            <h4 class="mb-1">DevOps Engineer</h4>
                            <p class="mb-1 text-muted">PayPal • San Francisco, CA</p>
                            <small class="text-muted">1 week ago • Among the first applicants</small>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="col-8">
            <!-- Job Details -->
            <div id="job-details" class="job-details rounded"
                style="
            position: sticky;
            top: 6rem;">
                <h2>Select a job to view details</h2>
                <p>Job details will appear here when you click on "Apply Now".</p>
                <button class="apply-btn">Apply Now</button>
            </div>
        </div>
    </div>
</div>



<script>
    const jobsData = {
        1: {
            title: "DevOps Engineer",
            company: "GitHub",
            location: "San Francisco, CA",
            description: "GitHub helps companies build better software. We're looking for a DevOps Engineer to join our team.",
        },
        2: {
            title: "DevOps Engineer",
            company: "PayPal",
            location: "San Francisco, CA",
            description: "PayPal is looking for a DevOps Engineer to enhance our payment systems. Join us now.",
        },
        3: {
            title: "Infrastructure Engineer",
            company: "PepsiCo",
            location: "Remote",
            description: "Join PepsiCo's team to build and maintain infrastructure for global operations.",
        },
    };

    function showJobDetails(jobId) {
        const job = jobsData[jobId];
        const jobDetails = document.getElementById('job-details');

    }

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
