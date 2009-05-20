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
 
class MinifyController extends PluginController
{
    function __construct()
    {
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn()) {
            redirect(get_url('login'));
        }
        
        $this->setLayout('backend');
    }
    
    function documentation()
    {
        $this->display('minify/views/documentation');
    }
    
}
