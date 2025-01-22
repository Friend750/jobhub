<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#professionalSummary">
        <span>Professional Summary</span>
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('professional_summary')" title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Write 2-4 short, energetic sentences about how great you are. Mention the role and what you did. What
        were the big achievements? Describe your motivation and list your skills.</p>
    <div id="professionalSummary" class="collapse show">
        <div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" wire:model="PSForm.description" rows="3"
                    placeholder="Add a description here..."></textarea>
                @error('PSForm.description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</section>
