<div>
    <style>
        .profile-picture {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background-color: #ccc;
            border: 5px solid white;
            margin-top: -9rem !important;
            font-size: 180px;
            color: gray;
        }

        .btn-custom {
            border-radius: 20px;
        }

        .clickable-div {
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .clickable-div:hover {
            background-color: #f8f9fa;
            /* Light grey on hover */
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); Subtle shadow */
            /* border-radius: 8px ; */
            /* width: 100% */
        }
    </style>

    <div class="container mt-4">

        <div class="row">
            <div class="col-8">

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
                                    <span>Sana‘a, Yemen <a href="#" class="text-primary">Contact info</a></span>
                                    <br>
                                    <span>N Connections</span>
                                </div>

                                <!-- Right Section -->
                                <div class="d-flex mt-3">
                                    <button class="btn btn-outline-secondary btn-custom me-2 mr-2">Enhance
                                        Profile</button>
                                    <button class="btn btn-outline-secondary btn-custom">More</button>
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
                        <h5>Actions</h5>
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
                            <p><strong>Job Title | Date From - To</strong></p>
                            <p>Company Name | Place Name</p>
                            <p class="text-muted">Work Time: Full time/ One shift</p>
                        </div>
                        <div>
                            <p><strong>Job Title | Date From - To</strong></p>
                            <p>Company Name | Place Name</p>
                            <p class="text-muted">Work Time: Full time/ One shift</p>
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

                <!-- Interests Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Interests</h5>
                        <p>Companies</p>

                        <div class="d-flex flex-wrap justify-content-center">

                            <div class="card d-flex flex-row align-items-start me-2 mr-3 p-3"
                                style="width: fit-content;">
                                <img src="#" alt="Company Logo" class="rounded-circle bg-dark me-3"
                                    style="width: 70px; height: 70px;">
                                <div class="card-body text-start py-0">
                                    <ul class="list-unstyled my-0">
                                        <li><strong class="text-dark">Lorem ipsum dolor sit</strong></li>
                                        <li class="text-muted"> 10,258 followers</li>
                                        <li> <button class="btn btn-outline-secondary btn-custom mt-1">Tracking</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card d-flex flex-row align-items-start me-2 mr-3 p-3"
                                style="width: fit-content;">
                                <img src="#" alt="Company Logo" class="rounded-circle bg-dark me-3"
                                    style="width: 70px; height: 70px;">
                                <div class="card-body text-start py-0">
                                    <ul class="list-unstyled my-0">
                                        <li><strong class="text-dark">Lorem ipsum dolor sit</strong></li>
                                        <li class="text-muted"> 10,258 followers</li>
                                        <li> <button class="btn btn-outline-secondary btn-custom mt-1">Tracking</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="text-center mt-3 position-relative">
                            <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                            <a href="#" class="text-decoration-none"><strong class="text-dark">Show all →</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sticky-top" style="top: 20px;">

                    {{-- caht card --}}
                    <div class="d-flex flex-column">
                        <div class="bg-white rounded shadow-sm flex-grow-1">
                            <!-- Header -->
                            <h5 class="mb-4 pt-3 pl-3">Chats</h5>

                            <!-- Chat List -->
                            <div class="chat-list">

                                <a href="#" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center clickable-div py-1 pl-3">
                                        <img src="https://via.placeholder.com/50" alt="User"
                                            class="rounded-circle me-3 mr-3">
                                        <div>
                                            <strong>Company name</strong>
                                            <p class="text-muted small mb-0">Hey, how is your project?</p>
                                        </div>

                                    </div>
                                </a>
                                <a href="#" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center mb-1 clickable-div py-1 pl-3">
                                        <img src="https://via.placeholder.com/50" alt="User"
                                            class="rounded-circle me-3 mr-3">
                                        <div>
                                            <strong>Company name</strong>
                                            <p class="text-muted small mb-0">Hey, how is your project?</p>
                                        </div>

                                    </div>
                                </a>
                                <a href="#" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center mb-1 clickable-div py-1 pl-3">
                                        <img src="https://via.placeholder.com/50" alt="User"
                                            class="rounded-circle me-3 mr-3">
                                        <div>
                                            <strong>Company name</strong>
                                            <p class="text-muted small mb-0">Hey, how is your project?</p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Start New Chat Button -->
                        <div class="bg-white p-3 text-center rounded shadow-sm"
                            style="border-radius: 0 0 .25rem .25rem  !important; margin-top: -5px;">
                            <button class="btn btn-primary w-100">START NEW CHAT</button>
                        </div>
                    </div>

                    {{-- feed card --}}
                    <div class="bg-white rounded shadow-sm p-3 mt-3">
                        <!-- Header -->
                        <h5 class="mb-4">Add To Your Feed</h5>

                        <!-- Feed List -->
                        <div class="feed-list">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://via.placeholder.com/50" alt="Company Logo"
                                    class="rounded-circle me-3 mr-3">
                                <div class="flex-grow-1">
                                    <a href="#" class="text-dark font-weight-bold">Company name</a>
                                    <p class="text-muted small mb-0">Company Major</p>
                                </div>
                                <button class="btn btn-primary btn-sm">Follow</button>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://via.placeholder.com/50" alt="Company Logo"
                                    class="rounded-circle me-3 mr-3">
                                <div class="flex-grow-1">
                                    <a href="#" class="text-dark font-weight-bold">Company name</a>
                                    <p class="text-muted small mb-0">Company Major</p>
                                </div>
                                <button class="btn btn-primary btn-sm">Follow</button>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://via.placeholder.com/50" alt="Company Logo"
                                    class="rounded-circle me-3 mr-3">
                                <div class="flex-grow-1">
                                    <a href="#" class="text-dark font-weight-bold">Company name</a>
                                    <p class="text-muted small mb-0">Company Major</p>
                                </div>
                                <button class="btn btn-primary btn-sm">Follow</button>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
