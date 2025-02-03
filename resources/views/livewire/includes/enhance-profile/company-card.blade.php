<div x-data="{ step: 1 }" class="card p-4 rounded shadow-sm">
    <h2>Let's make People know more about your <span class="text-primary">Business</span></h2>
    <form wire:submit.prevent="saveCompanyForm">

        <!-- Step 1: Page Name -->
        <div x-show="step === 1" x-transition.duration.1000ms>
            <div class="form-group w-100 mt-3">
                <label class="mb-2" for="page_name">Page Name</label>
                <input type="text" wire:model.defer="CompanyPageForm.page_name" class="form-control" id="page_name"
                    placeholder="Enter Page Name">


            </div>
        </div>

        <!-- Step 2: About -->
        <div x-show="step === 2" x-transition.duration.1000ms x-cloak>
            <div class="form-group w-100 mt-3">
                <label class="mb-2" for="description">About</label>
                <textarea wire:model.defer="CompanyPageForm.description" class="form-control" rows="3"
                    placeholder="Tell more about the Page"
                    oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'">
                    </textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">

            <div x-show="step > 1" x-transition>
                <button type="button" class="btn btn-secondary rounded" @click="step--">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button type="submit" class="btn btn-primary rounded">Continue</button>
            </div>

            <button type="button" class="btn btn-primary rounded" @click="step++" x-show="step < 2" x-transition>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>

    </form>

</div>

@error('CompanyPageForm.page_name')
    <div class="alert alert-danger rounded mt-2 alert-dismissible rounded fade show" role="alert">
        <small>{{ $message }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert">
    </div>
@enderror

@error('CompanyPageForm.description')
    <div class="alert alert-danger rounded mt-2 alert-dismissible rounded fade show" role="alert">
        <small>{{ $message }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert">
    </div>
@enderror
