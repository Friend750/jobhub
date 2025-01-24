<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#languages">
        Languages
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('languages')"
                title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Enter the language(s) you speak.</p>
    <div id="languages" class="collapse show">
        <div id="languagesContainer">
            <div wire:ignore>

                <select class="form-select @error('LanguagesForm.languages') is-invalid @enderror"
                    id="LanguagesMultiDropdown" data-placeholder="e.g English or Spanish" multiple>
                    @foreach ($languages as $key => $language)
                        <option value="{{ $language->id }}">{{ $language->language }}</option>
                    @endforeach
                </select>

            </div>
            @error('LanguagesForm.languages')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

</section>
@script()
    <script>
        // Initialize the select2 widget with a placeholder text and allow multiple selection
        $(document).ready(function() {
            $('#LanguagesMultiDropdown').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: true,
                allowClear: true,
            });

            // Add custom event listeners to the select2 widget
            $('#LanguagesMultiDropdown').on('change', function() {
                // Get the selected options
                let $data = $(this).val();

                // Update the selectedCities property from the Blade
                // with false indicating that no server request is made or simply use the method 2

                // method 1
                $wire.set('Selectedlanguages', $data, false);

                // method 2
                // $wire.selectedCities =$data;
            });


        });
    </script>
@endscript
