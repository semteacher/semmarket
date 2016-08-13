<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <section id="content">
        <div><h2><?php echo $pageheader; ?></h2></div>

        <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

        <form action="<?php echo SITE_ROOT; ?>/albums/sharereport" method="post" name="sharereport">
            <input type="hidden" value="<?php echo $albumId; ?>" name="albumId">

            <?php if (!empty($emailstoadd)): ?>
                <?php foreach ($emailstoadd as $email): ?>

                    <div><input type="checkbox" name="selectedemailstoadd[]" value="<?php echo $email; ?>"><?php echo $email; ?></div>

                <?php endforeach; ?>

                <div><input class="button" type="submit" name="sharereportaddcontacts" value="Add to Contact Manager"></div>

            <?php endif; ?>

                <div><input class="button" type="submit" name="sharereportgotoindex" value="Go to My Album/Events"></div>

        </form>

    </section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>