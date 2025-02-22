<section class="form-section rounded">

    <h5 data-toggle="collapse" data-target="#websitesLinks">
        {{ __('general.websites_social_links') }}
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button"
                x-on:click="toggleSection('websites_social_links')" title="{{ __('general.remove_section') }}">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </h5>
    <p>{{ __('general.websites_description') }}</p>
    <div id="websitesLinks" class="collapse show">

        @foreach ($WLForm->websites as $index => $website)
            <div class="row mb-3">
                <div class="form-group col-md-4">
                    <label class="mb-2"
                        for="website_name_{{ $index }}">{{ __('general.website_name') }}</label>
                    <input type="text"
                        class="form-control @error(" WLForm.websites.{$index}.website_name") is-invalid
                        @enderror"
                        id="website_name_{{ $index }}"
                        wire:model="WLForm.websites.{{ $index }}.website_name"
                        placeholder="{{ __('general.placeholder_website_name') }}">
                    @error("WLForm.websites.{$index}.website_name")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-auto flex-grow-1">
                    <label class="mb-2" for="link_{{ $index }}">{{ __('general.link') }}</label>
                    <div class="d-flex">
                        <input type="text"
                            class="form-control @error(" WLForm.websites.{$index}.link") is-invalid
                            @enderror"
                            wire:model="WLForm.websites.{{ $index }}.link"
                            placeholder="{{ __('general.placeholder_link') }}">
                        @if ($index > 0)
                            <i class="bi bi-trash-fill btn rounded" wire:click="removeRow({{ $index }})"></i>
                        @endif
                    </div>
                    @error("WLForm.websites.{$index}.link")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click="addRow">{{ __('general.add_link') }}
            </button>
        </div>
    </div>
</section>
