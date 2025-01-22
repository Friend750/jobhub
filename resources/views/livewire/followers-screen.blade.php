
<div class="container mt-4 col-8">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        @livewire('manage-network')


        <!-- قسم قائمة الشركات -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3">Followers</h4>
            </div>
            @foreach ($followers as $follower)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2 position-relative">
                    <div class="d-flex align-items-center">
                        <!-- صورة افتراضية للشركة -->
                        <img src="https://via.placeholder.com/50/CCCCCC/FFFFFF?text=Logo" alt="Logo"
                            class="rounded-circle" loading="lazy" width="50" height="50">
                        <div class="ms-3">
                            <strong>{{ $follower['user_name'] }}</strong>
                            <div class="text-muted">{{ $follower['position'] }}</div>
                        </div>
                    </div>

                    <div class="dropdown">
                        <!-- الأيقونة -->
                        <i class="fa-solid fa-ellipsis-vertical btn" id="dropdownMenuButton{{ $follower['id'] }}"
                            data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                        <!-- القائمة المنسدلة -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $follower['id'] }}">
                            <li><button wire:click='deleteConnection({{$follower['id']}})' class="dropdown-item">Remove Follower</button></li>
                            <li><a class="dropdown-item" href="#">View Profile</a></li>
                        </ul>
                        <a 
                        href="#" 
                        wire:click.prevent="startConversation({{ $follower['id'] }})"
                        class="btn"
                    >
                        <i class="fa-regular fa-paper-plane"></i>
                    </a>                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>
