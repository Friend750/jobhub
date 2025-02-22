<div class="col-md-8">
    @if (session()->has('message'))
        <div class="mt-0 alert alert-success alert-dismissible rounded fade show"
            style="width: 800px; margin: 10px auto;" role="alert">
            {{ __('general.success_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

    @include('livewire.includes.enhance-profile.PersonalDetails')

    <template x-if="activeSections.includes('websites_social_links')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.WebsitesSocialLinks')
    </template>

    <template x-if="activeSections.includes('education')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.Education')
    </template>

    <template x-if="activeSections.includes('courses')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.Courses')
    </template>

    <div x-show="activeSections.includes('skills')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.Skills')
    </div>

    <template x-if="activeSections.includes('experiences')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.Experiences')
    </template>

    <template x-if="activeSections.includes('projects')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.Projects')
    </template>

    <div x-show="activeSections.includes('languages')" x-cloak class="mb-4">
        @include('livewire.includes.enhance-profile.Languages')
    </div>
</div>
