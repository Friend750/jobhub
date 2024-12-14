<div>
    <div class="container mt-5 col-8">
        <div class="p-4">
            <h3 class="text-center mb-3">What do you want to see on <span class="logo">Yemen Jobs?</span></h3>
            <p class="text-center">Select at least 2 interests to personalize your Yemen Jobs experience. They will be visible on your profile.</p>
            
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
          <hr>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                @foreach ($interests as $interest)
                    <button 
                        class="btn interest-btn py-1 mb-3 mr-2 {{ in_array($interest, $selectedInterests) ? 'active' : '' }}"
                        wire:click="toggleInterest('{{ $interest }}')">
                        {{ $interest }} <i class="fa-solid fa-plus"></i>
                    </button>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-primary px-4 py-2" wire:click="nextStep">
                    Next ➔
                </button>
            </div>
        </div>
    </div>
</div>
