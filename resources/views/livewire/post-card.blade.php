@push('styles')
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
<link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3"></div>

            <div class="col-lg-6" x-data="{ showCard: false }">

                @if (session()->has('message'))
                    <div class="alert alert-success mt-0">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- create post card --}}
                @include('livewire.includes.post-card.create-post-card')

                {{-- post card --}}

                <div class="AllPosts">

                    {{-- post card --}}
                    <div class="card mb-3">
                        <div class="card-body" x-data="{ showComments: false }">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="#" class="text-decoration-none text-dark">

                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/50" alt="User" loading="lazy"
                                            class="rounded-circle me-3 mr-3">
                                        <div class="">
                                            <h5 class="mb-0">Elon Musk</h5>
                                            <small class="text-muted">CEO of SpaceX</small>
                                        </div>
                                    </div>

                                </a>

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
                                    <div x-show="showOptions" @click.away="showOptions = false" style="display: none;"
                                        class="card overlay-card position-absolute end-0 mt-1" x-transition>
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
                                <img src="https://via.placeholder.com/300" alt="Post Image" loading="lazy"
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
                                </div>
                                <button class="btn btn-light" data-bs-toggle="tooltip" title="Save">
                                    <i class="bi bi-save"></i>
                                </button>
                            </div>

                            {{-- comments section --}}
                            <div class="comments mt-3" x-show="showComments" x-transition x-cloak>
                                <div class="d-flex align-items-start mb-3">
                                    <img src="https://via.placeholder.com/40" loading="lazy"
                                        class="bg-secondary profile-picture-placeholder me-2" style="min-width: 40px;">
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
                                            <img src="https://via.placeholder.com/40"  loading="lazy"
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
                    {{-- post card --}}
                    <div class="card mb-3">
                        <div class="card-body" x-data="{ showComments: false }">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="#" class="text-decoration-none text-dark">

                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/50" alt="User" loading="lazy"
                                            class="rounded-circle me-3 mr-3">
                                        <div class="">
                                            <h5 class="mb-0">Elon Musk</h5>
                                            <small class="text-muted">CEO of SpaceX</small>
                                        </div>
                                    </div>

                                </a>

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
                                    <div x-show="showOptions" @click.away="showOptions = false" style="display: none;"
                                        class="card overlay-card position-absolute end-0 mt-1" x-transition>
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
                                <img src="https://via.placeholder.com/300" alt="Post Image" loading="lazy"
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
                                </div>
                                <button class="btn btn-light" data-bs-toggle="tooltip" title="Save">
                                    <i class="bi bi-save"></i>
                                </button>
                            </div>

                            {{-- comments section --}}
                            <div class="comments mt-3" x-show="showComments" x-transition x-cloak>
                                <div class="d-flex align-items-start mb-3">
                                    <img src="https://via.placeholder.com/40" loading="lazy"
                                        class="bg-secondary profile-picture-placeholder me-2" style="min-width: 40px;">
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
                                            <img src="https://via.placeholder.com/40"  loading="lazy"
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
                <div class="MakeSticky">
                    @livewire('ChatAndFeed')
                </div>
            </div>
        </div>
    </div>

</div>
