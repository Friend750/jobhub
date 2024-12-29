<div>
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-lg-8 ">

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
                                        <a href="#" class="text-primary text-decoration-none" data-toggle="modal"
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
                                    <a href="/EnhanceProfile"> <button
                                            class="btn btn-outline-secondary btn-custom me-2 mr-2">Enhance
                                            Profile</button></a>
                                    <button id="toggleOptionsBtn" class="btn btn-outline-secondary btn-custom"
                                        onclick="toggleOptionsCard()">More</button>

                                    <div id="optionsCard" class="options-card mt-5">
                                        <ul>
                                            <li>
                                                <label for="profilePicture" class="mb-0">Edit profile picture</label>
                                                <input type="file" name="profilePicture" id="profilePicture"
                                                    class="d-none">
                                            </li>
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
                        <div class="d-flex justify-content-between">
                            <h5>General Information</h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ornare odio. Curabitur vitae
                            velit
                            ultricies, lobortis tellus quis, tempus ante.</p>
                    </div>
                </div>

                <!-- Actions Section -->
                {{-- <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>Actions <small>(Posts)</small></h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>

                        <p style="margin-top: -10px; color: gray;">K followers</p>

                        <p>Posts created</p>

                        <div class="text-center mt-3 position-relative">
                            <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                            <a href="#" class="text-decoration-none"><strong class="text-dark">Show all Posts
                                    →</strong>
                            </a>
                        </div>
                    </div>
                </div> --}}

                <!-- Experience Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Experience</h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>

                        <div class="mb-3">
                            <ul class="list-unstyled">
                                <div class="d-flex justify-content-between">
                                    <li><strong> Job Title | Company Name | Location</strong></li>
                                    <strong class="">[Month/Year – Month/Year]</strong>
                                </div>

                                <li class="text-muted">what has been done at this postion</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Education</h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>

                        <div class="mb-3">
                            <ul class="list-unstyled">
                                <div class="d-flex justify-content-between">
                                    <li><strong>[Degree/Certification Name]</strong></li>
                                    <strong class="">[Month/Year of Graduation]</strong>
                                </div>
                                <li>[Institution Name] | [Location]</li>
                                <li>[Include any relevant coursework, honors, or GPA if applicable]</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Certifications | Courses</h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>

                        <div class="mb-3">
                            <ul class="list-unstyled">
                                <div class="d-flex justify-content-between">
                                    <li><strong>Certification Name | Institution/Provider | Location</strong></li>
                                    <strong class="">Completion Date</strong>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Projects</h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>

                        <div class="mb-3">
                            <ul class="list-unstyled">
                                <div class="d-flex justify-content-between">
                                    <li><strong>Project Title</strong></li>
                                </div>
                                <ul>

                                    <li>[Description of the project, including tools and technologies used]</li>
                                    <li>[Key outcomes or contributions made during the project]</li>

                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>Skills</h5>
                            <i class="bi bi-pencil-square p-1 btn"></i>
                        </div>

                        <ul class="list-unstyled d-flex flex-wrap" x-data="{ skills: @entangle('skills'), limit: 7 }">
                            <template x-for="(skill, index) in skills" :key="index">
                                <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="skill"></li>
                            </template>
                            <li class="btn btn-secondary m-1" x-show="skills.length > limit"
                                @click="limit = skills.length" x-text="'+' + (skills.length - limit) + ' more'">
                            </li>
                        </ul>

                    </div>
                </div>

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
                                <a class="nav-link text-dark" id="connections-tab" data-toggle="tab"
                                    href="#connections" role="tab" aria-controls="connections"
                                    aria-selected="false">Connections</a>
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
                                                        <span
                                                            class="badge text-dark badge-light border btn">Tracking</span>
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
                                                        <span
                                                            class="badge badge-light text-dark border btn">Tracking</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="connections" role="tabpanel"
                                aria-labelledby="connections-tab">
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <a href="" class="text-decoration-none text-dark">

                                            <div class="d-flex align-items-start justify-content-start">
                                                <img src="https://via.placeholder.com/50" class="rounded-circle mr-3"
                                                    alt="Company Logo">
                                                <div>
                                                    <h6 class="mb-0">connection 1</h6>
                                                    <div class="mt-1">
                                                        <span
                                                            class="badge badge-light text-dark border btn">Following</span>
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
                                                        <span
                                                            class="badge badge-light text-dark border btn">Following</span>
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

            <div class="col-lg-3 p-0">

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
