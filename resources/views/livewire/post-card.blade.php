@push('styles')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
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
        <div style="width: 100%;" >
            @include('livewire.includes.post-card.main-content')
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        document.getElementById('loadData').style.display = 'none';
        document.getElementById('content').style.display = 'block';
    });
</script>

