<div class="create-post-card card mb-3 rounded">

    <div class="card-body d-flex justify-content-center align-items-center">
        <input type="text" class="form-control w-100 ps-3 bg-light" placeholder="Write something..."
            x-on:click="showCard = true">
        <div class="btn bg-light me-2 p-2 rounded-circle " style="width: 40px; height: 40px;"
            x-on:click="showCard = true">
            <i class="bi bi-image"></i>
        </div>
    </div>

</div>
<!-- Overlay -->
<div x-show="showCard" @keydown.escape.window="showCard = false" x-cloak>

    <div class="overlay d-flex" x-show="showCard" x-transition>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card post-card rounded " @click.outside="showCard = false">

                        <div class="card-body" x-data="FormType(@this)">
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center ">
                                    <img src="https://ui-avatars.com/api/?name=User" alt="User"
                                        class="rounded-circle me-2 h-100">

                                    <div class="userInfo">
                                        <h5 class="mb-0">Elon Musk</h5>
                                        <div class="d-flex align-items-center ">
                                            <small class="text-muted me-3 ">CEO of SpaceX</small>

                                            {{-- post visibality --}}
                                            <div class="dropdown me-1">
                                                <button
                                                    class="btn btn-light btn-sm dropdown-toggle py-0 color-bg-blue-light"
                                                    type="button" id="postAudienceDropdown" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    {{ $target === 'to_any_one' ? 'Post to anyone' : 'Connections only'
                                                    }}
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="postAudienceDropdown">
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click.prevent="setAudience('to_any_one')">
                                                            <small>Post to anyone</small>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click.prevent="setAudience('connection_only')">
                                                            <small>Connections only</small>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>


                                            {{-- post type --}}
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-light btn-sm dropdown-toggle py-0 color-bg-blue-light"
                                                    type="button" id="postAudienceDropdown" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <span
                                                        x-text="selected === 'content-article' ? 'Article' : 'Job Offer'"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="postAudienceDropdown">
                                                    <li>
                                                        <a href="#" class="dropdown-item"
                                                            @click.prevent="selected = selected === 'content-article' ? 'content-job-offer' : 'content-article'">
                                                            <small
                                                                x-text="selected === 'content-article' ? 'Job Offer' : 'Article'"></small>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" x-on:click="showCard = false"
                                    aria-label="Close"></button>
                            </div>

                            {{-- card body --}}
                            <template x-if="selected === 'content-article'">
                                @include('livewire.includes.post-card.articleForm')
                            </template>

                            <template x-if="selected === 'content-job-offer'">
                                @include('livewire.includes.post-card.JobOfferForm')
                            </template>

                            {{-- card footer --}}
                            <div class="d-flex mt-3 align-items-end justify-content-between">
                                <div class="me-2 w-100 flex-grow-1">
                                    {{-- ignore must be in a parent container --}}
                                    <div wire:ignore>
                                        <select id="multiDropdown" class="form-select"
                                            data-placeholder="Optional: Add tag(s) to reach more when public" multiple>
                                            @foreach ($interests as $key => $interest)
                                            <option value="{{ $interest->id }}">{{ $interest->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 0.5rem;
    }

    .post-card {

        position: fixed;
        top: 3rem;
        width: 46%;
        left: 27%;
    }
</style>

@script()
<script>
    // Initialize the select2 widget with a placeholder text and allow multiple selection
        $(document).ready(function() {
            $('#multiDropdown').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                // closeOnSelect: false,
                allowClear: true,

            });

            // Add custom event listeners to the select2 widget
            $('#multiDropdown').on('change', function() {
                // Get the selected options
                let $data = $(this).val();

                // Update the selectedInterests property from the Blade
                // with false indicating that no server request is made or simply use the method 2

                // method 1
                $wire.set('selectedInterests', $data, false);

                // method 2
                // $wire.selectedInterests =$data;
            });


        });
</script>
@endscript

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('FormType', (wire) => ({
            selected: 'content-article',

            resetForms() {
                wire.resetForm(this.selected);

            },
            init() {
                this.$watch('selected', () => this.resetForms());
            }
        }));
    });
</script>