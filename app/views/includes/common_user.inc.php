<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 10:46
 */
?>
<span class="inline alignright">
<nav>
    <ul id="usermenu">
    <li><a id="cartmenulink" href="<?php echo SITE_ROOT; ?>/shoppingcart/index">My Cart</a></li>
<?php 
if(isset($_SESSION['loggeduser'])){
?>
        <li><span><strong>
<?php
    echo 'User: '.$_SESSION['loggeduser']['userName'];
    if(isset($_SESSION['loggeduser']['userRole'])){
        echo ' ('.$_SESSION['loggeduser']['userRole'].')';
    }    
?>
        </strong></span></li>
        <li><a href="<?php echo SITE_ROOT; ?>/site/logout">Logout</a></li>
<?php    
} else {
?>
        <li><a href="<?php echo SITE_ROOT; ?>/site/login">Login</a></li>
<?php 
} 
?>
    </ul>
</nav>    
</span>