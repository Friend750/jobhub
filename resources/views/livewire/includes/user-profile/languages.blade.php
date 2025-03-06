<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5>languages</h5>
        </div>

        <ul class="list-unstyled d-flex flex-wrap" x-data="languagesList">
            <li class="text-muted text-center py-3" x-show="languages.length === 0">No languages added yet</li>

            <template x-for="(language, index) in languages" :key="language.id">
                <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="language.language"
                    x-on:click="$wire.editLanguage(language.id)" data-bs-toggle="tooltip" title="Click to Edit">
                </li>
            </template>

            <template x-if="languages.length > defaultLimit">
                <li class="btn btn-secondary m-1"
                    x-on:click="limit === languages.length ? limit = defaultLimit : limit = languages.length"
                    x-text="limit === languages.length ? 'See Less' : '+' + (languages.length - limit) + ' more'">
                </li>
            </template>
        </ul>
    </div>
</div>

{{-- refresh_msg --}}
@if (session()->has('refresh_msg'))
    <div class="alert alert-success d-flex flex-wrap justify-content-between w-100">
        {{ session('refresh_msg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- modal EditLanguage -->
<div class="modal fade overflow-hidden" id="EditLanguage" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Choose the new language name</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between bg-light py-2 px-2 fw-bolder rounded text-muted">
                    <p>{{ $Selectedlanguage }}</p>
                    <p>Previous Name</p>
                </div>
                <!-- Search Input -->
                <input type="text" wire:model.live.debounce.300ms="lagSearchQuery" placeholder="Search languages..."
                    class="form-control rounded-0 border-0 border-bottom mb-2">

                <!-- language List -->
                <ul class="list-unstyled mb-0" style="height: 300px; overflow-y: auto;">
                    @forelse ($availableLanguages as $language)
                        <li class="w-100 text-start p-2 hover:bg-gray-100 pointer" data-bs-toggle="modal"
                            data-bs-target="#languageChangeModal" wire:click='selectLanguage({{ $language->id }})'>
                            {{ $language->language }}
                        </li>
                    @empty
                        <li class="p-2 text-muted">No languages found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Modal -->
@include('livewire.includes.user-profile.languageModal-box')



<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('languagesList', () => ({
            languages: @entangle('languages'),
            limit: 5,
            defaultLimit: 5,
        }));
    });
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('update-language', () => {
            let modalElement = document.getElementById('EditLanguage');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
            }
        });
    });
</script>
