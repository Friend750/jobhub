<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#languages">
        {{ __('general.languages') }}
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" 
                x-on:click="toggleSection('languages')" title="{{ __('general.remove_section') }}">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>{{ __('general.languages_description') }}</p>
    <div id="languages" class="collapse show">
        <div id="languagesContainer">
            <div wire:ignore>
                <select class="form-select @error('LanguagesForm.languages') is-invalid @enderror"
                    id="LanguagesMultiDropdown" data-placeholder="{{ __('general.select_languages') }}" multiple>
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

            // Update the selectedLanguages property from the Blade
            $wire.set('Selectedlanguages', $data, false);
        });
    });
</script>
@endscript
