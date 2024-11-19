{{-- @include('livewire.navigation-bar') --}}

<div class="container mt-4">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        <div class="col-md-3">
            <h5><i class="bi bi-arrow-left"></i> Manage my network</h5>

            <ul class="list-unstyled">
                <a href="/Following" wire:navigate>
                    <li class="d-flex justify-content-between text-muted">
                        <div>
                            <i class="fas fa-user-friends me-2 my-2 mr-2"></i> Following
                        </div>
                        <span>1000</span>
                    </li>
                </a>
                <li class="d-flex justify-content-between text-dark">
                    <div>
                        <i class="fas fa-users me-2 my-2 mr-2"></i><strong >Followers</strong>
                    </div>
                    <span><strong>197</strong></span>
                </li>
                <a href ="/CompaniesList" wire:navigate>
                    <li class="d-flex justify-content-between text-muted">
                        <div>
                            <i class="fas fa-building me-2 my-2 mr-2" style="padding: 0 4px;"></i>Companies
                        </div>
                        <span>30</span>
                    </li>
                </a>
            </ul>
        </div>

        <!-- قسم قائمة الشركات -->
        <div class="col-md-9 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-2">Companies</h4>
            </div>
            @foreach ($companies as $company)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div class="d-flex align-items-center">
                        <!-- صورة افتراضية للشركة -->
                        <img src="'https://via.placeholder.com/50/CCCCCC/FFFFFF?text=Logo' }}" alt="Logo"
                            class="rounded-circle" width="50" height="50">
                        <div class="ms-3">
                            <strong>{{ $company['name'] }}</strong>
                            <div class="text-muted">{{ $company['id'] }} followers</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm">Following</button>
                </div>
            @endforeach
        </div>
    </div>
</div>
