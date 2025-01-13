<div class="create-post-card card mb-3 rounded">

    <div class="card-body d-flex justify-content-center align-items-center">
        <input type="text" class="form-control w-100 ps-3 bg-light" placeholder="Write something..."
            @click="showCard = true">
        <div class="btn bg-light ms-2 p-2 rounded-circle ml-2" style="width: 40px; height: 40px;" @click="showCard = true">
            <i class="bi bi-image"></i>
        </div>
    </div>

</div>

<!-- Overlay -->
<div x-show="showCard" @keydown.escape.window="showCard = false" style="display: none;">

    <div class="overlay d-flex" x-show="showCard" x-transition>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card post-card rounded " @click.outside="showCard = false">

                        <div class="card-body" x-data="{ selected: 'content-article' }">
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center ">
                                    <img src="https://via.placeholder.com/50" alt="User" loading="lazy"
                                        class="rounded-circle me-3 h-100">

                                    <div class="userInfo">
                                        <h5 class="mb-0">Elon Musk</h5>
                                        <div class="d-flex align-items-center ">
                                            <small class="text-muted mr-3 ">CEO of SpaceX</small>

                                            {{-- post visibality --}}
                                            <div class="dropdown mr-1">
                                                <button
                                                    class="btn btn-light btn-sm dropdown-toggle py-0 color-bg-blue-light"
                                                    type="button" id="postAudienceDropdown" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Post to anyone
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="postAudienceDropdown">
                                                    <li><a class="dropdown-item" href="#"><small>Post to
                                                                anyone</small> </a></li>
                                                    <li><a class="dropdown-item" href="#"><small>Connections
                                                                only</small> </a></li>
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
                                            <img src="{{ $mediaPreview }}" alt="Image Preview" loading="lazy"
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
                                                <input type="text" name="job_location" id="job_location"
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
                                                <input type="text" name="job_timing" id="job_timing"
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
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="flex-grow-1 me-2">

                                    {{-- ignore must be in a parent container --}}
                                    <div wire:ignore>

                                        <select id="multiDropdown" style="width: 100%;" multiple>
                                            @foreach ($interests as $key => $interest)
                                                <option value="{{ $interest }}">{{ $interest }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <div class="d-flex align-items-center">

                                    <div x-show="selected === 'content-article'">

                                        <label for="fileInput" class="btn color-bg-blue-light rounded m-0 me-2">
                                            <i class="bi bi-image"></i>
                                            <input type="file" id="fileInput" accept="image/*" class="d-none"
                                                wire:model="media">
                                        </label>

                                    </div>

                                    <button type="submit" class="btn btn-primary rounded"
                                        style="height: fit-content;" wire:click='submit'>Post</button>

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
            $(document).ready(function() {
                $('#multiDropdown').select2({
                    placeholder: 'Select a tag(s) to reach more',
                    allowClear: true,

                });

                // Add custom event listeners to the select2 widget
                $('#multiDropdown').on('change', function() {
                    // Get the selected options
                    let $data = $(this).val();

                    // Update the selectedCities property from the Blade
                    // with false indicating that no server request is made or simply use the method 2

                    // method 1
                    $wire.set('selectedCities', $data, false);

                    // method 2
                    // $wire.selectedCities =$data;
                });


            });
        </script>
    @endscript

</div>
