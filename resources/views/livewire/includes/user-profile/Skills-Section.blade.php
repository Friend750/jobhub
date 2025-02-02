<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5>Skills</h5>
        </div>

        <ul class="list-unstyled d-flex flex-wrap" x-data="skillsList">
            <li class="text-muted" x-show="skills.length === 0">No skills added yet</li>

            <template x-for="(skill, index) in skills" :key="index">
                <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="skill.name"
                    x-on:click="$wire.selectSkill(skill.id, skill.name)" data-bs-toggle="tooltip" title="Click to Edit">
                </li>
            </template>

            <template x-if="skills.length > defaultLimit">
                <li class="btn btn-secondary m-1"
                    x-on:click="limit === skills.length ? limit = defaultLimit : limit = skills.length"
                    x-text="limit === skills.length ? 'See Less' : '+' + (skills.length - limit) + ' more'">
                </li>
            </template>
        </ul>
    </div>
</div>

<!-- modal EditSkills -->
<div class="modal fade overflow-hidden" id="EditSkills" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Choose the new Skill name</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <p class="bg-light py-2 px-2 fw-bolder rounded text-muted">Previous Name: <span x-data="{ oldSkill: @entangle('selectedSkillName') }" x-text="oldSkill??'null'"></span></p>
                <!-- Search Input -->
                <input type="text" wire:model.live.debounce.300ms="searchQuery" placeholder="Search skills..."
                    class="form-control rounded-0 border-0 border-bottom">

                <!-- Skill List -->
                <ul class="list-unstyled mb-0" style="height: 300px; overflow-y: auto;">
                    @foreach ($skills as $skill)
                        <li wire:click="selectSkill('{{ $skill['id'] }}', '{{ $skill['name'] }}')"
                            class="w-100 text-start p-2 hover:bg-gray-100 pointer">
                            {{ $skill['name'] }}
                        </li>
                    @endforeach

                    <!-- No Results Message -->
                    @if (count($skills) === 0)
                        <li class="p-2 text-muted">No skills found.</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('skillsList', () => ({
            skills: @entangle('skills'),
            limit: 7,
            defaultLimit: 7,
        }));
    });
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('update-skill', () => {
            let modalElement = document.getElementById('EditSkills');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
            }
        });
    });
</script>
