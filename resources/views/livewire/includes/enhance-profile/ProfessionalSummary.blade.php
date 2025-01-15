<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#professionalSummary">
        <span>Professional Summary</span>
        <i class="fas fa-caret-down caret-icon"></i>
    </h5>
    <p>Write 2-4 short, energetic sentences about how great you are. Mention the role and what you did. What
        were the big achievements? Describe your motivation and list your skills.</p>
    <div id="professionalSummary" class="collapse">
        <div>
            <form wire:submit.prevent="saveProfessionalSummary">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" wire:model="PDFrom.description" rows="3"
                        placeholder="Add a description here..."></textarea>
                    @error('PDFrom.description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-end">
                    <button class="btn btn-primary rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
