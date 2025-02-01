<section class="form-section mt-0 rounded">
    <h5 data-toggle="collapse" data-target="#personalDetails">
        <span>Personal Details</span>
        <i class="fas fa-caret-down caret-icon"></i>
    </h5>
    <p>This form is the only required to submit. You can go back later to fill in the rest of the sections from the
        Sidebar. </p>
    <div id="" class="collapse show">

        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label for="firstName" class="mb-2">First Name</label>
                <input type="text"
                    class="form-control  @error('PDFrom.firstName') is-invalid
                @enderror" id="firstName"
                    wire:model.defer="PDFrom.firstName" placeholder="Enter Your First Name">
                @error('PDFrom.firstName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="lastName" class="mb-2">Last Name</label>
                <input type="text"
                    class="form-control @error('PDFrom.lastName') is-invalid
                @enderror" id="lastName"
                    wire:model.defer="PDFrom.lastName" placeholder="Enter Your Last Name">
                @error('PDFrom.lastName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label for="jobTitle" class="mb-2">Specialization Name</label>
                <input type="text"
                    class="form-control @error('PDFrom.jobTitle') is-invalid
                @enderror" id="jobTitle"
                    wire:model.defer="PDFrom.jobTitle" placeholder="Enter Your Job Title">
                @error('PDFrom.jobTitle')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="email" class="mb-2">Email</label>
                <input type="email" class="form-control @error('PDFrom.email') is-invalid
                @enderror"
                    id="email" wire:model.defer="PDFrom.email" placeholder="Enter Your Email">
                @error('PDFrom.email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label for="phone" class="mb-2">Phone</label>
                <input type="text" class="form-control @error('PDFrom.phone') is-invalid
                @enderror"
                    id="phone" wire:model.defer="PDFrom.phone" placeholder="Enter Your Phone Number">
                @error('PDFrom.phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="city" class="mb-2">City</label>
                <input type="text" class="form-control @error('PDFrom.city') is-invalid
                @enderror"
                    id="city" wire:model.defer="PDFrom.city" placeholder="Enter Your City Name">
                @error('PDFrom.city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

    </div>


</section>
