@push('styles')
<link rel="stylesheet" href="{{ asset('css/Intrests.css') }}">
@endpush
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row col-md-8">
        <div class="rounded p-3 bg-light shadow-sm">
            <h2 class="">What do you want to see on <span class="logo">Yemen Jobs?</span></h2>
            <p class="">Select at least 2 interests to personalize your Yemen Jobs experience. They will be
                visible on
                your profile.</p>

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <hr>


            {{-- options logic --}}
            <div x-data="{
                interests: {{ json_encode($interests) }},
                selectedInterests: $wire.entangle('selectedInterests'),
                toggleInterest(interest) {
                    if (this.selectedInterests.includes(interest)) {
                        this.selectedInterests = this.selectedInterests.filter(i => i !== interest);
                    } else {
                        this.selectedInterests.push(interest);
                    }
                }
            }" class="d-flex flex-wrap justify-content-start gap-1 mt-1">
                <template x-for="interest in interests" :key="interest">
                    <button class="btn interest-btn py-1 mb-1 mr-2"
                        :class="{ 'active': selectedInterests.includes(interest) }" @click="toggleInterest(interest)">
                        <span x-text="interest"></span>
                        <i class="fa-solid" :class="selectedInterests.includes(interest) ? 'fa-check' : 'fa-plus'"></i>
                    </button>
                </template>
            </div>


            <div class="text-end mt-1">
                <button class="btn btn-primary rounded" wire:click="nextStep">
                    Next <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>
</div>
