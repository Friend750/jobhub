<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5>
                {{$user->type == 'user' ? 'الملخص مهني' : 'نظرة عامة'}}
            </h5>
            @if (auth()->user()->id === $user->id)
                <i class="bi bi-pencil-square p-1 btn" data-bs-toggle="modal" data-bs-target="#GeneralInformation"
                    wire:click='getOldPS'></i>
            @endif
        </div>
        @if (empty($user->personal_details->professional_summary))
            <p class="text-muted text-center py-3">No professional summary added yet.</p>
        @else
            <p>{{ $user->personal_details->professional_summary }}</p>
        @endif
    </div>
</div>

<!-- modal General Information  -->
<div class="modal fade overflow-hidden" id="GeneralInformation" tabindex="-1" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    General Information
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="professionalSummary" class="collapse show">
                    <form wire:submit.prevent="saveSummary">

                        <div class="form-group mb-3">
                            <label for="description" class=" mb-2">Overview</label>
                            <textarea class="form-control @error('PSForm.description') is-invalid
                            @enderror" id="description" wire:model="PSForm.description" rows="3"
                                placeholder="Add a description here..."></textarea>
                            @error('PSForm.description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('GeneralInformation');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
