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
            @if (session()->has('success'))
          <div class="alert alert-success">
           {{ session('success') }}
          </div>
         @endif
          <hr>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                @foreach ($interests as $interest)
                    <button 
                        class="btn interest-btn py-1 mb-3 mr-2 {{ in_array($interest, $selectedInterests) ? 'active' : '' }}"
                        wire:click="toggleInterest('{{ $interest }}')">
                        {{ $interest }}
                        @if (in_array($interest, $selectedInterests))
                            <i class="fa-solid fa-check"></i> <!-- Check icon for selected -->
                        @else
                            <i class="fa-solid fa-plus"></i> <!-- Add icon for not selected -->
                        @endif
                    </button>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-primary" wire:click="nextStep">
                    Next <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
