<?php

if (!function_exists('parse_youtube_id')) {
    /**
     * Phân tích ID video từ URL YouTube.
     *
     * @param string $url
     * @return string|null
     */
    function parse_youtube_id($url)
    {
        $youtubeRegex = '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|v\/|embed\/|watch\?v=|watch\?.+&v=)?([^"&?\/\s]{11})/';
        preg_match($youtubeRegex, $url, $matches);
        return $matches[1] ?? null;
    }
}
