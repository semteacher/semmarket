<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 17.08.2016
 * Time: 20:00
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

<section id="content">
    <div class="inline">
        <div>
            <div class="inline"><span><h2><?php echo $pageheader; ?></h2></span></div>
        </div>

        <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>
    </div>
    <div><?php if(!empty($success)){ echo $success; } ?></div>
</section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>