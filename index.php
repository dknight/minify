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

require_once 'models/MinifyPage.php';

Plugin::setInfos(array(
    'id'          => 'minify',
    'title'       => 'Minify',
    'description' => 'Minifies and combines JavaScript and CSS', 
    'version'     => '0.1.1',
    'license'     => 'MIT',
    'author'      => 'Dmitri Smirnov',
    'update_url'  => 'http://www.dmitri.me/misc/frog-plugins.xml',
    'website'     => 'http://www.dmitri.me/'
));

AutoLoader::addFolder(dirname(__FILE__) . '/lib');

Plugin::addController('minify', 'Minify', '', false);

Observer::observe('page_found', 'minify_grab');

function minify_grab($page)
{
    //$output = MinifyPage::content($page);
    
    //$cssFiles = array();
    //$jsFiles  = array();
    
    //preg_match_all('/(src=)(\'|\")(.+?)\.js(\'|\")/i', $output, $matches);
    //print_r($matches[3][0] . '.js');
    
    //exit();
}
