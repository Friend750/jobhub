<div class="card-body cardprofile text-start p-3" style="width: 200px;">
    <div class="text-center">
        <img src="https://ui-avatars.com/api/?name=User&size=80" class="rounded-circle border shadow-sm mb-2"
            alt="User Avatar" width="80" height="80" loading="lazy"
            style="object-fit: cover; background-color: #f8f9fa;">
    </div>
    <h5 class="card-title">User Name</h5>
    <p class="card-text">null</p>
    <a href="/user-profile" class="btn btn-outline-primary profile rounded w-100">View Profile</a>
    <div class="mt-3">
        <a href="#" class="d-block mb-2 nav-link">Language</a>
        @guest
            <a class="d-block mb-2 nav-link" href="{{ route('login') }}">Login</a>
            <a class="d-block mb-2 nav-link" href="{{ route('register') }}">Register</a>
        @endguest
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
            <a href="#" class="d-block mb-1 nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        @endauth
    </div>
</div>
