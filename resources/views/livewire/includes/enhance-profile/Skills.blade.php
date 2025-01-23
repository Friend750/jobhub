<div class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#skills">
        Skills
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" @click="removeSection(section)"
                title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Choose 3 important skills that show you fit the position. Make sure they match the key skills mentioned
        in the job listing (especially when applying via an online system).</p>
    <div id="skills" class="collapse">
        <div id="skillsContainer">
            <div class="row mb-3 skill-block" id="initialSkill">
                <div class="form-group col-md-12">
                    <div class="flex-grow-1 me-2">

                        {{-- ignore must be in a parent container --}}
                        <div wire:ignore>

                            <select class="form-select" id="multiDropdown"
                                data-placeholder="Add any skill(s) to your profile" multiple>
                                @foreach ($skills as $key => $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>