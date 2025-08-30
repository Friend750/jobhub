<style>
    .copy-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-decoration: none;
        color: #343a40;
        cursor: pointer;
        /* padding: 0.5rem; */
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .copy-icon {
        color: #6c757d;
        transition: color 0.2s ease;
        font-size: 1.1rem;
    }

    .copy-link:hover .copy-icon {
        color: #4a6bdf;
    }

    .copied-text {
        color: #28a745;
        font-weight: 600;
    }
</style>

<div class="d-flex justify-content-start align-items-center gap-2">

    @if ($post->type === 'job')
        <a href="{{ Route('jobList', $post->id) }}"
            class="btn color-bg-blue-light text-primary mr-1 fw-bold d-flex align-items-center gap-1">
            <span>معرفة التفاصيل</span>
            <i class="fa-solid fa-square-arrow-up-right"></i>
        </a>
    @endif


    <div x-data="{ showOptions: false, copied: false }" class="position-relative d-inline-block">
        <a href="#" @click.prevent="showOptions = !showOptions" class="text-muted">
            <i class="bi bi-three-dots-vertical p-1 btn"></i>
        </a>

        <div x-show="showOptions" @click.away="showOptions = false" x-cloak class="card overlay-card absolute"
            x-transition>
            <ul class="list-group list-group-flush">
                @if (auth()->user()->id != $post->user_id)
                    @php
                        // Read status from backend once
                        $status = $this->getFollowStatus($post->user_id);
                        $isFollowing = $status['isFollowing'];
                        $isRequested = $status['isRequested'];
                    @endphp

                    <li class="list-group-item hover_color" wire:ignore x-data="{
                        isFollowing: @json($isFollowing),
                        isRequested: @json($isRequested)
                    }">
                        <a href="#" class="text-decoration-none text-dark w-100 d-flex justify-content-between"
                            @click.prevent="
           if (!isRequested) {
               if (isFollowing) {
                   isFollowing = false;
                   $wire.unFollow({{ $post->user_id }});
               } else {
                   isRequested = true;
                   $wire.follow({{ $post->user_id }});
               }
           }
       ">
                            <small
                                x-text="isFollowing ? 'إلغاء المتابعة' : (isRequested ? 'تم الطلب' : 'متابعة')"></small>
                            <i
                                :class="isFollowing ? 'bi bi-person-dash' : (isRequested ? 'bi bi-clock-history' :
                                    'bi bi-person-plus')"></i>
                        </a>
                    </li>

                    {{-- <li class="list-group-item hover_color">
                    <a href="#" class="text-decoration-none text-dark d-flex justify-content-between">
                        <small>غير مهتم</small>
                        <i class="bi bi-emoji-expressionless"></i>
                    </a>
                </li> --}}
                @endif
                <li class="list-group-item hover_color" x-data="{ copied: false }">
                    <a x-on:click="
                        navigator.clipboard.writeText('{{ $post->type === 'job' ? url('/JobList') : url('/article-link') }}/{{ $post->id }}');
                        copied = true;
                        setTimeout(() => copied = false, 3000);
                        "
                        class="copy-link">
                        <small>
                            <span x-show="!copied">نسخ الرابط</span>
                            <span x-show="copied" x-cloak class="copied-text">تم نسخ الرابط!</span>
                        </small>
                        <i class="bi bi-link-45deg copy-icon" x-show="!copied"></i>
                        <i class="bi bi-check-lg copied-text" x-show="copied"></i>
                    </a>
                </li>
                @if (auth()->user()->id === $post->user_id)
                    <li class="list-group-item hover_color">
                        <a class="text-decoration-none text-danger fw-bold d-flex justify-content-between"
                            style="cursor: pointer" wire:click='deletePost({{ $post->id }}, "{{ $post->type }}")'>
                            <small>حذف المنشور</small>
                            <i class="bi bi-trash"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

</div>
