<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 4.07.2015
 * Time: 17:55
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

<section id="content">
<div><span><a class="button" href="<?php echo SITE_ROOT; ?>/users/add">Add User</a></span></div>
<div><span><h2><?php echo $pageheader; ?></h2></span></div>

</p>
    <div>
        <span>User ID</span><span>UserName</span><span>Role</span>
    </div>

<?php if ($users): foreach ($users as $user):  ?>

    <div>
        <span><?php echo $user->getIdUser(); ?></span>
        <span><?php echo $user->getUserName(); ?></span>
        <span><?php echo $user->getRole(); ?></span>
        <span><a href="<?php echo SITE_ROOT; ?>/users/edit/<?php echo $user->getIdUser(); ?>">Edit/View</a></span>
        <span><a href="<?php echo SITE_ROOT; ?>/users/changepassword/<?php echo $user->getIdUser(); ?>">Change Password</a></span>
        <span><a href="<?php echo SITE_ROOT; ?>/users/del/<?php echo $user->getIdUser(); ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></span>
    </div>

<?php
endforeach;
else: ?>

<h1>Welcome!</h1>
<p>We currently do not have any users.</p>

<?php endif; ?>

<div><span><a class="button" href="<?php echo SITE_ROOT; ?>/users/add">Add User</a></span></div>
</section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>