@push('styles')
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Header -->
                <div class="card mb-3 rounded">
                    <div class="card-header bg-dark" style="height: 180px; border-radius: 8px 8px 0 0;"></div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-start">
                            @if ($user->user_image)
                                @if (strpos($user->user_image, 'googleusercontent.com') !== false)
                                    {{-- Display Google account image --}}
                                    <img src="{{ $user->user_image }}" alt="Profile Picture"
                                        class="profile-picture rounded-circle">
                                @else
                                    {{-- Display locally stored image --}}
                                    <img src="{{ asset('storage/' . $user->user_image) }}" alt="Profile Picture" loading="lazy"
                                        class="profile-picture rounded-circle">
                                @endif
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->user_name) }}"
                                    alt="Profile Picture" loading="lazy" class="profile-picture rounded-circle">
                            @endif

                            <div class="d-flex align-items-end justify-content-between w-100 mt-3">
                                <!-- Left Section -->
                                <div>

                                    @if (!empty($user->personal_details->page_name) && $user->type == 'company')
                                        <h1>{{ $user->personal_details->page_name }}</h1>
                                    @else
                                        <h1 class="mb-0">{{ $user->personal_details->first_name ?? 'first name' }}
                                            {{ $user->personal_details->last_name ?? 'last name' }}
                                        </h1>
                                    @endif
                                    <span class="mb-2 d-block fw-bold text-muted fs-5"> {{ $user->personal_details->specialist ?? 'User Specialist' }}</span>
                                    <span>{{ $user->personal_details->city ?? 'city' }} •
                                        <a href="#" class="text-primary fw-bold text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#contactModal"> معلومات التواصل</a>
                                    </span>

                                    <!-- contact-info-modal -->
                                    @include('livewire.includes.user-profile.contact-info-modal')


                                    <span>N Connections</span>
                                </div>

                                <!-- Right Section -->
                                <div class="d-flex mt-3 align-items-center flex-wrap gap-2">
                                    <div class="spinner-border text-dark" role="status" wire:loading
                                        wire:target='profilePicture'>
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    @if (auth()->user()->id !== $user->id)

                                    @php
                                    // Read status from backend once
                                    $status = $this->getFollowStatus($user->id);
                                    $isFollowing = $status['isFollowing'];
                                    $isRequested = $status['isRequested'];
                                    $isFollowingMe = \App\Models\Connection::where('following_id', $user->id)
                                        ->where('follower_id', auth()->id())
                                        ->where('is_accepted', 1)
                                        ->exists();
                                    @endphp
                                        <div class="d-flex gap-2" x-data="{toggle: true}">
                                            @if($isFollowingMe)
                                            <button  wire:click='startConversation({{ $user->id }})' type="button" class="btn-outline-primary btn btn-sm">
                                                <i class="fa-solid fa-paper-plane"></i>
                                                مراسلة
                                            </button>
                                        @endif
                                            <div class="d-flex align-items-center" wire:ignore
                                            x-data="{
                                                isFollowing: @json($isFollowing),
                                                isRequested: false
                                            }">
                                           <button class="btn btn-sm"
                                                   :class="isFollowing ? 'btn-outline-danger' : (isRequested ? 'btn-outline-warning' : 'btn-outline-primary')"
                                                   @click.prevent="
                                                       if (!isRequested) {
                                                           if (isFollowing) {
                                                               // Optimistically update UI for unfollow
                                                               isFollowing = false;
                                                               $wire.unFollow({{ $user->id }});
                                                           } else {
                                                               // Optimistically update UI for follow (show 'requested')
                                                               isRequested = true;
                                                               $wire.follow({{ $user->id }});
                                                           }
                                                       }
                                                   ">
                                               <i x-bind:class="isFollowing ? 'fa-solid fa-minus' : 'fa-solid fa-plus'"></i>
                                               <span x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
                                           </button>
                                       </div>

                                        </div>

                                    @endif

                                    @if (auth()->user()->id === $user->id)
                                        <div>
                                            <label for="profilePicture"
                                                class="mb-0 text-dark btn btn-outline-secondary btn-custom rounded">
                                                <i class="fas fa-camera"></i> تعديل الصورة الشخصية
                                            </label>
                                            <input type="file" id="profilePicture" wire:model="profilePicture"
                                                class="d-none" accept="image/*">
                                        </div>

                                    @endif

                                    <div x-data="{ open: false }" class="position-relative">

                                        <button @click="open = !open"
                                            class="btn text-dark btn-outline-secondary btn-custom rounded"><i
                                                class="fa-solid fa-ellipsis"></i></button>

                                        <div x-show="open" x-cloak x-on:click="open=false" @click.outside="open=false"
                                            class="options-card mt-2">
                                            <ul class="list-unstyled ">

                                                @if (auth()->user()->id == $user->id)
                                                    <li>
                                                        <a href="/EnhanceProfile"
                                                            class=" text-decoration-none text-dark d-flex gap-2 align-items-center">
                                                            <i class="fas fa-user-edit"></i>
                                                            تحسين الملف الشخصي
                                                        </a>
                                                    </li>
                                                @endif
                                                <li class="d-flex gap-2 align-items-center">
                                                    <i class="fas fa-share-alt me-2"></i>
                                                    <!-- Font Awesome icon for sharing -->
                                                    مشاركة رابط الصفحة
                                                </li>

                                                <li class="d-flex gap-2 align-items-center">
                                                    <i class="fas fa-history me-2"></i>
                                                    <!-- Font Awesome icon for activity -->
                                                    النشاط
                                                </li>
                                            </ul>
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
                    <div class="alert alert-success d-flex flex-wrap justify-content-between w-100">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger d-flex flex-wrap w-100">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- link_updated --}}
                @if (session()->has('link_updated'))
                    <div class="alert alert-success d-flex flex-wrap w-100">
                        {{ session('link_updated') }}
                    </div>
                @endif
                {{-- link_deleted --}}
                @if (session()->has('link_deleted'))
                    <div class="alert alert-success d-flex flex-wrap w-100">
                        {{ session('link_deleted') }}
                    </div>
                @endif

                @if (!empty($user->personal_details->professional_summary))
                    <!-- General Information Section -->
                    @include('livewire.includes.user-profile.General-Information-Section')
                @endif

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

                    {{-- languages section --}}
                    @include('livewire.includes.user-profile.languages')

                    {{-- interests-Section --}}
                    @include('livewire.includes.user-profile.interests-Section')
                @endif


            </div>

            <div class="col-lg-3 p-0">
                <div class="MakeSticky w-75">
                    @livewire('ChatAndFeed')
                </div>
            </div>
        </div>
    </div>
</div>
