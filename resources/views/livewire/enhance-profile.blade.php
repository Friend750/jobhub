<div>
    <div class="container mt-5">
        <!-- Personal Details -->
        @include('livewire.includes.enhance-profile.PersonalDetails')

        <!-- Professional Summary -->
        @include('livewire.includes.enhance-profile.ProfessionalSummary')

        <!-- Websites & Social Links -->
        @include('livewire.includes.enhance-profile.WebsitesSocialLinks')

        <!-- Education -->
        @include('livewire.includes.enhance-profile.Education')

        <!-- Courses -->
        @include('livewire.includes.enhance-profile.Courses')

        <!-- Skills -->
        @include('livewire.includes.enhance-profile.Skills')

        <!-- Experiences -->
        @include('livewire.includes.enhance-profile.Experiences')

        <!-- Projects -->
        @include('livewire.includes.enhance-profile.Projects')

        <!-- Languages -->
        @include('livewire.includes.enhance-profile.Languages')

        <!-- Confirm Button -->
        <div class="center-container">
            <button class="btn-confirm btn btn-primary rounded">Confirm</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/enhanceProfile.js') }}"></script>

