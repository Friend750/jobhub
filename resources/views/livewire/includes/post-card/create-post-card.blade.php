<div class="create-post-card card mb-3 rounded">

    <div class="card-body d-flex justify-content-center align-items-center">
        <input type="text" class="form-control w-100 ps-3 bg-light" placeholder="اكتب شيئا..."
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
                <div class="col-lg-6" style="position: relative;">
                    <div class="card post-card rounded " @click.outside="showCard = false">

                        <div class="card-body" x-data="FormType(@this)">
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-end gap-2">
                                    <div class="d-flex gap-1">
                                        <img src="{{asset('storage/' . auth()->user()->user_image) ?? 'https://ui-avatars.com/api/?name=User' }}"
                                            alt="User" class="rounded-circle" style="height: 50px;">

                                        <div class="d-flex flex-column gap-1">

                                            <h5 class="mb-0">{{auth()->user()->personal_details->first_name ?? ''}}
                                                {{auth()->user()->personal_details->last_name ?? ''}}
                                            </h5>
                                            <small class="text-muted bg-secondary badge bg-secondary-subtle"
                                                style="width: fit-content">
                                                {{auth()->user()->personal_details->specialist}}
                                            </small>
                                        </div>
                                    </div>


                                </div>

                                {{-- dropdowns --}}
                                <div class="d-flex align-items-center gap-2">
                                    {{-- post Visibility--}}
                                    <div class="form-check form-check-reverse form-switch ms-1">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="postVisibilitySwitch"
                                            wire:change="setAudience({{ $target === 'to_any_one' ? "'connection_only'" : "'to_any_one'" }})"
                                            {{ $target === 'connection_only' ? '' : 'checked' }}>
                                        <label class="form-check-label" for="postVisibilitySwitch">
                                            <small class="fw-bold">
                                                عام
                                            </small>
                                        </label>

                                    </div>

                                    {{-- post type --}}
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-light btn-sm dropdown-toggle p-1 px-2 color-bg-blue-light"
                                            type="button" id="postAudienceDropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <small class="fw-bold"
                                                x-text="selected === 'content-article' ? 'مقالة' : 'عرض وظيفة'"></small>
                                        </button>
                                        <ul class="dropdown-menu p-1" aria-labelledby="postAudienceDropdown">
                                            <li>
                                                <a href="#" class="dropdown-item"
                                                    @click.prevent="selected = selected === 'content-article' ? 'content-job-offer' : 'content-article'">
                                                    <small
                                                        x-text="selected === 'content-article' ? 'عرض وظيفة' : 'مقالة'"></small>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
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
                                <div class="w-100 flex-grow-1">
                                    {{-- ignore must be in a parent container --}}
                                    <div wire:ignore>
                                        <select id="multiDropdown" class="form-select"
                                            data-placeholder="اختياري: أضف علامة (علامات) للوصول إلى المزيد عند النشر العام"
                                            multiple>
                                            @foreach ($interests as $key => $interest)
                                                <option value="{{ $interest->name }}">{{ $interest->name }}
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


@script()
<script>
    // Initialize the select2 widget with a placeholder text and allow multiple selection
    $(document).ready(function () {
        $('#multiDropdown').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            // closeOnSelect: false,
            allowClear: true,

        });

        // Add custom event listeners to the select2 widget
        $('#multiDropdown').on('change', function () {
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
