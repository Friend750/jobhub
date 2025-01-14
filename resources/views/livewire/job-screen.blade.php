
    <div class="job-page">
        <!-- Filters Section -->
        <div class="filters-section">
            <div class="filters-container">
                <select class="filter">
                    <option>Most Relevant</option>
                    <option>Newest</option>
                </select>
                <select class="filter">
                    <option>Any Time</option>
                    <option>Last 24 Hours</option>
                    <option>Last Week</option>
                </select>
                <select class="filter">
                    <option>25 Miles (40 km)</option>
                    <option>10 Miles (16 km)</option>
                    <option>50 Miles (80 km)</option>
                </select>
                <button class="filter-btn">More Options</button>
            </div>
        </div>

        <!-- Job Content -->
        <div class="job-content">
            <div class="job-listings">
                <div class="job-listing-card" data-job="1">
                    <div class="profile-photo-container">
                        <img src="" loading="lazy" alt="Profile Photo" class="profile-photo">
                    </div>
                    <div>
                        <h4>DevOps Engineer</h4>
                        <p>GitHub • San Francisco, CA</p>
                        <small>13 hours ago • Among the first 25 applicants</small>
                    </div>
                    <button class="apply-btn" onclick="showJobDetails(1)">Apply Now</button>
                </div>
                <div class="job-listing-card" data-job="2">
                    <div class="profile-photo-container">
                        <img src="" loading="lazy" alt="Profile Photo" class="profile-photo">
                    </div>
                    <div>
                        <h4>DevOps Engineer</h4>
                        <p>PayPal • San Francisco, CA</p>
                        <small>1 week ago • Among the first applicants</small>
                    </div>
                    <button class="apply-btn" onclick="showJobDetails(2)">Apply Now</button>
                </div>
                <div class="job-listing-card" data-job="3">
                    <div class="profile-photo-container">
                        <img src=""  loading="lazy" alt="Profile Photo" class="profile-photo">
                    </div>
                    <div>
                        <h4>Infrastructure Engineer</h4>
                        <p>PepsiCo • Remote</p>
                        <small>8 hours ago • Among the first applicants</small>
                    </div>
                    <button class="apply-btn" onclick="showJobDetails(3)">Apply Now</button>
                </div>
            </div>

            <!-- Job Details -->
            <div id="job-details" class="job-details">
                <h2>Select a job to view details</h2>
                <p>Job details will appear here when you click on "Apply Now".</p>
            </div>
        </div>
    </div>




<script>
    // Job data
const jobsData = {
    1: {
        title: "DevOps Engineer",
        company: "GitHub",
        location: "San Francisco, CA",
        description: "GitHub helps companies build better software. We're looking for a DevOps Engineer to join our team.",
    },
    2: {
        title: "DevOps Engineer",
        company: "PayPal",
        location: "San Francisco, CA",
        description: "PayPal is looking for a DevOps Engineer to enhance our payment systems. Join us now.",
    },
    3: {
        title: "Infrastructure Engineer",
        company: "PepsiCo",
        location: "Remote",
        description: "Join PepsiCo's team to build and maintain infrastructure for global operations.",
    },
};

// Function to show job details
function showJobDetails(jobId) {
    const job = jobsData[jobId];
    const jobDetails = document.getElementById('job-details');

    jobDetails.innerHTML = `
        <h2>${job.title}</h2>
        <p><strong>${job.company}</strong> • ${job.location}</p>
        <p>${job.description}</p>
        <button class="apply-btn" onclick="alert('Application submitted!')">Apply Now</button>
    `;
    jobDetails.classList.add('active');
}
</script>


{{--
<script>
 const jobsData = {
    1: {
        title: "DevOps Engineer",
        company: "GitHub",
        location: "San Francisco, CA",
        description: "GitHub helps companies build better software. We're looking for a DevOps Engineer to join our team.",
    },
    2: {
        title: "DevOps Engineer",
        company: "PayPal",
        location: "San Francisco, CA",
        description: "PayPal is looking for a DevOps Engineer to enhance our payment systems. Join us now.",
    },
    3: {
        title: "Infrastructure Engineer",
        company: "PepsiCo",
        location: "Remote",
        description: "Join PepsiCo's team to build and maintain infrastructure for global operations.",
    },
};

function toggleJobDetails(jobId) {
    const job = jobsData[jobId];
    if (!job) return;

    const targetCard = document.querySelector(`.job-listing-card[data-job="${jobId}"]`);
    const targetDetailDiv = targetCard.querySelector('.job-detail');
    const isActive = targetDetailDiv.classList.contains('active');

    // Hide all other details
    document.querySelectorAll('.job-detail').forEach((detail) => {
        detail.classList.remove('active');
        detail.innerHTML = '';
    });

    // Toggle the clicked job details
    if (!isActive) {
        targetDetailDiv.innerHTML = `
            <h4>${job.title}</h4>
            <p><strong>${job.company}</strong> • ${job.location}</p>
            <p>${job.description}</p>
            <button class="apply-btn" onclick="alert('Application submitted!')">Apply Now</button>
        `;
        targetDetailDiv.classList.add('active');
    }
}

</script> --}}
