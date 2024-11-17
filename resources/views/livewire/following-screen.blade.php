@include('livewire.navigation-bar')
<br>
<br>
<div class="container mt-4">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        <div class="col-md-3  ">
            <h4>Manage my network</h4>
            <ul class="list-unstyled">
                <nav>
             <li><i class="fas fa-user-friends me-2 mb-3 mt-3 mr-2"></i><strong>Following</strong> <span class="text-muted">1000</span></li>
            <a href="/Followers" wire:navigate>  <li><i class="fas fa-users me-2 mb-3 mr-2"></i>Followers <span class="text-muted">200</span></li> </a>
            <a href ="/CompaniesList" wire:navigate>   <li><i class="fas fa-building me-2 mr-3"></i>Companies <span class="text-muted">30</span></li> </a>
        </nav>
            </ul>
        </div>

        <!-- قسم قائمة الشركات -->
        <div class="col-md-9 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-2">Companies</h4>
            </div>
            @foreach($companies as $company)
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <div class="d-flex align-items-center">
                    <!-- صورة افتراضية للشركة -->
                    <img src="'https://via.placeholder.com/50/CCCCCC/FFFFFF?text=Logo' }}" 
                         alt="Logo" class="rounded-circle" width="50" height="50">
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

