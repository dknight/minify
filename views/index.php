<h1>Minify settings</h1>
<br /><br />


<?php if( ! is_dir(FROG_ROOT . '/cache/')) : ?>
<div id="error">
  Error: /cache/ directory does not exists. Create 'cache' directory in your docuement root.
</div>
<?php elseif( ! is_writable(FROG_ROOT . '/cache/')) : ?>
<div id="error">
  Error: /cache/ directory is not writtable. Be sure that /cache/ directory have written permission.
  <br /><br />
  <?php if( isset($failed) ) echo __($failed) . "<br />"; ?>
  <form method="post" action="<?php echo get_url('plugin/minify/addCacheDir') ?>">
    <input type="submit" value="Try to create /cache/ directory" />
  </form>
</div>
<?php else : ?>
<div id="success">Success! /cache/ directory is writtable.</div>
<?php endif; ?>