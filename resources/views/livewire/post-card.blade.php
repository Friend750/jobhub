@push('styles')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div>
    <div class="container">
        <div class="container gap-3 d-flex justify-content-end col-md-12">


            <div class="col-lg-4"></div>
            <div class="col-lg-5" x-data="postCard(@this)">

                <!-- alert Success message -->

                <div x-show="message" x-cloak class="alert alert-success alert-dismissible mt-0 rounded fade show">
                    <span x-text="message"></span>
                    <button type="button" x-on:click="message =''" class="btn-close" aria-label="Close"></button>
                </div>

                @include('livewire.includes.post-card.create-post-card', ['showCard' => 'showCard'])

                @include('livewire.includes.posts.post')
            </div>

            <div class="col-lg-3 p-0">
                <div class="MakeSticky w-75">
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
