<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#websitesLinks">
        Websites & Social Links
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('websites_social_links')"  title="Remove section">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>You can add links to websites you want hiring managers to see! Perhaps it will be a link to your
        portfolio, or personal website.</p>
    <div id="websitesLinks" class="collapse show">
        <div class="row mb-3">
            @foreach ($WLForm->websites as $index => $website)
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="website_name_{{ $index }}">Website Name</label>
                    <input type="text" class="form-control @error(" WLForm.websites.{$index}.website_name") is-invalid
                        @enderror" id="website_name_{{ $index }}" wire:model="WLForm.websites.{{ $index }}.website_name"
                        placeholder="e.g., LinkedIn, GitHub">
                    @error("WLForm.websites.{$index}.website_name")
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group flex-grow-1">
                    <label for="link_{{ $index }}">Link</label>
                    <div class="d-flex">
                        <input type="text" class="form-control @error(" WLForm.websites.{$index}.link") is-invalid
                            @enderror" wire:model="WLForm.websites.{{ $index }}.link"
                            placeholder="e.g., https://linkedin.com/in/yourprofile">
                        @if ($index > 0)
                        <i class="bi bi-trash-fill btn rounded ms-1" wire:click="removeRow({{ $index }})"></i>
                        @endif
                    </div>
                    @error("WLForm.websites.{$index}.link")
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            @endforeach

        </div>


        <div class="d-flex justify-content-between align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click="addRow">+ Add one more
                Link</button>
        </div>
    </div>
</section>
