<div wire:ignore>
    <div dir="auto">
        <p class="post-content" data-post-id="{{ $post->id }}" style="white-space: pre-wrap;">{{ $post->content }}</p>
    </div>
</div>
<script>
    // Create a single, reusable function for formatting mentions.
    function formatMentions(element) {
        if (!element) return; // Exit if the element doesn't exist.

        // Use textContent to get the raw text and prevent issues with existing HTML.
        let content = element.textContent;
        const mentionPattern = /(?<!\S)@([a-zA-Z0-9_\u00A0\uFEFF]+)/g;
        let newContent = content.replace(mentionPattern, '<strong>$&</strong>');
        element.innerHTML = newContent;
    }

    // A. Initial page load (for all existing posts)
    document.addEventListener('DOMContentLoaded', function() {
        const postContentElements = document.querySelectorAll('.post-content');
        postContentElements.forEach(element => formatMentions(element));
    });

    // B. For new posts created via Livewire
    document.addEventListener('alpine:init', () => {
        Livewire.on('article-posted', (postId) => {
            console.log('article-posted');

            // Find the newly created post by a specific ID or attribute
            // (assuming Livewire returns the new post's ID).
            // const newPostElement = document.querySelector(`.post-content[data-post-id="${postId}"]`);

            // // Only format the new post, not all of them.
            // formatMentions(newPostElement);
        });
    });
</script>
