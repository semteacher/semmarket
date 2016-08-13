<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <section id="content">
        <div><h2><?php echo $pageheader; ?></h2></div>

        <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

        <form action="<?php echo SITE_ROOT; ?>/albums/sharereport" method="post" name="sharealbum">
            <input type="hidden" value="<?php if(isset($album['albumId'])){echo $album['albumId'];} ?>" name="album[albumId]">
            <div>
                <label for="album[sharetitle]">Album Sharing Title: </label>
                <input type="text" value="<?php if(isset($album['sharetitle'])){echo $album['sharetitle'];} ?>" name="album[sharetitle]" autofocus required>
            </div>
            <div>
                <label for="album[shareemails]">Share Album with (Enter emails): </label>
                <input type="email" value="<?php if(isset($album['shareemails'])){echo $album['shareemails'];} ?>" name="album[shareemails]" required multiple placeholder="A Valid Email Address">
                <a class="button" href="<?php echo SITE_ROOT; ?>/albums/selectcontacts">Use Contact Manager to select</a>
            </div>
            <div>
                <label for="album[sharemessage]">Album Sharing Message: </label>
                <textarea name="album[sharemessage]" cols="50" rows="5" required><?php if(isset($album['sharemessage'])){echo $album['sharemessage'];} ?></textarea>
            </div>
            <div  class="labelbtn">
                <input class="button" type="submit" name="sharealbumsubmit" value="Share">
                <input class="button" type="button" onclick="window.location.replace('<?php echo SITE_ROOT; ?>/site/index')" value="Cancel">
            </div>
        </form>

    </section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>