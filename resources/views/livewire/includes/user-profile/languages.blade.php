<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5>languages</h5>
        </div>

        <ul class="list-unstyled d-flex flex-wrap" x-data="languagesList">
            <li class="text-muted text-center py-3" x-show="languages.length === 0">No languages added yet</li>

            <template x-for="(language, index) in languages" :key="language.id">
                <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="language.language"
                    x-on:click="$wire.selectlanguage(language.id,language.language)" data-bs-toggle="tooltip" title="Click to Edit">
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
                <p class="bg-light py-2 px-2 fw-bolder rounded text-muted">Previous Name: <span x-data="{ oldlanguage: @entangle('selectedlanguageName') }"
                        x-text="oldlanguage??'null'"></span></p>
                <!-- Search Input -->
                <input type="text" wire:model.live.debounce.300ms="searchQuery" placeholder="Search languages..."
                    class="form-control rounded-0 border-0 border-bottom mb-2">

                <!-- language List -->
                <ul class="list-unstyled mb-0" style="height: 300px; overflow-y: auto;">
                    @forelse ($availableLanguages as $language)
                        <li wire:click="editLanguage({{ $language->id }})"
                            class="w-100 text-start p-2 hover:bg-gray-100 pointer">
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
