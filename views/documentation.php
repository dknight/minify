<h1>About</h1>

<p>
  'Minify' is a plugin to minify JavaScript and/or CSS code and combine it 
  into one file on the fly. This will increase performance of website.<br />
  So you don't need to do dozens HTTP request for every JavaScript or CSS file. Minify plugin is more
  useful and faster with <a href="http://www.appelsiini.net/projects/funky_cache">Funky cache</a>
  plugin.<br />
  <a href="http://www.dmitri.me/blog/plugin-minify-for-frog-cmsplugin-minify-for-frog-cms/">Project homepage</a>.
</p>

<h1>Usage</h1>

Install the minify plugin to your Frog CMS plugins directory:

<code>
<pre>
$cd /path/to/frog/plugins/
$git clone git://github.com/dknight/minify.git
</pre>
</code>

<h3>Activate minify plugin</h3>
<img src="http://www.dmitri.me/misc/minify.png" alt="" />
<h3>Set the settings in the</h3>
<p>
So next step you need to create 'cache' directory in your document root and make it
writable. Due to security settings most webservers doesn't allow you to create 
directories dynamically, so you need to create it manually. Create it in your DOCUMENT_ROOT/cache/
and set writtable permissions.
</p>
<code>
<pre>
$mkdir /website/root/cache/
$chmod 0666 /website/root/cache/
</pre>
</code>
<p>
Status:
<?php
$cacheDir =  $_SERVER['DOCUMENT_ROOT'] . '/cache/';
if( !is_dir($cacheDir)) {
    $color = 'red';
    $text  = '/cache/ dir does not exists';
} elseif( !is_writable($cacheDir) && is_dir($cacheDir)) {
   $color = 'orange';
   $text  = '/cache/ directory exists but not writable';
} else {
   $color = 'green';
   $text  = '/cache/ directory exist and ready to use';
}
echo "<span style='color:$color;font-weight:bold;'>$text!</span>";
?>
</p>
<h3>Usage in Frog CMS</h3>

<code>
<pre>
&lt;?php
$jsFiles = array(
    '/public/javascripts/jquery-1.3.2.min.js',
    '/public/javascripts/jquery.validate.min.js',
    '/public/javascripts/jquery.form.js',
    '/public/javascripts/frog.js'
);
$cssFiles = array(
    'path/to/master.css',
    'path/to/subpage.css',
    'path/to/ie-fix.css'
);

$js_minify  = Minify::factory('js');
$css_minify = Minify::factory('css');
?&gt;
</pre>
</code>
HTML:
<code>
<pre>
...
&lt;link href="&lt;?php echo $css_minify->minify($cssFiles, true); ?&gt;" rel="stylesheet" type="text/css" /&gt;
...
&lt;script type="text/javascript" src="&lt;?php echo $js_minify->minify($files, true); ?&gt;">&lt;/script&gt;
...
</pre>
</code>

<p>
    The 'minify' method can pass 3 parameters:
</p>
<table border="1">
  <tr>
    <th>name</th>
    <th>description</th>
    <th>type</th>
    <th>default</th>
  </tr>
  <tr>
    <td>files</td>
    <td>File to be minified</td>
    <td>array [required]</td>
    <td>array()</td>
  </tr>
  <tr>
    <td>output</td>
    <td>Output to file or raw output into string</td>
    <td>boolean [optinal]</td>
    <td>false</td>
  </tr>
  <tr>
    <td>fileName</td>
    <td>Name of output file</td>
    <td>string [optinal]</td>
    <td>'min.js' or 'min.css'</td>
  </tr>
</table>