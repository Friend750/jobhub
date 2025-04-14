<div class="filters-section rounded shadow-sm" style="position: sticky; z-index: 10; top: 1rem;">
    <div class="filters-container d-flex gap-2 justify-content-between align-items-center w-100">
        <div class="filters d-flex align-items-center gap-2">
            <!-- Sort Filter -->
            <div class="position-relative d-inline-block custom-select-container">
                <select class="filter form-select m-0 py-2 border-2 border-primary border-opacity-10 rounded-3 text-right custom-select">
                    <option>الاكثر صلة</option>
                    <option>الاحدث</option>
                </select>
                <span class="position-absolute top-50 start-0 translate-middle-y ps-2 custom-select-icon">
                    <i class="bi bi-chevron-down text-primary"></i>
                </span>
            </div>

            <!-- Time Filter -->
            <div class="position-relative d-inline-block custom-select-container">
                <select class="filter form-select m-0 py-2 border-2 border-primary border-opacity-10 rounded-3 text-right custom-select">
                    <option>اي وقت</option>
                    <option>هذا اسبوع</option>
                    <option>هذا الشهر</option>
                </select>
                <span class="position-absolute top-50 start-0 translate-middle-y ps-2 custom-select-icon">
                    <i class="bi bi-chevron-down text-primary"></i>
                </span>
            </div>

            <!-- Governorates Dropdown -->
            <div x-data="searchableDropdown()" x-cloak x-on:click.away="closeDropdown" class="position-relative dropdown-container">
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

        <!-- Search -->
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
