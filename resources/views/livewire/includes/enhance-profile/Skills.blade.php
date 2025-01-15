<div class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#skills">
        Skills
        <i class="fas fa-caret-down"></i>
    </h5>
    <p>Choose 3 important skills that show you fit the position. Make sure they match the key skills mentioned
        in the job listing (especially when applying via an online system).</p>
    <div id="skills" class="collapse">
        <div id="skillsContainer">
            <div class="row mb-3 skill-block" id="initialSkill">
                <div class="form-group col-md-12">
                    {{-- <label for="skill1" style="min-width: 150px;">Skill 1</label>
                    <div class="d-flex">
                        <input type="text" class="form-control" placeholder="Skill name">
                    </div> --}}

                    <div class="flex-grow-1 me-2">

                        {{-- ignore must be in a parent container --}}
                        <div wire:ignore>

                            <select class="form-select" id="multiDropdown" data-placeholder="Add any skill(s) to your profile"
                                multiple>
                                @foreach ($skills as $key => $skill)
                                    <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-between align-items-center mt-3">
            <button wire:click='save' class="btn btn-primary rounded">test</button>
        </div> --}}
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
                closeOnSelect: false,
                allowClear: true,
            });

            // Add custom event listeners to the select2 widget
            $('#multiDropdown').on('change', function() {
                // Get the selected options
                let $data = $(this).val();

                // Update the selectedCities property from the Blade
                // with false indicating that no server request is made or simply use the method 2

                // method 1
                $wire.set('SelectedSkills', $data, false);

                // method 2
                // $wire.selectedCities =$data;
            });


        });
    </script>
@endscript
