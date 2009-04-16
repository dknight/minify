<?php
/**
*   The simpliest CSS minifier
*/
class CSSMin
{
    public static function minify($css) {
        
        // Compress whitespace.
        $css = preg_replace('/\s+/', ' ', $css);
    
        // Remove comments.
        $css = preg_replace('/\/\*.*?\*\//', '', $css);
    
        return trim($css);
    }
}
