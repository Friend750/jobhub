<div class="bg-wight">

    <!-- Navbar -->
    <nav class="navbar w-100 bg-wight fixed-top">
        <div class="container">

            <div class="nav-left d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="#">
                    <span class="logoName">YemenJobs</span>
                </a>
            </div>

            <div class="nav-right">
                <div class="d-flex" role="search">
                    {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> --}}
                    <a href="register" class="btn text-primary mr-2" type="submit"><b>Join now</b> </a>
                    <a href="login"><button class="btn btn-outline-primary" type="submit"><b>Sign in</b>
                        </button></a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->

    <section class="hero-section text-center mb-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h1>Connect, Discover, and Thrive in Your Career</h1>
                    <p>Unlock new opportunities with our innovative platform designed for job seekers, companies,
                        and
                        professionals.</p>
                    <a href="register" class="btn btn-primary mb-3">Join</a>
                    <button class="btn color-bg-blue-light mb-3">
                        {{-- <i class="fab fa-google"></i> --}}
                        Or you can Continue with
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
                    <h2>Resume, alerts, career control, all in <strong class="text-primary">one.</strong></h2>
                    <p>Our platform offers powerful tools designed to streamline your job search.</p>
                    <ul>
                        <li><strong>Resume Builder:</strong> Create a standout resume effortlessly.</li>
                        <li><strong>Job Alerts:</strong> Receive instant notifications for job openings.</li>
                    </ul>
                    <a href="login" class="btn btn-primary mb-3 mt-2">Start Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- More Features Section -->
    <section class="feature-section mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h2>Empower Your Hiring with Our Platform</h2>
                    <p>Save time and effort with our intelligent platform.</p>
                    <ul>
                        <li><strong>Job Postings:</strong> Easily create and manage job listings (soon).</li>
                        <li><strong>Social Media Platform:</strong> Connect and grow your audience.</li>
                    </ul>
                    <a href="register" class="btn btn-primary mb-3">Sign Up</a>
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
            <strong>© 2024 All rights reserved.</strong>
        </div>
    </footer>
</div>
