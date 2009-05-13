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
    'version'     => '0.0.3',
    'license'     => 'MIT',
    'author'      => 'Dmitri Smirnov',
    'update_url'  => 'http://www.dmitri.me/misc/frog-plugins.xml',
    'website'     => 'http://www.dmitri.me/'
));

Plugin::addController('minify', 'Minify');

require_once dirname(__FILE__) . '/JSMin.php';
require_once dirname(__FILE__) . '/CSSMin.php';

/**
 *  Main class for minify
 *
 *  @author Dmitri Smirnov
 */
class Minify
{
    /**
     *  @var string
     *  @access private
     */
    private $type;
    
    /**
     *  @var string
     *  @access private
     */
    private $cache;
    
    /**
     *  Factory method
     *
     *  @param string JS|CSS
     *  @return Minify
     */
    public static function factory($type)
    {
        $type = strtoupper($type);
        return new Minify($type);
    }
    
    /**
     *  Constructor
     *  @param string JS|CSS
     */
    public function __construct($type)
    {
        $type = strtoupper($type);
        $this->type = $type;
    }
    
    /**
     *  Loops through array files and minifies them.
     *
     *  @param array Files array
     *  @param boolean Output to file?
     *
     *  @return string
     */
    public function minify($files, $output = false, $fileName = '')
    {
        $globDir = $_SERVER['DOCUMENT_ROOT'] . '/cache/';
        $min = '';
        if( ! $fileName && $this->type == 'CSS') {
            $fileName = 'min.css';
        }
        if( ! $fileName && $this->type == 'JS') {
            $fileName = 'min.js';
        }
        
        foreach( $files as $file) {
            if( ! is_file($file)) {
                throw new MinifyException("File $file - not found");
            }
            $rawString = file_get_contents($file);
            if($this->type == 'JS') {
                $min .= sprintf("\n/*MD5:%s*/\n", md5($rawString));
                $min .= JSMin::minify($rawString);
            } elseif ($this->type == 'CSS') {
               $min .= sprintf("\n/*MD5:%s*/\n", md5($rawString));
               $min .= CSSMin::minify($rawString);
            } else {
               throw new MinifyException('Unknown minify type, use '
                                        .'"CSS" or "JS"');
            }
        }
                
        if( !$output) {
           $retval = $min;
        } else {
          file_put_contents($globDir . $fileName, $min);
          $retval = '/cache/' . $fileName;
        }
        
        return $retval;
    }
    
}
/**
 *  Minify exception
 */
class MinifyException extends Exception {}

    
