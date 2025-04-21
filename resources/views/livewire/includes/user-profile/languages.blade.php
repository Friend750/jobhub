<!-- Languages Card and Modal -->
<div x-data="languageComponent()">
    <!-- Languages Card -->
    <div class="card mb-3 rounded">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5>اللغات</h5>
            </div>

            <!-- Languages List -->
            <ul class="list-unstyled d-flex flex-wrap">
                <li class="text-muted text-center py-3" x-show="languages.length === 0">لم تتم إضافة أي لغات بعد</li>

                <template x-for="(language, index) in languages" :key="language . id">
                    <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="language.language"
                        @click="openEditModal(language)" data-bs-toggle="tooltip" title="انقر للتحرير">
                    </li>
                </template>

                <template x-if="languages.length > defaultLimit">
                    <li class="btn btn-secondary m-1"
                        @click="limit === languages.length ? limit = defaultLimit : limit = languages.length"
                        x-text="limit === languages.length ? 'شاهد أقل' : '+' + (languages.length - limit) + ' المزيد'">
                    </li>
                </template>
            </ul>
        </div>
    </div>

    <!-- Refresh Message -->
    @if (session()->has('language_updated'))
        <div class="alert alert-success d-flex flex-wrap justify-content-between w-100">
            {{ session('language_updated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('language_deleted'))
        <div class="alert alert-success d-flex flex-wrap justify-content-between w-100">
            {{ session('language_deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Language Modal -->
    <div class="modal fade overflow-hidden" id="EditLanguage" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">اختر اسم اللغة الجديدة</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button> --}}
                </div>
                <div class="modal-body">

                    <!-- Search Input -->
                    <input type="text" x-model="searchQuery" placeholder="البحث عن اللغات..."
                        class="form-control rounded-0 border-0 border-bottom mb-2">

                    <!-- Filtered Languages List -->
                    <ul class="list-unstyled mb-0" style="height: 300px; overflow-y: auto;">
                        <template x-for="language in filteredLanguages" :key="language . id">
                            <li class="w-100 text-start p-2 hover:bg-gray-100 pointer"
                            @click="{{ auth()->user()->id === $user->id ? 'selectLanguage(language)' : ''
                            }}  ">
                                <span x-text="language.language"></span>
                            </li>
                        </template>
                        <template x-if="filteredLanguages.length === 0">
                            <li class="p-2 text-muted">لم يتم العثور على لغات.</li>
                        </template>
                    </ul>

                    {{-- delete button --}}
                    <div class="text-center mt-3">
                        <small class="text-muted">أو يمكنك فقط حذف اللغة الحالية"<span x-text="previousLanguage"
                                class="fw-bold"></span>"</small>
                        <button type="button" class="btn btn-danger mt-2 w-100 rounded" data-bs-dismiss="modal"
                            wire:click="deleteLanguage(previousLanguageID)" wire:loading.attr="disabled"
                            wire:loading.class="disabled">حذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.includes.user-profile.languageModal-box')

</div>



<script>
    function languageComponent() {
        return {
            // Component State
            languages: @json($languages), // Pass Laravel data to Alpine.js
            availableLanguages: @json($availableLanguages), // Pass Laravel data to Alpine.js
            previousLanguage: '',
            selectedLanguage: null,
            selectedLanguageID: 0,
            previousLanguageID: 0,
            searchQuery: '',
            limit: 5,
            defaultLimit: 5,

            // Computed Property for Filtered Languages
            get filteredLanguages() {
                return this.availableLanguages.filter(language => {
                    return language.language.toLowerCase().includes(this.searchQuery.toLowerCase());
                });
            },

            // Open Edit Modal
            openEditModal(language) {
                this.previousLanguage = language.language;
                this.previousLanguageID = language.id;
                bootstrap.Modal.getOrCreateInstance(document.getElementById('EditLanguage')).show();
            },


            selectLanguage(language) {
                this.selectedLanguage = language.language;
                this.selectedLanguageID = language.id;

                bootstrap.Modal.getOrCreateInstance(document.getElementById('EditLanguage')).hide();
                bootstrap.Modal.getOrCreateInstance(document.getElementById('languageChangeModal')).show();
            }

        };
    }
</script>
