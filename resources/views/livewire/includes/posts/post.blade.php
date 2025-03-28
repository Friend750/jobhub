@foreach ($allPosts as $post)
    <div class="card mb-3">
        <div class="card-body p-0" x-data="{ showComments: false }">
            <div class="top-content p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="#" class="text-decoration-none text-dark">
                        <div class="d-flex align-items-center">
                            <img src="{{ $post->user->user_image ? asset('storage/' . $post->user->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->personal_details->first_name ?? 'User') }}"
                                alt="User" loading="lazy" class="rounded-circle ms-2"
                                style="width: 40px; height: 40px; object-fit: cover;">

                            <div class="d-flex flex-column gap-0">
                                <h5 class="mb-0">{{ $post->user->personal_details->first_name ?? 'مستخدم' }}
                                    {{ $post->user->personal_details->last_name ?? 'مستخدم' }}
                                </h5>
                                <small
                                    class="fw-bold text-muted">{{ $post->user->personal_details->specialist ?? 'null' }}</small>
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
                        <span class="text-muted">لا توجد وسوم</span>
                    @endforelse
                </div>
            </div>

            @includeWhen($post->type == 'post' && $post->post_image, 'livewire.includes.posts.post-media')

            <div class="buttom-content p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <button wire:click='toggleLike({{ $post->id }}, "{{ $post->type }}")' class="btn btn-light"
                            data-bs-toggle="tooltip" title="إعجاب">
                            <i class="bi bi-hand-thumbs-up"></i>
                        </button>
                        <button class="btn btn-light" data-bs-toggle="tooltip" title="تعليق"
                            @click="showComments = !showComments">
                            <i class="bi bi-chat"></i>
                        </button>
                    </div>
                    <button class="btn btn-light" data-bs-toggle="tooltip" title="حفظ">
                        <i class="bi bi-save"></i>
                    </button>
                </div>

                @include('livewire.includes.post-card.comments')

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach
