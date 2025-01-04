<div>
    <div wire:loading.target="loadData" wire:loading.class="d-block">
        <!-- Spinner: Shows while `loadData` is running -->
        <div class="d-flex justify-content-center align-items-center vh-100 bg-white">
            <div class="d-flex flex-column align-items-center">
                <h1 class="logoName mb-2">YemenJobs</h1>
                <span class="loader"></span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div wire:init="loadData">
        <div style="width: 100%;" wire:loading.remove>
            @include('livewire.includes.home-page.home-page-sections')
        </div>
    </div>
</div>
