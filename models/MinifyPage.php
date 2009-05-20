<?php
/*
 * Minify - Frog CMS plugin
 *
 * Copyright (c) 2009 Dmitri Smirnov
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.dmitri.me/
 */
class MinifyPage
{
    public static function content($page)
    {
        ob_start();
        $page->_executeLayout();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}