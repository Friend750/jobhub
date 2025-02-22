<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#professionalSummary">
        <span>{{ __('general.professional_summary') }}</span>
    </h5>
    <p>{{ __('general.summary_description') }}</p>
    <div id="professionalSummary" class="collapse show">
        <div>
            <div class="form-group">
                <label class="mb-2" for="description">{{ __('general.description') }}</label>
                <textarea class="form-control @error('PSForm.description') is-invalid @enderror" id="description"
                    wire:model="PSForm.description" rows="3" placeholder="{{ __('general.placeholder_description') }}"
                    oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'"></textarea>
                @error('PSForm.description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</section>
