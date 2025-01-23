<div>
    <div class="container mt-5" x-data="app">
        <div>
            <form wire:submit.prevent="saveAllForms" class="row row d-flex justify-content-center">
                <!-- Content area -->
                <div class="col-md-7">
                    @include('livewire.includes.enhance-profile.PersonalDetails')

                    <template x-for="section in activeSections" :key="section">
                        <div class="rounded position-relative">
                            <!-- Section content -->

                            <div x-show="section === 'professional_summary'">
                                @include('livewire.includes.enhance-profile.ProfessionalSummary')
                            </div>

                            <div x-show="section === 'websites_social_links'">
                                @include('livewire.includes.enhance-profile.WebsitesSocialLinks')
                            </div>

                            <div x-show="section === 'education'">

                                @include('livewire.includes.enhance-profile.Education')
                            </div>

                            <div x-show="section === 'courses'">
                                @include('livewire.includes.enhance-profile.Courses')
                            </div>

                            <div x-show="section === 'skills'">
                                @include('livewire.includes.enhance-profile.Skills')
                            </div>

                            <div x-show="section === 'experiences'">
                                @include('livewire.includes.enhance-profile.Experiences')
                            </div>

                            <div x-show="section === 'projects'">
                                @include('livewire.includes.enhance-profile.Projects')
                            </div>

                            <div x-show="section === 'languages'">
                                @include('livewire.includes.enhance-profile.Languages')
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Sidebar with options -->
                <div class="col-md-3">
                    <div class="list-group rounded">
                        <a href="#" class="list-group-item list-group-item-action disabled text-muted">
                            <i class="bi bi-person"></i> Personal Details
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('professional_summary')" :class="{
                                'disabled': activeSections.includes('professional_summary'),
                                'text-muted': activeSections.includes('professional_summary')
                            }">
                            <i class="bi bi-card-text"></i> Professional Summary
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('websites_social_links')" :class="{
                                'disabled': activeSections.includes('websites_social_links'),
                                'text-muted': activeSections.includes('websites_social_links')
                            }">
                            <i class="bi bi-link"></i> Websites & Social Links
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('education')" :class="{
                                'disabled': activeSections.includes('education'),
                                'text-muted': activeSections.includes('education')
                            }">
                            <i class="bi bi-pencil"></i> Education
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('courses')" :class="{
                                'disabled': activeSections.includes('courses'),
                                'text-muted': activeSections.includes('courses')
                            }">
                            <i class="bi bi-journal"></i> Courses
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('skills')" :class="{
                                'disabled': activeSections.includes('skills'),
                                'text-muted': activeSections.includes('skills')
                            }">
                            <i class="bi bi-lightbulb"></i> Skills
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('experiences')" :class="{
                                'disabled': activeSections.includes('experiences'),
                                'text-muted': activeSections.includes('experiences')
                            }">
                            <i class="bi bi-briefcase"></i> Experiences
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('projects')" :class="{
                                'disabled': activeSections.includes('projects'),
                                'text-muted': activeSections.includes('projects')
                            }">
                            <i class="bi bi-folder"></i> Projects
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"
                            @click.prevent="toggleSection('languages')" :class="{
                                'disabled': activeSections.includes('languages'),
                                'text-muted': activeSections.includes('languages')
                            }">
                            <i class="bi bi-translate"></i> Languages
                        </a>

                        <!-- Confirm Button -->
                        <button class="btn btn-primary rounded flex-grow-1 mt-2" type="submit">Confirm &
                            Save all</button>

                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<script src="{{ asset('js/enhanceProfile.js') }}"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('app', () => ({
            activeSections: [],

            toggleSection(section) {
                if (this.activeSections.includes(section)) {
                    // Remove the section if it exists
                    this.activeSections = this.activeSections.filter(s => s !== section);
                } else {
                    // Add the section if it doesn't exist
                    this.activeSections.push(section);
                }
            },
            removeSection(section) {
                // Remove the section from activeSections
                this.activeSections = this.activeSections.filter(s => s !== section);
            }
        }));
    });
</script>

@script()
<script>
    // Initialize the select2 widget with a placeholder text and allow multiple selection
        $(document).ready(function() {
            $('#multiDropdown').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            // Add custom event listeners to the select2 widget
            $('#multiDropdown').on('change', function() {
                // Get the selected options
                let $data = $(this).val();

                // Update the selectedCities property from the Blade
                // with false indicating that no server request is made or simply use the method 2

                // method 1
                $wire.set('SelectedSkills', $data, false);

                // method 2
                // $wire.selectedCities =$data;
            });
        });
</script>
@endscript