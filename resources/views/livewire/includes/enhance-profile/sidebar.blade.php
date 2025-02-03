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
