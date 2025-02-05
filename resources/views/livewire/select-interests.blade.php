@push('styles')
<link rel="stylesheet" href="{{ asset('css/Intrests.css') }}">
@endpush

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row col-md-8">
        <div class="rounded p-3 bg-light shadow-sm">
            <h2>{{ __('general.what_to_see', ['appName' => 'Yemen Jobs']) }}</h2>
            <p>{{ __('general.select_interests', ['appName' => 'Yemen Jobs']) }}</p>

            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <hr>

            <!-- Alpine Component -->
            <div x-data="{
                    groupedInterests: @js($groupedInterests),
                    selectedInterests: $wire.entangle('selectedInterests'),
                    selectedType: '', // which type the user picks from the dropdown

                    toggleInterest(interest) {
                        if (this.selectedInterests.includes(interest)) {
                            this.selectedInterests =
                                this.selectedInterests.filter(i => i !== interest);
                        } else {
                            this.selectedInterests.push(interest);
                        }
                    }
                }" class="d-flex flex-column gap-3">
                <!-- STEP 1: Type Selection -->
                <div class="mb-2">
                    <label class="form-label">{{ __('Select a category') }}</label>
                    <select class="form-select" x-model="selectedType">
                        <option value="">{{ __('-- Choose an interest type --') }}</option>
                        <template x-for="(interestsList, typeName) in groupedInterests" :key="typeName">
                            <option :value="typeName" x-text="typeName"></option>
                        </template>
                    </select>
                </div>

                <!-- STEP 2: Show interests for the chosen type -->
                <template x-if="selectedType">
                    <div>
                        <!-- Display the type name as a heading -->
                        <h5 class="mb-2" x-text="selectedType"></h5>

                        <div class="d-flex flex-wrap gap-2">
                            <!-- Loop through each interest in the selected type -->
                            <template x-for="interest in groupedInterests[selectedType]" :key="interest">
                                <button class="btn interest-btn py-1"
                                    :class="{ 'active': selectedInterests.includes(interest) }"
                                    @click="toggleInterest(interest)">
                                    <span x-text="interest"></span>
                                    <i class="fa-solid"
                                        :class="selectedInterests.includes(interest) ? 'fa-check' : 'fa-plus'">
                                    </i>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- STEP 3: Display chosen interests -->
                <!-- Only show this section if at least one interest is selected -->
                <template x-if="selectedInterests.length > 0">
                    <div class="mt-2">
                        <strong>{{ __('You selected:') }}</strong>
                        <div class="mt-1 d-flex flex-wrap gap-1">
                            <template x-for="interest in selectedInterests" :key="interest">
                                <!-- Make this badge clickable to remove (toggle) the interest -->
                                <span class="badge rounded-pill btn-primary text-white d-inline-flex align-items-center"
                                    style="cursor: pointer" @click="toggleInterest(interest)">
                                    <span x-text="interest"></span>
                                    &nbsp;
                                    <!-- Optionally add an icon or "x" to emphasize removing -->
                                    <i class="bi bi-x-circle"></i>
                                </span>
                            </template>
                        </div>
                    </div>
                </template>


                <!-- Next Button -->
                <div class="text-end mt-3">
                    <button class="btn btn-primary rounded" wire:click="nextStep">
                        {{ __('general.next') }}
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>