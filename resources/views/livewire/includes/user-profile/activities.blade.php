<div class="card mb-3 rounded">
    <div class="card-body">
        <h5 class="card-title mb-3">المنشورات</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active text-dark" id="articles-tab" data-bs-toggle="tab" href="#articles"
                    role="tab" aria-controls="articles" aria-selected="true">مقالات</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark" id="jobs-tab" data-bs-toggle="tab" href="#jobs" role="tab"
                    aria-controls="jobs" aria-selected="false">وظائف</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            {{-- articles --}}
            @include('livewire.includes.user-profile.ArticlesSlider')
            {{-- jops --}}
            @include('livewire.includes.user-profile.JopsSliders')

        </div>


    </div>
</div>

