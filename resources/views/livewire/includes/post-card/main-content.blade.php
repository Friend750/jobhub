<div>
    <div class="container">
        <div class="container gap-3 d-flex justify-content-end col-md-12">


            <div class="col-lg-3 p-0 d-flex justify-content-end">
                <div class="MakeSticky w-75" style="
            height: fit-content;">
                    @livewire('manage-network')
                </div>
            </div>


            <div class="col-lg-6" x-data="postCard(@this)">


                @include('livewire.includes.post-card.create-post-card')

                <!-- Alert Success message -->
                <div x-show="message" x-transition x-cloak
                    class="alert alert-success alert-dismissible mb-3 rounded fade show">
                    <button type="button" x-on:click="hideAlert()" class="btn-close" aria-label="إغلاق"></button>
                    <span x-text="message"></span>
                </div>

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
            showAlert: false,
            isProcessing: false,

            toggleBodyScroll() {
                document.body.style.overflow = this.showCard ? 'hidden' : '';
            },

            resetWhenClose() {
                if (!this.showCard) {
                    wire.resetAllForms();
                }
            },

            hideAlert() {
                this.showAlert = false;
                this.message = '';
            },

            // For processing completion
            handleProcessingComplete() {
                console.log('Processing completed');
                this.showCard = false,
                    this.isProcessing = false,
                    this.message = 'Post completed successfully!';
                // setTimeout(() => this.hideAlert(), 3000);
            },

            init() {
                this.$watch('showCard', () => this.toggleBodyScroll());
                this.$watch('showCard', () => this.resetWhenClose());

                // Listen for the 'article-posted' event (completion)
                Livewire.on('article-posted', () => this.handleProcessingComplete());

                // Listen for the 'job-offer-posted' event
                Livewire.on('job-offer-posted', (data) => this.handleProcessingComplete(data));
            }
        }));
    });
</script>
