
<div>
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-8 ">

                <!-- Profile Header -->
                <div class="card mb-3">
                    <div class="card-header bg-dark" style="height: 180px; border-radius: 8px 8px 0 0;"></div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-start">
                            <img src="https://via.placeholder.com/100?text=User" alt="Profile Picture"
                                class="profile-picture rounded-circle">
                            {{-- <i class="bi bi-person-circle profile-picture" style=""></i> --}}


                            <div class="d-flex align-items-end justify-content-between w-100">
                                <!-- Left Section -->
                                <div>
                                    <h3>First name + last name</h3>
                                    <span>User Specialist</span><br>
                                    <span>Sana‘a, Yemen
                                        <a href="#" class="text-primary" data-toggle="modal"
                                            data-target="#contactModal">Contact info</a>
                                    </span>

                                    <!-- Modal -->
                                    <div class="modal fade" id="contactModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Contact Information</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <p><strong class="text-dark">Your Profile URL:</strong><br> John
                                                            Doe</p>
                                                        <p><strong class="text-dark">Email:</strong> <br>
                                                            johndoe@example.com</p>
                                                        <p><strong class="text-dark">Phone:</strong> <br> (123) 456-7890
                                                        </p>
                                                        <p><strong class="text-dark">Website:</strong> <br> ...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <span>N Connections</span>
                                </div>

                                <!-- Right Section -->
                                <div class="d-flex mt-3">
                                   <a href="/EnhanceProfile"> <button class="btn btn-outline-secondary btn-custom me-2 mr-2">Enhance
                                        Profile</button></a>
                                    <button id="toggleOptionsBtn" class="btn btn-outline-secondary btn-custom"
                                        onclick="toggleOptionsCard()">More</button>

                                    <div id="optionsCard" class="options-card mt-5">
                                        <ul>
                                            <li>Share profile link</li>
                                            <li data-toggle="modal" data-target="#aboutProfileModal">About this profile
                                            </li>
                                            <li>Activity</li>
                                            {{-- <li>About this profile</li> --}}
                                        </ul>
                                    </div>
                                </div>

                                {{-- modal --}}
                                <div class="modal fade" id="aboutProfileModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">About This Profile</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <p><strong class="text-dark">Joined:</strong><br> April 2021</p>
                                                    <p><strong class="text-dark">Contact Information:</strong><br>
                                                        Updated over 1 year ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- General Information Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>General Information</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ornare odio. Curabitur vitae
                            velit
                            ultricies, lobortis tellus quis, tempus ante.</p>
                    </div>
                </div>

                <!-- Actions Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Actions <small>(Posts)</small></h5>
                        <p style="margin-top: -10px; color: gray;">K followers</p>

                        <div class="d-flex mb-3">
                            {{-- <button class="btn btn-outline-secondary btn-sm mx-1">Posts</button> --}}
                            {{-- <button class="btn btn-outline-secondary btn-sm mx-1">Comments</button> --}}
                        </div>
                        <p>Posts created</p>

                        <div class="text-center mt-3 position-relative">
                            <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                            <a href="#" class="text-decoration-none"><strong class="text-dark">Show all Posts
                                    →</strong>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Experience</h5>
                        <div class="mb-3">
                            <ul class="list-unstyled">
                                <li><strong>Job Title | Date From - To</strong></li>
                                <li>Company Name | Place Name</li>
                                <li class="text-muted">Work Time: Full time / One shift</li>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <ul class="list-unstyled">
                                <li><strong>Job Title | Date From - To</strong></li>
                                <li>Company Name | Place Name</li>
                                <li class="text-muted">Work Time: Full time / One shift</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Skills</h5>
                        <ul class="list-unstyled">
                            <li>Lorem ipsum dolor sit</li>
                            <li>Lorem ipsum dolor sit</li>
                            <li>Lorem ipsum dolor sit</li>
                        </ul>
                        <div class="text-center mt-3 position-relative">
                            <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                            <a href="#" class="text-decoration-none"><strong class="text-dark">Show all Skills
                                    →</strong>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- old Interests Section -->
                {{-- <div class="card mb-3">
                    <div class="card-body">
                        <h5>Interests</h5>
                        <p>Companies</p>

                        <div class="d-flex flex-wrap justify-content-around">

                            <div class="card d-flex flex-row align-items-start mr-1 p-2" style="height:fit-content;">
                                <img src="https://via.placeholder.com/50" alt="logo" class="rounded-circle">
                                <div class="card-body text-start py-0 pl-2">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong class="text-dark">Lorem ipsum dolor sit</strong></li>
                                        <li class="text-muted" style="margin-top: -6px;"><small>10k
                                                followers</small></li>
                                        <li> <button
                                                class="btn btn-outline-secondary btn-custom mt-1 py-1">Tracking</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card d-flex flex-row align-items-start mr-1 p-2" style="height:fit-content;">
                                <img src="https://via.placeholder.com/50" alt="logo" class="rounded-circle">
                                <div class="card-body text-start py-0 pl-2">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong class="text-dark">Lorem ipsum dolor sit</strong></li>
                                        <li class="text-muted" style="margin-top: -6px;"><small>122k
                                                followers</small></li>
                                        <li> <button
                                                class="btn btn-outline-secondary btn-custom mt-1 py-1">Tracking</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>

                        <div class="text-center mt-3 position-relative">
                            <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                            <a href="#" class="text-decoration-none"><strong class="text-dark">Show all
                                    →</strong>
                            </a>
                        </div>
                    </div>
                </div> --}}

                {{-- new interests Section --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Interests</h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-dark" id="companies-tab" data-toggle="tab"
                                    href="#companies" role="tab" aria-controls="companies"
                                    aria-selected="true">Companies</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="connections-tab" data-toggle="tab" href="#connections"
                                    role="tab" aria-controls="connections" aria-selected="false">Connections</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="companies" role="tabpanel"
                                aria-labelledby="companies-tab">
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <a href="" class="text-decoration-none text-dark">

                                            <div class="d-flex align-items-start justify-content-start">
                                                <img src="https://via.placeholder.com/50" class="rounded-circle mr-3"
                                                    alt="Company Logo">
                                                <div>
                                                    <h6 class="mb-0">Lorem ipsum dolor sit</h6>
                                                    <small class="text-muted">10k followers</small>
                                                    <div class="mt-1">
                                                        <span class="badge text-dark badge-light border btn">Tracking</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="" class="text-decoration-none text-dark">

                                            <div class="d-flex align-items-start justify-content-start">
                                                <img src="https://via.placeholder.com/50" class="rounded-circle mr-3"
                                                    alt="Company Logo">
                                                <div>
                                                    <h6 class="mb-0">Lorem ipsum dolor sit</h6>
                                                    <small class="text-muted">122k followers</small>
                                                    <div class="mt-1">
                                                        <span class="badge badge-light text-dark border btn">Tracking</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="connections" role="tabpanel" aria-labelledby="connections-tab">
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <a href="" class="text-decoration-none text-dark">

                                            <div class="d-flex align-items-start justify-content-start">
                                                <img src="https://via.placeholder.com/50" class="rounded-circle mr-3"
                                                    alt="Company Logo">
                                                <div>
                                                    <h6 class="mb-0">connection 1</h6>
                                                    <div class="mt-1">
                                                        <span class="badge badge-light text-dark border btn">Following</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="" class="text-decoration-none text-dark">

                                            <div class="d-flex align-items-start justify-content-start">
                                                <img src="https://via.placeholder.com/50" class="rounded-circle mr-3"
                                                    alt="Company Logo">
                                                <div>
                                                    <h6 class="mb-0">connection 2</h6>
                                                    <div class="mt-1">
                                                        <span class="badge badge-light text-dark border btn">Following</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="text-center mt-3 position-relative">
                            <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                            <a href="#" class="text-decoration-none"><strong class="text-dark">Show all
                                    →</strong>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3 p-0">

                @livewire('ChatAndFeed')

            </div>
        </div>
    </div>

    <script>
        // Function to toggle the visibility of the options card
        function toggleOptionsCard() {
            const card = document.getElementById('optionsCard');
            card.style.display = card.style.display === 'block' ? 'none' : 'block';
        }

        // Function to close the options card when clicking outside of it
        document.addEventListener('click', function(event) {
            const card = document.getElementById('optionsCard');
            const button = document.getElementById('toggleOptionsBtn');

            // Check if the click is outside the card and the button
            if (!card.contains(event.target) && !button.contains(event.target)) {
                card.style.display = 'none';
            }
        });
    </script>


</div>
