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

Plugin::setInfos(array(
    'id'          => 'minify',
    'title'       => 'Minify',
    'description' => 'Minifies and combines JavaScript and CSS', 
    'version'     => '0.1.2',
    'license'     => 'MIT',
    'author'      => 'Dmitri Smirnov',
    'update_url'  => 'http://www.dmitri.me/misc/frog-plugins.xml',
    'website'     => 'http://www.dmitri.me/'
));

AutoLoader::addFolder(dirname(__FILE__) . '/lib');

Plugin::addController('minify', 'Minify', '', false);