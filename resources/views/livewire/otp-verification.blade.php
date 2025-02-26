<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-4 shadow-sm mt-1 col-md-6 col-sm-8">
                <div class="card-body">
                    <div>
                        @if(session()->has('message'))
                        <p class="text-green-500">{{ session('message') }}</p>
                        @endif
                        @if(session()->has('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                        @endif
                        <input type="text" class="form-control" wire:model.live="otp" placeholder="Enter OTP">
                        <button wire:click="verifyOtp" class="btn btn-primary mt-3">Verify OTP</button>
                        @if(session()->has('success'))
                        <p class="text-green-500">{{ session('success') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
