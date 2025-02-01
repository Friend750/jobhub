<div class="bg-wight">

    <!-- Navbar -->
    <nav class="navbar w-100 bg-wight fixed-top">
        <div class="container">
            <div class="nav-left d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="#">
                    <span class="logoName">{{ __('general.logo') }}</span>
                </a>
            </div>
            <div class="nav-right">
                <div class="d-flex" role="search">
                    <a href="register" class="btn text-primary mr-2" type="submit"><b>{{ __('general.join_now') }}</b></a>
                    <a href="login"><button class="btn btn-outline-primary" type="submit"><b>{{ __('general.sign_in') }}</b></button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center mb-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h1>{{ __('general.hero_title') }}</h1>
                    <p>{{ __('general.hero_description') }}</p>
                    <a href="register" class="btn btn-primary mb-3">{{ __('general.join') }}</a>
                    <button class="btn color-bg-blue-light mb-3">
                        {{ __('general.continue_with') }}
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                            alt="Google G Logo" style="width: 50px; height: auto;">
                    </button>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/hero.png') }}" alt="Hero Image" class="img-fluid custom-image w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <img src="{{ asset('images/features.png') }}" alt="features Image" loading="lazy"
                        class="img-fluid custom-image w-100">
                </div>
                <div class="col-md-6">
                    <h2>{{ __('general.features_title') }}</h2>
                    <p>{{ __('general.features_description') }}</p>
                    <ul>
                        <li><strong>{{ __('general.resume_builder') }}</strong></li>
                        <li><strong>{{ __('general.job_alerts') }}</strong></li>
                    </ul>
                    <a href="login" class="btn btn-primary mb-3 mt-2">{{ __('general.start_now') }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- More Features Section -->
    <section class="feature-section mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h2>{{ __('general.more_features_title') }}</h2>
                    <p>{{ __('general.more_features_description') }}</p>
                    <ul>
                        <li><strong>{{ __('general.job_postings') }}</strong></li>
                        <li><strong>{{ __('general.social_media_platform') }}</strong></li>
                    </ul>
                    <a href="register" class="btn btn-primary mb-3">{{ __('general.sign_up') }}</a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/more features.png') }}" alt="Hero Image" loading="lazy"
                        class="img-fluid custom-image w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center color-bg-blue-light">
        <div class="container">
            <strong>{{ __('general.copyright') }}</strong>
        </div>
    </footer>
</div>
