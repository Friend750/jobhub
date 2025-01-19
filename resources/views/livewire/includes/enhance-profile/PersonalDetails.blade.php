<section class="form-section mt-0 rounded">
    <h5 data-toggle="collapse" data-target="#personalDetails">
        <span>Personal Details</span>
        <i class="fas fa-caret-down caret-icon"></i>
    </h5>
    <p>This form is the only required to submit. You can go back later to fill in the rest of the sections from the
        Sidebar. </p>
    <div id="" class="collapse show">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" wire:model.defer="PDFrom.firstName"
                    placeholder="Enter Your First Name">
                @error('PDFrom.firstName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" wire:model.defer="PDFrom.lastName"
                    placeholder="Enter Your Last Name">
                @error('PDFrom.lastName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="jobTitle">Specialization Name</label>
                <input type="text" class="form-control" id="jobTitle" wire:model.defer="PDFrom.jobTitle"
                    placeholder="Enter Your Job Title">
                @error('PDFrom.jobTitle')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" wire:model.defer="PDFrom.email"
                    placeholder="Enter Your Email">
                @error('PDFrom.email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" wire:model.defer="PDFrom.phone"
                    placeholder="Enter Your Phone Number">
                @error('PDFrom.phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" wire:model.defer="PDFrom.city"
                    placeholder="Enter Your City Name">
                @error('PDFrom.city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

    </div>


</section>
