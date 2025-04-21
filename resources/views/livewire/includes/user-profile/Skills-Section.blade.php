<!-- Skills Card and Modal -->
<div x-data="skillsComponent()">
    <!-- Skills Card -->
    <div class="card mb-3 rounded">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5>المهارات</h5>
            </div>

            <!-- Skills List -->
            <ul class="list-unstyled d-flex flex-wrap">
                <li class="text-muted text-center py-3" x-show="skills.length === 0">لم تتم إضافة أي مهارات بعد</li>

                <template x-for="(skill, index) in skills" :key="skill . id">
                    <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="skill.name"
                    @click="{{ auth()->user()->id === $user->id ? 'openEditModal(skill)' : ''
                        }}" data-bs-toggle="tooltip" title="Click to Edit">
                    </li>
                </template>

                <template x-if="skills.length > defaultLimit">
                    <li class="btn btn-secondary m-1"
                        @click="limit === skills.length ? limit = defaultLimit : limit = skills.length"
                        x-text="limit === skills.length ? 'شاهد أقل' : '+' + (skills.length - limit) + ' المزيد'">
                    </li>
                </template>
            </ul>
        </div>
    </div>

    <!-- Refresh Message -->
    @if (session()->has('skill_deleted'))
        <div class="alert alert-success d-flex flex-wrap justify-content-between w-100">
            {{ session('skill_deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- skill_updated Message --}}
    @if (session()->has('skill_updated'))
        <div class="alert alert-success d-flex flex-wrap justify-content-between w-100">
            {{ session('skill_updated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Skills Modal -->
    <div class="modal fade overflow-hidden" id="EditSkills" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">اختر اسم المهارة الجديدة</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button> --}}
                </div>
                <div class="modal-body">

                    <!-- Search Input -->
                    <input type="text" x-model="searchQuery" placeholder="Search skills..."
                        class="form-control rounded-0 border-0 border-bottom mb-2">

                    <!-- Filtered Skills List -->
                    <ul class="list-unstyled mb-0" style="height: 300px; overflow-y: auto;">
                        <template x-for="skill in filteredSkills" :key="skill . id">
                            <li class="w-100 text-start p-2 hover:bg-gray-100 pointer" @click="selectSkill(skill)">
                                <span x-text="skill.name"></span>
                            </li>
                        </template>
                        <template x-if="filteredSkills.length === 0">
                            <li class="p-2 text-muted">لم يتم العثور على أي مهارات.</li>
                        </template>
                    </ul>

                    {{-- Delete Button --}}
                    <div class="text-center mt-3">
                        <small class="text-muted">أو يمكنك فقط حذف المهارة الحالية "<span x-text="previousSkill"
                                class="fw-bold"></span>"</small>
                        <button type="button" class="btn btn-danger mt-2 w-100 rounded" data-bs-dismiss="modal"
                            wire:click="deleteSkill(previousSkillID)" wire:loading.attr="disabled"
                            wire:loading.class="disabled">حذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.includes.user-profile.skillModal-box')
</div>

<script>
    function skillsComponent() {
        return {
            // Component State
            skills: @json($skills), // Pass Laravel data to Alpine.js
            availableSkills: @json($availableSkills), // Pass Laravel data to Alpine.js
            previousSkillID: 0,
            previousSkill: '',
            selectedSkillID: 0,
            selectedSkill: null,
            searchQuery: '',
            limit: 5,
            defaultLimit: 5,

            // Computed Property for Filtered Skills
            get filteredSkills() {
                return this.availableSkills.filter(skill => {
                    return skill.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            },

            // Open Edit Modal
            openEditModal(skill) {
                this.previousSkill = skill.name;
                this.previousSkillID = skill.id;
                bootstrap.Modal.getOrCreateInstance(document.getElementById('EditSkills')).show();
            },

            // Select Skill
            selectSkill(skill) {
                this.selectedSkill = skill.name;
                this.selectedSkillID = skill.id;

                bootstrap.Modal.getOrCreateInstance(document.getElementById('EditSkills')).hide();
                bootstrap.Modal.getOrCreateInstance(document.getElementById('skillChangeModal')).show();
            }
        };
    }
</script>
