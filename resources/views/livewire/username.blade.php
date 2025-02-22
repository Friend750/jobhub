<div>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card p-4 shadow-sm mt-1 col-md-6 col-sm-8">
                    <div class="card-body">
                        @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <!-- Adjust width -->
                        @livewire('includes.check-username')
                        <button wire:click="updateUsername" class="btn btn-primary mt-3">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
