<div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-3"></div>

            <div class="col-lg-6" x-data="{ showCard: false }">

                @if (session()->has('message'))
                    <div class="alert alert-success mt-0">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- create post card --}}
                <div class="create-post-card card mb-3 rounded">

                    <div class="card-body d-flex justify-content-center align-items-center">
                        <input type="text" class="form-control w-100 ps-3 bg-light" placeholder="Write something..."
                            @click="showCard = true">
                        <div class="btn bg-light ms-2 p-2 rounded-circle ml-2" style="width: 40px; height: 40px;"
                            @click="showCard = true">
                            <i class="bi bi-image"></i>
                        </div>
                    </div>

                </div>

                <!-- Overlay -->
                <div
                    x-show="showCard"
                    @keydown.escape.window="showCard = false"
                    style="display: none;">

                    <div class="overlay d-flex" x-show="showCard" x-transition>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">

                                    <div class="card post-card rounded" @click.outside="showCard = false">

                                        <div class="card-body" x-data="{ selected: 'content-article' }">
                                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center ">
                                                    <img src="https://via.placeholder.com/50" alt="User"
                                                        class="rounded-circle me-3 h-100">

                                                    <div class="userInfo">
                                                        <h5 class="mb-0">Elon Musk</h5>
                                                        <div class="d-flex align-items-center ">
                                                            <small class="text-muted mr-3 ">CEO of SpaceX</small>

                                                            {{-- post visibality --}}
                                                            <div class="dropdown mr-1">
                                                                <button
                                                                    class="btn btn-light btn-sm dropdown-toggle py-0 color-bg-blue-light"
                                                                    type="button" id="postAudienceDropdown"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Post to anyone
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="postAudienceDropdown">
                                                                    <li><a class="dropdown-item"
                                                                            href="#"><small>Post to
                                                                                anyone</small> </a></li>
                                                                    <li><a class="dropdown-item"
                                                                            href="#"><small>Connections
                                                                                only</small> </a></li>
                                                                </ul>
                                                            </div>

                                                            {{-- post type --}}
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-light btn-sm dropdown-toggle py-0 color-bg-blue-light"
                                                                    type="button" id="postAudienceDropdown"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <span
                                                                        x-text="selected === 'content-article' ? 'Article' : 'Job Offer'"></span>
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="postAudienceDropdown">
                                                                    {{-- <li>
                                                                        <a href="#" class="dropdown-item"
                                                                            @click.prevent="selected = 'content-article'">
                                                                            <small>Article</small>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="dropdown-item"
                                                                            @click.prevent="selected = 'content-job-offer'">
                                                                            <small>Job Offer</small>
                                                                        </a>
                                                                    </li> --}}
                                                                    <li>
                                                                        <a href="#" class="dropdown-item"
                                                                            @click.prevent="selected = selected === 'content-article' ? 'content-job-offer' : 'content-article'">
                                                                            <span
                                                                                x-text="selected === 'content-article' ? 'Job Offer' : 'Article'"></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" @click="showCard = false"
                                                    aria-label="Close"></button>
                                            </div>

                                            {{-- card body --}}
                                            <div class="articleForm" x-show="selected === 'content-article'">

                                                <div class="form-group">
                                                    <textarea class="form-control w-100" id="postContent" rows="6" placeholder="What do you want to talk about?"
                                                        wire:model="content"></textarea>
                                                    @error('content')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                {{-- spinner --}}
                                                <div class="text-center m-auto w-100" wire:loading wire:target="media">
                                                    <div class="spinner-border" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>

                                                <!-- Media Preview -->
                                                @if ($mediaPreview)
                                                    <!-- Single Image -->
                                                    <div class="my-3">
                                                        <div class="rounded">
                                                            <img src="{{ $mediaPreview }}" alt="Image Preview"
                                                                class="post-image rounded">
                                                        </div>
                                                    </div>
                                                @endif

                                                @error('media')
                                                    <div class="my-3">
                                                        <small class="alert-danger p-2 rounded">{{ $message }}</small>
                                                    </div>
                                                @enderror

                                            </div>

                                            <div class="jobOfferForm" x-show="selected === 'content-job-offer'">

                                                <!-- Job Title -->
                                                <div class="form-group">
                                                    <label for="job_title">Job Title</label>
                                                    <input type="text" name="job_title" id="job_title"
                                                        class="form-control @error('job_title') is-invalid @enderror"
                                                        value="{{ old('job_title') }}">
                                                    @error('job_title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- About Job -->
                                                <div class="form-group">
                                                    <label for="about_job">About Job</label>
                                                    <textarea name="about_job" id="about_job" class="form-control @error('about_job') is-invalid @enderror">{{ old('about_job') }}</textarea>
                                                    @error('about_job')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Job Tasks -->
                                                <div class="form-group">
                                                    <label for="job_tasks">Job Tasks</label>
                                                    <textarea name="job_tasks" id="job_tasks" class="form-control @error('job_tasks') is-invalid @enderror">{{ old('job_tasks') }}</textarea>
                                                    @error('job_tasks')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Job Conditions -->
                                                <div class="form-group">
                                                    <label for="job_conditions">Job Conditions</label>
                                                    <textarea name="job_conditions" id="job_conditions"
                                                        class="form-control @error('job_conditions') is-invalid @enderror">{{ old('job_conditions') }}</textarea>
                                                    @error('job_conditions')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Job Skills -->
                                                <div class="form-group">
                                                    <label for="job_skills">Job Skills</label>
                                                    <textarea name="job_skills" id="job_skills" class="form-control @error('job_skills') is-invalid @enderror">{{ old('job_skills') }}</textarea>
                                                    @error('job_skills')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="d-flex">
                                                    <div class="row m-0 w-100">
                                                        <div class="col-6 pl-0"> <!-- Job Location -->
                                                            <div class="form-group">
                                                                <label for="job_location">Job Location</label>
                                                                <input type="text" name="job_location"
                                                                    id="job_location"
                                                                    class="form-control @error('job_location') is-invalid @enderror"
                                                                    value="{{ old('job_location') }}">
                                                                @error('job_location')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="col-6 pr-0"> <!-- Job Timing -->
                                                            <div class="form-group">
                                                                <label for="job_timing">Job Timing</label>
                                                                <input type="text" name="job_timing"
                                                                    id="job_timing"
                                                                    class="form-control @error('job_timing') is-invalid @enderror"
                                                                    value="{{ old('job_timing') }}">
                                                                @error('job_timing')
                                                                    <div class="invalid-feedback">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- card footer --}}
                                            <div
                                                :class="selected === 'content-job-offer' ? 'text-end' :
                                                    'd-flex justify-content-between'">
                                                <div x-show="selected === 'content-article'">
                                                    <label for="fileInput" class="btn color-bg-blue-light m-0">
                                                        <i class="bi bi-image"></i>
                                                        Photo
                                                    </label>
                                                    <input type="file" id="fileInput" accept="image/*"
                                                        class="d-none" wire:model="media">

                                                </div>
                                                <button class="btn btn-primary" wire:click='submit' >Post</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="AllPosts">

                    {{-- post card --}}
                    <div class="card mb-3">
                        <div class="card-body" x-data="{ showComments: false }">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="#" class="text-decoration-none text-dark">

                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/50" alt="User"
                                            class="rounded-circle me-3 mr-3">
                                        <div class="">
                                            <h5 class="mb-0">Elon Musk</h5>
                                            <small class="text-muted">CEO of SpaceX</small>
                                        </div>
                                    </div>

                                </a>
                                {{-- old --}}
                                {{-- <a href="#"><i class="bi bi-three-dots-vertical p-1 text-muted btn"></i></a> --}}

                                {{-- new with overlay --}}
                                <div x-data="{ showOptions: false }" class="position-relative d-inline-block">
                                    <a href="#" class="btn color-bg-blue-light text-primary mr-1 fw-bold">See
                                        the
                                        job offer</a>
                                    <!-- Three dots button -->
                                    <a href="#" @click.prevent="showOptions = !showOptions" class="text-muted">
                                        <i class="bi bi-three-dots-vertical p-1 btn"></i>
                                    </a>

                                    <!-- Overlay card -->
                                    <div x-show="showOptions" @click.away="showOptions = false"
                                        style="display: none;" class="card overlay-card position-absolute end-0 mt-1"
                                        x-transition>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item hover_color">
                                                <a href="#"
                                                    class="text-decoration-none text-dark w-100"><small>Unfollow</small></a>
                                            </li>
                                            <li class="list-group-item hover_color">
                                                <a href="#" class="text-decoration-none text-dark"><small>Not
                                                        Interested</small></a>
                                            </li>
                                            <li class="list-group-item hover_color">
                                                <a href="#" class="text-decoration-none text-dark"><small>
                                                        Copy link</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <p>You have to match the convenience of the gasoline car in order for people to buy an
                                electric
                                car. "In order to have clean air in cities, you have to go electric.” "You should not
                                show
                                somebody something very cool and then not do it. At Tesla, any prototype that is shown
                                to
                                customers, the production must be better.</p>
                            <div class="image-container">
                                <img src="https://via.placeholder.com/300" alt="Post Image"
                                    class="img-fluid rounded w-100">
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <div>
                                    <button class="btn btn-light" data-bs-toggle="tooltip" title="Like">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                    </button>
                                    <button class="btn btn-light" data-bs-toggle="tooltip" title="Comment"
                                        @click="showComments = !showComments">
                                        <i class="bi bi-chat"></i>
                                    </button>
                                    {{-- <button class="btn btn-light" data-bs-toggle="tooltip" title="Share">
                                    <i class="bi bi-share"></i>
                                     </button> --}}
                                </div>
                                <button class="btn btn-light" data-bs-toggle="tooltip" title="Save">
                                    <i class="bi bi-save"></i>
                                </button>
                            </div>

                            {{-- comments section --}}
                            <div class="comments mt-3" x-show="showComments" x-transition x-cloak>
                                <div class="d-flex align-items-start mb-3">
                                    <img src="https://via.placeholder.com/40"
                                        class="bg-secondary profile-picture-placeholder me-2"
                                        style="min-width: 40px;">
                                    </img>
                                    <form action="" method="post" class="d-flex flex-grow-1">
                                        @csrf
                                        <textarea class="form-control me-2 comment-input" rows="1" placeholder="Add a comment..." required
                                            oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, parseInt(getComputedStyle(this).lineHeight) * 4) + 'px';"></textarea>
                                        <button type="submit" class="btn btn-primary">Post</button>
                                    </form>
                                </div>

                                <div class="comment">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40"
                                                class="bg-secondary profile-picture-placeholder"></img>
                                            <div class="ms-3">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0">Kapil Kasture</h6>
                                                </div>
                                                <small class="text-muted" style="font-size: 13px;">MERN Stack
                                                    Developer</small>
                                            </div>
                                        </div>
                                        <small class="text-muted ml-1">1 day ago</small>
                                    </div>
                                    <div style="margin-left: 40px">
                                        <p class="mt-2 ms-3 mb-0">Just to confirm these questions are for entry-level
                                            MERN
                                            dev?</p>
                                        <div class="ml-3">

                                            <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder pe-1"
                                                style="font-size: 13px;">Like</a><span class="text-muted">|</span>
                                            <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1 disabled"
                                                style="font-size: 13px;">Reply (Soon)</a>
                                        </div>

                                    </div>
                                </div>

                                <button class="btn btn-link text-decoration-none mt-3">Load more comments</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 p-0">
                @livewire('ChatAndFeed')

            </div>
        </div>
    </div>

</div>
