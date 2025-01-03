
<div class="container mt-4 col-6">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        <div class="col-4">
            <h4 class="mt-3 mb-3">Manage My Network</h4>
            <ul class="list-unstyled">
             <a href="/Following" ><li><i class="fas fa-user-friends mr-2 mb-3"></i><strong>Following</strong> <span class="ml-2 text-muted">1000</span></li></a>
             <a href="Followers" > <li><i class="fas fa-users mr-2 mb-3 "></i><strong>Followers</strong> <span class="ml-2 text-muted">200</span></li> </a>
                <li><i class="fas fa-building mr-2 ml-1"></i><strong>Companies</strong> <span class="ml-1 text-muted">30</span></li>
            </ul>
        </div>

        <!-- قسم قائمة الشركات -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3">Companies</h4>
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

