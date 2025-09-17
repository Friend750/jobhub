<div wire:ignore>
    <div dir="auto">
        <p class="post-content" data-post-id="{{ $post->id }}" style="white-space: pre-line;">
            {{-- {{ $post->content }} --}}
            {!! highlightMentions($post->content) !!}
        </p>
    </div>
</div>
