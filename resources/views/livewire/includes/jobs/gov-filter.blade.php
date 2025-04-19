<div x-data="searchableDropdown(@this)" x-cloak x-on:click.away="closeDropdown" class="position-relative dropdown-container">
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

        <div x-show="filteredGovernorates.length === 0" class="p-3 text-gray-400 text-right border-t border-gray-100">
            لا توجد نتائج
        </div>
    </div>
</div>
