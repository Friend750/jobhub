<div class="row justify-content-center mb-3">

    <div class="card p-4 shadow-sm mt-5 col-md-4 col-sm-8">
        <h2 class="mb-4">Register</h2>
        
        <form wire:submit.prevent="register">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" class="form-control" placeholder="First and last names" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" class="form-control" placeholder="Email address" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="#" class="text-decoration-none">Already have an account? Sign in</a>
                <span class="position-relative" id="hide-show" style="cursor: pointer;"
                    onclick="togglePassword()">Hide</span>
            </div>

            <p class="text-muted small mb-4 text-center">By clicking Agree & Join, you agree to the Terms of Service, Privacy Policy, and Cookie Policy.</p>
            <button type="submit" class="btn btn-secondary w-100 mb-3">Register</button>
        </form>
        {{-- <div class="d-flex align-items-center mb-3">
            <hr class="flex-grow-1">
            <span class="mx-2">Or</span>
            <hr class="flex-grow-1">
        </div> --}}
        <button class="btn btn-light w-100">
            Register with
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Google G Logo"
                style="width: 50px; height: auto;">
        </button>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const passwordConfirmField = document.getElementById('password_confirmation');
        const toggleText = document.getElementById('hide-show');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordConfirmField.type = 'text';
            toggleText.innerHTML = 'Show';
        } else {
            passwordField.type = 'password';
            passwordConfirmField.type = 'password';
            toggleText.innerHTML = 'Hide';
        }
    }
</script>
