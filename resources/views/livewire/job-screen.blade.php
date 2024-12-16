
<div class="col-12 m-auto">
    <main class="container mt-5">
        <div class="row">
            <section class="col-md-11 mt-5">
                <div class="input-group mb-4">
                    <input type="text" class="form-control mr-3" placeholder="Search for a job" aria-label="Search for a job">
                    <div class="input-group-append">
                        <button class="ml-auto more-button btn btn-outline-primary" type="button">Search</button>
                    </div>
                </div>
                <h4 class="mb-4 text-center">JOBS FOR YOU</h4>

                <!-- Job Card -->
                <div class="job-card p-3 bg-white mb-4">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" alt="Job Profile" class="rounded-circle">
                        <div class="ml-3">
                            <h5 class="mb-1">Web Developer</h5>
                            <p class="mb-1">Freelance &bull; Remote</p>
                            <p class="mb-1">Looking for skilled developers for various projects. Apply now and get started!
                            !Looking for skilled developers for various projects. Apply now and get started!</p>
                        </div>
                        <button class="ml-auto more-button btn btn-outline-secondary custom-margin-left" onclick="toggleDetails(this)">More</button>
                    </div>
                    <div class="job-details mt-3" style="display: none;">
                        <button class="btn btn-primary request-btn" onclick="alert('Submission button clicked!')">Submission</button>
                    </div>
                    
                    
                </div>

                <!--  job card 2 -->
                <div class="job-card p-3 bg-white mb-4">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" alt="Job Profile" class="rounded-circle">
                        <div class="ml-3">
                            <h5 class="mb-1">Web Developer</h5>
                            <p class="mb-1">Freelance &bull; Remote</p>
                            <p class="mb-0">Looking for skilled developers for various projects. Apply now and get started!</p>
                        </div>
                        <button class="ml-auto more-button btn btn-outline-secondary" onclick="toggleDetails(this)">More</button>
                    </div>
                    <div class="job-details mt-3" style="display: none;">
                        <button class="btn btn-primary request-btn" onclick="alert('Submission button clicked!')">Submission</button>
                    </div>                                     
                </div>
            </section>
        </div>
    </main>
</div>

<script>
    function toggleDetails(button) {
        const details = button.closest('.job-card').querySelector('.job-details');
        if (details.style.display === 'none') {
            details.style.display = 'block';
            button.textContent = 'Less';
        } else {
            details.style.display = 'none';
            button.textContent = 'More';
        }
    }
</script>
