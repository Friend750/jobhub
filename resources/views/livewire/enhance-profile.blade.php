@push('styles')
<link rel="stylesheet" href="{{ asset('css/enhanceProfile.css') }}">
@endpush

<div>
    <div class="container mt-5">
        <form wire:submit.prevent="saveAllForms" class="row d-flex justify-content-center">

            <!-- Main Layout -->
            <div x-data="sectionManager(@this)">
                <div class="row">

                    <!-- Content Area -->
                    <div class="col-md-9">
                        @if (session()->has('message'))
                            <div class="mt-0 alert alert-success alert-dismissible rounded fade show"
                                style="width: 800px; margin: 10px auto;" role="alert">
                                {{ __('general.success_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @include('livewire.includes.enhance-profile.PersonalDetails')

                        <div x-show="activeSections.includes('professional_summary')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.ProfessionalSummary')
                        </div>
                        <div x-show="activeSections.includes('websites_social_links')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.WebsitesSocialLinks')
                        </div>
                        <div x-show="activeSections.includes('education')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.Education')
                        </div>
                        <div x-show="activeSections.includes('courses')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.Courses')
                        </div>
                        <div x-show="activeSections.includes('skills')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.Skills')
                        </div>
                        <div x-show="activeSections.includes('experiences')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.Experiences')
                        </div>
                        <div x-show="activeSections.includes('projects')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.Projects')
                        </div>
                        <div x-show="activeSections.includes('languages')" x-cloak class="mb-4">
                            @include('livewire.includes.enhance-profile.Languages')
                        </div>
                    </div>

                    <!-- Sidebar with options -->
                    <div class="col-md-3">
                        <div class="list-group rounded MakeSticky">
                            <a href="#" class="list-group-item list-group-item-action disabled text-muted">
                                <i class="bi bi-person"></i> {{ __('general.personal_details') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('professional_summary')"
                                :class="{
                                    'disabled': activeSections.includes('professional_summary'),
                                    'text-muted': activeSections.includes('professional_summary')
                                }">
                                <i class="bi bi-card-text"></i> {{ __('general.professional_summary') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('websites_social_links')"
                                :class="{
                                    'disabled': activeSections.includes('websites_social_links'),
                                    'text-muted': activeSections.includes('websites_social_links')
                                }">
                                <i class="bi bi-link"></i> {{ __('general.websites_social_links') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('education')"
                                :class="{
                                    'disabled': activeSections.includes('education'),
                                    'text-muted': activeSections.includes('education')
                                }">
                                <i class="bi bi-pencil"></i> {{ __('general.education') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('courses')"
                                :class="{
                                    'disabled': activeSections.includes('courses'),
                                    'text-muted': activeSections.includes('courses')
                                }">
                                <i class="bi bi-journal"></i> {{ __('general.courses') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('skills')"
                                :class="{
                                    'disabled': activeSections.includes('skills'),
                                    'text-muted': activeSections.includes('skills')
                                }">
                                <i class="bi bi-lightbulb"></i> {{ __('general.skills') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('experiences')"
                                :class="{
                                    'disabled': activeSections.includes('experiences'),
                                    'text-muted': activeSections.includes('experiences')
                                }">
                                <i class="bi bi-briefcase"></i> {{ __('general.experiences') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('projects')"
                                :class="{
                                    'disabled': activeSections.includes('projects'),
                                    'text-muted': activeSections.includes('projects')
                                }">
                                <i class="bi bi-folder"></i> {{ __('general.projects') }}
                            </a>
                            <a href="#" class="list-group-item list-group-item-action"
                                @click.prevent="toggleSection('languages')"
                                :class="{
                                    'disabled': activeSections.includes('languages'),
                                    'text-muted': activeSections.includes('languages')
                                }">
                                <i class="bi bi-translate"></i> {{ __('general.languages') }}
                            </a>

                            <!-- Confirm Button -->
                            <button class="btn btn-primary rounded flex-grow-1 mt-2">
                                {{ __('general.confirm_save') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // if we want to use $wire in alpine scope we need to pass wire to the component name 'sectionManager' then receive as '@this'
    document.addEventListener('alpine:init', () => {
        Alpine.data('sectionManager', (wire) => ({ // 'wire' important to access Livewire properties
            activeSections: [],
            toggleSection(section) {
                if (this.activeSections.includes(section)) {
                    this.activeSections = this.activeSections.filter(s => s !== section);
                } else {
                    this.activeSections.push(section);
                }
                wire.set('activeSections', this.activeSections);
            }
        }));
    });
</script>