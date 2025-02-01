<div class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#skills">
        {{ __('general.skills') }}
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" 
                x-on:click="toggleSection('skills')" title="{{ __('general.remove_section') }}">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>{{ __('general.skills_description') }}</p>
    <div id="skills" class="collapse show">
        <div id="skillsContainer">
            <div class="row mb-3 skill-block" id="initialSkill">
                <div class="form-group col-md-12">
                    <div class="flex-grow-1 me-2">
                        {{-- ignore must be in a parent container --}}
                        <div wire:ignore>
                            <select class="form-select @error('SkillsForm.skills') is-invalid @enderror"
                                id="multiDropdown" data-placeholder="{{ __('general.placeholder_skills') }}" multiple>
                                @foreach ($skills as $key => $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('SkillsForm.skills')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script()
<script>
    // Initialize the select2 widget with a placeholder text and allow multiple selection
    $(document).ready(function() {
        $('#multiDropdown').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            allowClear: true,
        });

        // Add custom event listeners to the select2 widget
        $('#multiDropdown').on('change', function() {
            // Get the selected options
            let $data = $(this).val();

            // Update the selectedSkills property in Livewire
            $wire.set('SelectedSkills', $data, false);
        });
    });
</script>
@endscript
