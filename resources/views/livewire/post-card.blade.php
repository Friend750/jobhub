@push('styles')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div>
    <div class="container">
        <div class="container gap-3 d-flex justify-content-end col-md-10">


            <div class="col-lg-6" x-data="postCard(@this)">

                <!-- alert Success message -->

                <div x-show="message" x-cloak class="alert alert-success alert-dismissible mt-0 rounded fade show">
                    <span x-text="message"></span>
                    <button type="button" x-on:click="message =''" class="btn-close" aria-label="Close"></button>
                </div>

                @include('livewire.includes.post-card.create-post-card', ['showCard' => 'showCard'])


                {{-- post --}}
                <div class="card mb-3">
                    <div class="card-body p-0" x-data="{ showComments: false }">
                        <div class="top-content p-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="#" class="text-decoration-none text-dark">

                                    <div class="d-flex">
                                        <img src="https://ui-avatars.com/api/?name=User" alt="User" loading="lazy"
                                            class="rounded-circle me-2">
                                        <div class="d-flex flex-column">
                                            <h5 class="mb-0">Elon Musk</h5>
                                            <small class="text-muted" id="text-muted">CEO of SpaceX</small>
                                        </div>
                                    </div>

                                </a>


                                <div x-data="{ showOptions: false }" class="position-relative d-inline-block">
                                    <a href="#" class="btn color-bg-blue-light text-primary mr-1 fw-bold">See
                                        the
                                        job offer</a>

                                    <a href="#" @click.prevent="showOptions = !showOptions" class="text-muted">
                                        <i class="bi bi-three-dots-vertical p-1 btn"></i>
                                    </a>


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

                        </div>

                        <img src="https://ui-avatars.com/api/?name=Image" alt="Post Image" loading="lazy"
                            class="img-fluid w-100 rounded-0">

                        <div class="buttom-content p-3">
                            <div class="d-flex justify-content-between">
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
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('postCard', (wire) => ({
            showCard: false,
            message: '',
            toggleBodyScroll() {
                document.body.style.overflow = this.showCard ? 'hidden' : '';
            },
            resetWhenClose() {
                if (!this.showCard) {
                    wire.resetAllForms();
                }
            },
            handleEvent(data) {
                this.message = data[0].message;
                this.showCard = false;
                setTimeout(() => this.message = '', 3000);
            },
            init() {
                this.$watch('showCard', () => this.toggleBodyScroll());
                this.$watch('showCard', () => this.resetWhenClose());
                // Listen for the 'article-posted' event
                Livewire.on('article-posted', (data) => this.handleEvent(data));

                // Listen for the 'job-offer-posted' event
                Livewire.on('job-offer-posted', (data) => this.handleEvent(data));
            }
        }));
    });
</script>
