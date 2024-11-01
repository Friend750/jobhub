<div>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <div class="profile-header" style="background-color: #333; height: 150px;"></div>
                <img src="https://via.placeholder.com/150" class="rounded-circle profile-img" alt="Profile Image"
                    style="position: relative; top: -75px; left: 15px; border: 5px solid white;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name ?? 'user name' }}</h5>
                    <p class="card-text">User Specialist</p>
                    <p class="card-text"><small class="text-muted">Sana‘a, Yemen</small></p>
                    <p class="card-text"><a href="#" class="text-primary">Contact info</a></p>
                    <p class="card-text">N Connections</p>
                    <button class="btn btn-outline-secondary">Enhance Profile</button>
                    <button class="btn btn-outline-secondary">More</button>
                </div>
            </div>
        </div>
    </div>
</div>
