<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 10:35
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

<section id="content">
<div>
    <span><h2><?php echo $pageheader; ?></h2></span>
</div>
<div class="errbox"><?php if(isset($loginerr)){echo $loginerr;} ?></div>
<form action="<?php echo SITE_ROOT; ?>/site/login" method="post" name="loginuser">
    <div><label for="username">Username:</label><input type="text" value="" name="username" required></div>
    <div><label for="username">Password:</label><input type="password" value="" name="password" required></div>
    <div class="labelbtn divpadd">
        <input class="button" type="submit" name="loginusersubmit" value="login">
        <input class="button" type="button" onclick="window.location.replace('<?php echo SITE_ROOT; ?>/site/index')" value="cancel" />
    </div>
</form>
</section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>