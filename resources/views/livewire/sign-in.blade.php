<div class="row justify-content-center">

    <div class="card p-4 shadow-sm mt-5 col-md-4 col-sm-8">
        <h2 class="mb-4">Sign in</h2>
        <form wire:submit.prevent="submit">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address </label>
                <input type="email" id="email" class="form-control" placeholder="Email address" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="#" class="text-decoration-none">Forget your password?</a>
                <span class="position-relative" id="hide-show" style="cursor: pointer;"
                    onclick="togglePassword()">Hide</span>
            </div>

            <p class="text-muted small mb-4 text-center">By clicking Agree & Join or Continue, you agree to the Yemen
                Jobs User
                Agreement,
                Privacy Policy, and Cookie Policy.</p>
            <button type="submit" class="btn btn-secondary w-100 mb-3">Log in</button>
        </form>
        <div class="d-flex align-items-center mb-3">
            <hr class="flex-grow-1">
            <span class="mx-2">Or</span>
            <hr class="flex-grow-1">
        </div>
        <button class="btn btn-light w-100 mb-3">
            {{-- <i class="fab fa-google"></i> --}}
            Continue with
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Google G Logo"
                style="width: 50px; height: auto;">
        </button>
        <p class="text-center">Doesn't have an Account? <a href="#" class="text-decoration-none">Register</a></p>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleText = document.getElementById('hide-show');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleText.innerHTML = 'Show';
        } else {
            passwordField.type = 'password';
            toggleText.innerHTML = 'Hide';
        }
    }
</script>
