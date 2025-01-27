<div>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6" x-data="{ showCard: false }">

                {{-- create post card --}}
                @include('livewire.includes.post-card.create-post-card')

                @if (session()->has('message'))
                    <div class="alert alert-success mt-0 alert-dismissible rounded fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- post card --}}

                <div class="AllPosts">

                    {{-- post --}}
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
                            @include('livewire.includes.post-card.comments')
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
