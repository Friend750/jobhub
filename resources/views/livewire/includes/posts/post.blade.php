<div>
    @foreach ($allPosts as $post)
        <div class="card mb-3" wire:key="post-{{ $post->id }}">
            <div class="card-body p-0" x-data="{ showComments: false }">
                <div class="top-content p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('user-profile', $post->user_id)}}" class="text-decoration-none text-dark">
                            <div class="d-flex align-items-start">
                                <img src="{{ $post->user->user_image ? asset('storage/' . $post->user->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->personal_details->first_name ?? 'User') }}"
                                    alt="User" loading="lazy" class="rounded-circle ms-2 post-img">

                                <div class="d-flex flex-column gap-0">
                                    <h6 class="mb-0">{{ $post->user->personal_details->first_name ?? 'مستخدم' }}
                                        {{ $post->user->personal_details->last_name ?? 'مستخدم' }}
                                    </h6>
                                    <small
                                        class="fw-bold text-muted very-small-text">{{ $post->user->personal_details->specialist ?? 'null' }}</small>
                                    <small
                                        class="very-small-text d-flex align-items-center gap-1">{{$post->created_at->diffForHumans()}}
                                        @if ($post->target === 'to_any_one')
                                            •
                                            <i class="fa-solid fa-earth-americas"></i>
                                        @endif

                                    </small>

                                </div>
                            </div>
                        </a>

                        @include('livewire.includes.posts.post-options')
                    </div>

                    @includeWhen($post->type == 'job', 'livewire.includes.posts.job-content')
                    @includeWhen($post->type == 'post', 'livewire.includes.posts.post-content')

                    <div class="mt-2">
                        @php
                            $tags = is_string($post->tags) ? json_decode($post->tags, true) : $post->tags;
                            $tags = $tags ?? []; // Fallback if null
                        @endphp

                        @forelse($tags as $tag)
                            <span class="badge bg-secondary-subtle text-muted me-1">{{ $tag }}#</span>
                        @empty
                        @endforelse
                    </div>
                </div>

                @includeWhen($post->type == 'post' && $post->post_image, 'livewire.includes.posts.post-media')

                <div class="buttom-content p-3">
                    @includeWhen(true, 'livewire.includes.posts.interactions')
                    @includeWhen(true, 'livewire.includes.post-card.comments')
                </div>
            </div>
        </div>
    @endforeach

    <div x-data="{ hasMore: @js($allPosts->hasMorePages()) }">
        <template x-if="hasMore">
            <div x-intersect="@this.loadMore()" class="text-center py-4 text-muted">
                جاري تحميل المزيد...
            </div>
        </template>

        <div x-show="!hasMore" class="text-center py-4 text-muted">
            لا توجد المزيد من المنشورات
        </div>
    </div>
</div>
