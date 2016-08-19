<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 17:46
 */
?>
<div id="mainmenu">

<span class="inline">
<nav>
    <ul id="sitemenu">
        <li><a href="<?php echo SITE_ROOT; ?>/">Home</a></li>
        <li><a href="<?php echo SITE_ROOT; ?>/products/index">Product Catalog</a></li>
        <li><a href="<?php echo SITE_ROOT; ?>/users/index">Users</a></li>
    </ul>
</nav>
</span>
    <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_user.inc.php'; ?>
</div>
