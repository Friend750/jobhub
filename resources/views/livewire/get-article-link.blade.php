@push('styles')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div>
    <div>
        <div wire:ignore>
            <div id="loadData" style="width: 100%;">
                <div class="d-flex justify-content-center align-items-center vh-100 bg-white">
                    <div class="d-flex flex-column align-items-center">
                        <span class="loader"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="content">
            <div style="width: 100%;">
                <div>
                    <div class="container">
                        <div class="container gap-3 d-flex justify-content-end col-md-12">
                            <div class="col-lg-3 p-0 d-flex justify-content-end">
                                <div class="MakeSticky w-75" style="
            height: fit-content;">
                                    @livewire('manage-network')
                                </div>
                            </div>
                            <div class="col-lg-6">

                                {{-- @include('livewire.includes.get-post-link.article-link') --}}

                                @foreach ($this->Posts as $post)
                                    @include('livewire.includes.get-post-link.article-link', [
                                        'post' => $post,
                                    ])
                                @endforeach

                            </div>
                            <div class="col-lg-3 p-0">
                                <div class="MakeSticky w-75">
                                    @livewire('ChatAndFeed')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            document.getElementById('loadData').style.display = 'none';
            document.getElementById('content').style.display = 'block';
        });
    </script>

</div>
