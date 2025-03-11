<div x-data="websites(@this)">
    <!-- Contact Modal -->
    <div class="modal fade overflow-hidden" id="contactModal" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Contact Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <p><strong class="text-dark">Your Profile URL:</strong><br> John Doe</p>
                        <p><strong class="text-dark">Email:</strong> <br>
                            {{ $user->email ?? 'example@example.com' }}</p>
                        <p><strong class="text-dark">Phone:</strong> <br>
                            {{ $user->personal_details->phone ?? 'phone' }}
                        </p>
                        <p><strong class="text-dark">Websites & Social links:</strong></p>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse ($user->links as $link)
                                <div
                                    class="d-flex justify-content-between align-items-center mb-2 bg-dark p-2 px-3 rounded">
                                    <a href="{{ $link->link }}" target="_blank" class="text-light"
                                        style="text-decoration: none;">
                                        {{ $link->website_name }}
                                    </a>

                                    {{-- if user is the owner --}}
                                    @if (auth()->user()->id === $user->id)
                                        <div class="d-flex gap-2 me-2">
                                            <span class="text-light" style="cursor: pointer;" x-on:click.prevent.stop
                                                x-on:click="openModal('EditLink', {{ $link->id }})">
                                                <i class="fa-regular fa-pen-to-square" data-bs-toggle="tooltip"
                                                    title="Edit this website"></i>
                                            </span>
                                        </div>
                                    @else
                                        <i class="fas fa-globe text-light me-2"></i>
                                    @endif
                                </div>
                            @empty
                                <span class="text-muted">No websites added.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EditLink Modal -->
    <div class="modal fade overflow-hidden" id="EditLink" tabindex="-1" aria-labelledby="EditLinkLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLinkLabel">Edit Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body (empty for now) -->
                <div class="modal-body">

                    @foreach ($WLForm->websites as $index => $website)
                        <div class="row mb-3">
                            <div class="form-group col-md-4">
                                <label class="mb-2"
                                    for="website_name_{{ $index }}">{{ __('general.website_name') }}</label>
                                <input type="text"
                                    class="form-control @error(" WLForm.websites.{$index}.website_name") is-invalid
                                @enderror"
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

                                </div>
                                @error("WLForm.websites.{$index}.link")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn rounded btn-secondary" x-on:click="deleteLink">
                        <i class="fas fa-trash"></i>
                    </button>

                    <button type="button" class="btn rounded btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>

                    </button> <button type="button" class="btn rounded btn-primary" wire:loading.attr='disabled'
                        x-on:click="updateLink()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function websites($wire) {
        return {
            Link_id: null,
            openModal: function(modalName, id) {
                this.Link_id = id;
                // Hide the contactModal
                const contactModal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
                if (contactModal) {
                    contactModal.hide();
                }
                // Show the EditLink modal
                const editModal = bootstrap.Modal.getOrCreateInstance(document.getElementById(modalName));
                editModal.show();
                // call a livewire method
                $wire.getLink(id);
            },
            updateLink: function() {
                $wire.updateLink(this.Link_id);
                const editModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('EditLink'));
                editModal.hide();
            },
            deleteLink: function() {
                $wire.deleteLink(this.Link_id);
                const editModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('EditLink'));
                editModal.hide();
            }
        }
    }
</script>
