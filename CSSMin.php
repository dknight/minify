<?php
/**
*   The simpliest CSS minifier
*/
class CSSMin
{
    /**
     *  Minifies CSS
     *
     *  @param string CSS input
     *  @return string
     */
    public static function minify($css)
    {
        // Compress whitespace.
        $css = preg_replace('/\s+/', ' ', $css);
    
        // Remove comments.
        $css = preg_replace('/\/\*.*?\*\//', '', $css);
    
        return trim($css);
    }
    
    /**
     *  Rewrites CSS paths (eg. for images). Syntax is identival to native PHP
     *  function preg_replace.
     *
     *  @param string Pattern /regexp/
     *  @param string Replacement /regexp/
     *  @param string CSS input
     */
    public static function cssPathsRewrite($pattern, $replacement, $css)
    {
        return preg_replace($pattern, $replacement, $css);
    }
}
