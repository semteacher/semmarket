<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 4.07.2015
 * Time: 10:35
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <section id="content">
        <div>
            <span><h2><?php echo $pageheader; ?></h2></span>
        </div>

        <form action="<?php echo SITE_ROOT; ?>/users/save" method="post" name="adduser">
            <input type="hidden" value="<?php echo $mode; ?>" name="mode">
            <input type="hidden" value="<?php if (isset($user))
            {
                echo $user['id_user'];
            } ?>" name="id_user">
            <div><label class="fixedlabel" for="username">Username: </label><input type="text"
                                                                                   value="<?php if (isset($user))
                                                                                   {
                                                                                       echo $user['username'];
                                                                                   } ?>" name="username" required></div>
            <div><label class="fixedlabel" for="password">Password: </label><input type="password" value=""
                                                                                   name="password" required></div>
            <div><label class="fixedlabel" for="confirmpassword">Password (confirm): </label><input type="password"
                                                                                                    value=""
                                                                                                    name="confirmpassword"
                                                                                                    required></div>
            <div><label class="fixedlabel" for="role">Role: </label><input type="text" value="<?php if (isset($user))
                {
                    echo $user['role'];
                } ?>" name="role"></div>
            <div class="labelbtn">
                <input class="button" type="submit" name="addusersubmit" value="save">
                <input class="button" type="button"
                       onclick="window.location.replace('<?php echo SITE_ROOT; ?>/users/index')" value="cancel"/>
            </div>
        </form>
    </section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>