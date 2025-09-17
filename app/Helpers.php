<?php

if (!function_exists('highlightMentions')) {
    /**
     * Highlight @mentions in a text by wrapping them in a span.
     */
    function highlightMentions($text)
    {
        // Escape text first to prevent XSS
        $text = e($text);

        // Use regex to find mentions and wrap them in a span
        return preg_replace('/@(\w+)/', '<span class="mention">@$1</span>', $text);
    }
}
