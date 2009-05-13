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
        $this->assignToLayout('sidebar',
                              new View('../../plugins/minify/views/sidebar'));
    }

    function index()
    {
        $this->display('minify/views/index');
    }
    
    function addCacheDir()
    {
        $path = FROG_ROOT . '/cache/';
        @mkdir($path);
        @chmod($path, 0777);
        $this->display('minify/views/index',
                       array('failed' => 'Failed to create /cache/ direcory and'
                                       . ' give to it appropriate persmissions.'
                                       . 'Try to do it mannualy.'));
    }
}
