<div>
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-lg-8 ">

                <!-- Profile Header -->
                <div class="card mb-3">
                    <div class="card-header bg-dark" style="height: 180px; border-radius: 8px 8px 0 0;"></div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-start">
                            <img src="https://via.placeholder.com/100?text=User" alt="Profile Picture" loading="lazy"
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
                                    <div class="modal fade overflow-hidden" id="contactModal">
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

                                    <div x-data="{ open: false }">

                                        <button @click="open = !open"
                                            class="btn btn-outline-secondary btn-custom">More</button>

                                        <div x-show="open" class="options-card mt-5">
                                            <ul>
                                                <li>
                                                    <label for="profilePicture" class="mb-0">Edit profile picture</label>
                                                    <input type="file" name="profilePicture" id="profilePicture" class="d-none">
                                                </li>

                                                <li data-toggle="modal" data-target="#personalDatails">Edit personal details </li>

                                                <li>Share profile link</li>

                                                <li data-toggle="modal" data-target="#aboutProfileModal">About this
                                                    profile
                                                </li>
                                                <li>Activity</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal --}}
                                <div class="modal fade overflow-hidden" id="aboutProfileModal" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                @include('livewire.includes.user-profile.General-Information-Section')

                <!-- Experience Section -->
                @include('livewire.includes.user-profile.Experience-Section')

                <!-- Projects-Section -->
                @include('livewire.includes.user-profile.Projects-Section')

                <!-- Education Section -->
                @include('livewire.includes.user-profile.Education-Section')

                <!-- Courses-Section -->
                @include('livewire.includes.user-profile.Courses-Section')

                <!-- Skills-Section -->
                @include('livewire.includes.user-profile.Skills-Section')

                {{-- interests-Section --}}
                @include('livewire.includes.user-profile.interests-Section')




            </div>

            <div class="col-lg-3 p-0">
                @livewire('ChatAndFeed')
            </div>
        </div>
    </div>



</div>
