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
     *  @param string Public path to file where minified data should be strored.
     *         NB! don't forget to give write permissions.
     *
     *  @return string
     */
    public function minify($files, $output = false, $filePath = '')
    {
        $globDir = $_SERVER['DOCUMENT_ROOT'] . "/$filePath";
        $min = '';
        
        foreach( $files as $file) {
            if( ! is_file($file)) {
                throw new MinifyException("File $file - not found");
            }
            $rawString = file_get_contents($file);
            if($this->type == 'JS') {
                $min .= JSMin::minify($rawString);
            } elseif ($this->type == 'CSS') {
               $min .= CSSMin::minify($rawString);
	    } else {
		throw new MinifyException('Unknow minify type use '
		                         . '"CSS" or "JS"');
	    }
        }
        if( !$output) {
            if ($this->type == 'JS') {
                $retval = "<script type=\"text/javascript\">$min</script>\n";
            } else {
               $retval = "<style type=\"text/css\">$min</style>";
            }
        } else {
           /*
               TODO: Find a better way where to save automatically, 
               and try to ingore permission problem.
           */
           if( ! is_file($globDir)) {
               throw new MinifyException("Output file $globDir "
                                        . "does not exists");
           }
           if ( ! is_writable($globDir)) {
               throw new MinifyException("Output file $globDir is not "
                                        . "writable, check persmissions");
           }
           
           file_put_contents($globDir, $min);
           $retval = $filePath;
        }
        return $retval;
    }
    
}
/**
 *  Minify exception
 */
class MinifyException extends Exception {}

    
