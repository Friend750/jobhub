<div x-data="{ step: 1 }" class="card p-4 rounded shadow-sm">
    <h2>Let's make People know more about your <span class="text-primary">Business</span></h2>
    <form wire:submit.prevent="saveCompanyForm">

        <!-- Step 1: Page Name -->
        <div x-show="step === 1" x-transition.duration.1000ms>
            <div class="form-group w-100 mt-3">
                <label class="mb-2" for="page_name">Page Name</label>
                <input type="text" wire:model.defer="CompanyPageForm.page_name"
                    class="form-control @error('CompanyPageForm.page_name') is-invalid @enderror" id="page_name"
                    placeholder="Enter Page Name">

                <div class="form-group w-100 mt-3">
                    <label class="mb-2" for="description">About</label>
                    <textarea wire:model.defer="CompanyPageForm.description"
                        class="form-control @error('CompanyPageForm.description') is-invalid @enderror" rows="3"
                        placeholder="Tell more about the Page"
                        oninput="this.style.height = ''; this.style.height = (this.scrollHeight+5) + 'px'">
                    </textarea>
                </div>

            </div>
        </div>

        <!-- Step 2: About -->
        <div x-show="step === 2" x-transition.duration.1000ms x-cloak>
            {{-- loaction input --}}
            <div class="form-group w-100 mt-3">
                <label class="mb-2" for="city">City</label>
                <input type="text" wire:model.defer="CompanyPageForm.city"
                    class="form-control @error('CompanyPageForm.city') is-invalid @enderror" id="city"
                    placeholder="Enter the city name">
            </div>

            {{-- phone input --}}
            <div class="form-group w-100 mt-3">
                <label class="mb-2" for="phone">Contact</label>
                <input type="text" class="form-control @error('CompanyPageForm.phone') is-invalid @enderror"
                    id="phone" wire:model.defer="CompanyPageForm.phone" placeholder="Enter phone number">
            </div>
        </div>

        <!-- Step 3: Wibsites -->
        <div x-show="step === 3" x-transition.duration.1000ms x-cloak>
            <div class="row">

                <div class="form-group col-md-4 mt-3">
                    <label class="mb-2" for="website">Website name</label>
                    <input type="text" wire:model.defer="CompanyPageForm.website"
                        class="form-control @error('CompanyPageForm.website') is-invalid @enderror" id="website"
                        placeholder="Enter the website URL">
                </div>

                <div class="form-group col-md-8 mt-3">
                    <label class="mb-2" for="link">Link</label>
                    <input type="text" wire:model.defer="CompanyPageForm.link"
                        class="form-control @error('CompanyPageForm.link') is-invalid @enderror" id="link"
                        placeholder="Enter the link">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">

            <div x-show="step > 1" x-transition>
                <button type="button" class="btn btn-secondary rounded" @click="step--">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button type="submit" x-show="step > 2" class="btn btn-primary rounded">Continue</button>
            </div>

            <button type="button" class="btn btn-primary rounded ms-1" @click="step++" x-show="step < 3" x-transition>
                Next
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

@error('CompanyPageForm.city')
    <div class="alert alert-danger rounded mt-2 alert-dismissible rounded fade show" role="alert">
        <small>{{ $message }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert">
    </div>
@enderror

@error('CompanyPageForm.phone')
    <div class="alert alert-danger rounded mt-2 alert-dismissible rounded fade show" role="alert">
        <small>{{ $message }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert">
    </div>
@enderror


@error('CompanyPageForm.website')
    <div class="alert alert-danger rounded mt-2 alert-dismissible rounded fade show" role="alert">
        <small>{{ $message }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert">
        </button>
    </div>
@enderror

@error('CompanyPageForm.link')
    <div class="alert alert-danger rounded mt-2 alert-dismissible rounded fade show" role="alert">
        <small>{{ $message }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert">
        </button>
    </div>
@enderror
