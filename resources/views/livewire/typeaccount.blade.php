<div class="container container d-flex justify-content-center align-items-center vh-100">
    <div class="row col-md-6">

        <div class="rounded p-3 bg-light shadow-sm">
            <h2>What is your Account type?</h2>
            <p>Select whether your account will be for a company or a personal account</p>
            <hr>
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accountType" id="personal"
                            value="personal" wire:model="accountType">
                        <label class="form-check-label" for="personal">
                            Personal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accountType" id="company" value="company"
                            wire:model="accountType">
                        <label class="form-check-label" for="company">
                            Company
                        </label>
                    </div>
                </div>
                <div class="text-center">
                    <button wire:click="save" class="btn btn-primary rounded">
                        Next <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
