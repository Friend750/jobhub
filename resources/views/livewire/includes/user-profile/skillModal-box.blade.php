<div class="modal fade" id="skillChangeModal" tabindex="-1" aria-labelledby="skillChangeModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" style="max-width: fit-content;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skillChangeModalLabel">Change Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="fs-5 fw-bold mb-3 text-dark">
                    Are you sure you want to change <span class="text-muted" x-text="previousSkill"></span> to
                    <span class="text-success" x-text="selectedSkill"></span>?
                </h2>
                <p>{{ __('general.cannot_undo') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="width: 73px;">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click="UpdateSkill(selectedSkillID,previousSkillID)"
                    wire:loading.attr="disabled" wire:loading.class="disabled" style="min-width: 73px;">
                    <span wire:loading.remove>Yes</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Updating...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('updated-skill', () => {
            let modalElement = document.getElementById('skillChangeModal');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
