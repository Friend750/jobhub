<!-- Job Title Search Input -->
<div class="mb-3">
    <label class="form-label">المسمى الوظيفي المطلوب:</label>
    <input type="text" class="form-control" placeholder="مثلاً: مهندس برمجيات" x-model="jobTitleQuery" x-on:blur="handleJobTitleBlur"
        @click="showList = true">
    <div x-text="errors.title" class="text-danger"></div>
</div>
<div class="position-relative">
    <!-- Filtered Job Titles List -->
    <div class="parent position-absolute bg-light w-100 p-3 rounded-3 shadow z-3 ps-0" x-show="showList" x-cloak
        @click.away="showList = false">
        <ul class="list-unstyled rounded-3 card-control pe-0 mb-0">
            <template x-for="position in filteredPositions" :key="position.id">
                <li class="w-100 text-end p-2 pointer" @click="selectPosition(position)">
                    <span x-text="position.name"></span>
                </li>
            </template>
            <template x-if="filteredPositions.length === 0">
                <li class="p-2 text-muted text-end">No job titles found.</li>
            </template>
        </ul>
    </div>
</div>
