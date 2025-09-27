<div class="filters-section rounded shadow-sm" style="position: sticky; z-index: 10; top: 1rem;">
    <div class="filters-container d-flex gap-2 justify-content-between align-items-center w-100">
        <div class="filters d-flex align-items-center gap-2">
            <!-- Sort Filter -->
            <div class="position-relative d-inline-block custom-select-container">
                <select wire:model.live="relative"
    class="filter form-select m-0 py-2 border-2 border-primary border-opacity-10 rounded-3 text-right custom-select">
    <option value="related">الاكثر صلة</option>
    <option value="views">الاكثر مشاهدة</option>
    <option value="likes">الاكثر تفاعلا</option>
    <option value="my_jobs">وظائفي المنشورة</option>
</select>

                <span class="position-absolute top-50 start-0 translate-middle-y ps-2 custom-select-icon">
                    <i class="bi bi-chevron-down text-primary"></i>
                </span>
            </div>

            <!-- Category Filter -->
            @include('livewire.includes.jobs.category-filter')

            <!-- Time Filter -->
            @include('livewire.includes.jobs.time-filter')

            <!-- Governorates Dropdown -->
            @include('livewire.includes.jobs.gov-filter')
        </div>

        <!-- Search -->
        <div class="search flex-grow-1">
            <div class="position-relative">
                <span class="position-absolute top-0 end-0 z-3 h-100 d-flex align-items-center px-3 search-icon">
                    <i class="bi bi-search text-primary"></i>
                </span>
                <input type="text" wire:model.live.debounce.400ms="search"
                    class="form-control border-2 border-primary border-opacity-10 rounded-3 focus:border-primary focus:border-opacity-50 focus:shadow-none search-input"
                    placeholder="ابحث على وظيفة" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>
<script>
    function searchableDropdown($wire) {
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

                $wire.set('gov', gov);
                console.log('Selected governorate:', gov);

            },
        }
    }
</script>
