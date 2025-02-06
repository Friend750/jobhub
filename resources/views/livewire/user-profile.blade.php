@push('styles')
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <!-- Profile Header -->
                <div class="card mb-3 rounded">
                    <div class="card-header bg-dark" style="height: 180px; border-radius: 8px 8px 0 0;"></div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-start">
                            @if ($user->user_image)
                                <img src="{{ asset('storage/' . $user->user_image) }}" alt="Profile Picture"
                                    loading="lazy" class="profile-picture rounded-circle">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->user_name) }}"
                                    alt="Profile Picture" loading="lazy" class="profile-picture rounded-circle">
                            @endif


                            <div class="d-flex align-items-end justify-content-between w-100 mt-2">
                                <!-- Left Section -->
                                <div>

                                    @if (!empty($user->personal_details->page_name))
                                        <h3>{{ $user->personal_details->page_name }}</h3>
                                    @else
                                        <h3>{{ $user->personal_details->first_name ?? 'first name' }}
                                            {{ $user->personal_details->last_name ?? 'last name' }}</h3>
                                    @endif
                                    <span> {{ $user->personal_details->specialist ?? 'User Specialist' }}</span><br>
                                    <span>{{ $user->personal_details->city ?? 'city' }} •
                                        <a href="#" class="text-primary text-decoration-none"
                                            data-bs-toggle="modal" data-bs-target="#contactModal"> Contact info</a>
                                    </span>

                                    <!-- Modal -->
                                    <div class="modal fade overflow-hidden" id="contactModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Contact Information</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <p><strong class="text-dark">Your Profile URL:</strong><br> John
                                                            Doe</p>
                                                        <p><strong class="text-dark">Email:</strong> <br>
                                                            {{ $user->email ?? 'example@example.com' }}</p>
                                                        <p><strong class="text-dark">Phone:</strong> <br>
                                                            {{ $user->personal_details->phone ?? 'phone' }}
                                                        </p>
                                                        <p><strong class="text-dark">Website:</strong> <br>
                                                            {{ $user->personal_details->link ?? 'website Url' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <span>N Connections</span>
                                </div>

                                <!-- Right Section -->
                                <div class="d-flex mt-3 align-items-center">
                                    <div class="spinner-border text-dark me-2" role="status" wire:loading
                                        wire:target='profilePicture'>
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <label for="profilePicture"
                                        class="mb-0 text-dark btn btn-outline-secondary btn-custom me-2 mr-2 rounded">
                                        <i class="fas fa-camera"></i> Edit Photo
                                    </label>
                                    <input type="file" id="profilePicture" wire:model="profilePicture" class="d-none"
                                        accept="image/*">

                                    <a href="/EnhanceProfile"
                                        class=" text-decoration-none text-dark d-flex align-items-center btn btn-outline-secondary btn-custom me-2 mr-2 rounded">
                                        <i class="fas fa-user-edit me-2"></i>
                                        Enhance Profile
                                    </a>

                                    <div x-data="{ open: false }" class="position-relative">

                                        <button @click="open = !open"
                                            class="btn text-dark btn-outline-secondary btn-custom rounded">More</button>

                                        <div x-show="open" x-cloak x-on:click ="open=false" @click.outside="open=false"
                                            class="options-card mt-2">
                                            <ul class="list-unstyled ">

                                                <li class="d-flex align-items-center">
                                                    <i class="fas fa-share-alt me-2"></i>
                                                    <!-- Font Awesome icon for sharing -->
                                                    Share profile link
                                                </li>

                                                <li class="d-flex align-items-center" data-bs-toggle="modal"
                                                    data-bs-target="#aboutProfileModal">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    <!-- Font Awesome icon for info -->
                                                    About this profile
                                                </li>

                                                <li class="d-flex align-items-center">
                                                    <i class="fas fa-history me-2"></i>
                                                    <!-- Font Awesome icon for activity -->
                                                    Activity
                                                </li>
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
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true"></span>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <p><strong class="text-dark">Joined:</strong><br>
                                                        {{ $user->created_at ?? 'created at' }}</p>
                                                    <p><strong class="text-dark">Contact Information:</strong><br>
                                                        {{ $user->updated_at ?? 'Updated over xxx ago' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @error('profilePicture')
                    <span class="alert alert-danger d-flex flex-wrap w-100">{{ $message }}</span>
                @enderror

                @if (session()->has('message'))
                    <div class="alert alert-success d-flex flex-wrap w-100">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger d-flex flex-wrap w-100">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- General Information Section -->
                @include('livewire.includes.user-profile.General-Information-Section')
                @if ($user->type != 'company')
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
                @endif


            </div>

            <div class="col-lg-3 p-0">
                <div class="MakeSticky">
                    @livewire('ChatAndFeed')
                </div>
            </div>
        </div>
    </div>
</div>
