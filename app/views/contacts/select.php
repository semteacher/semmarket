<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.07.2015
 * Time: 17:55
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <script type="text/javascript">
        function selectAll(source) {
            checkboxes = document.getElementsByName('selctedcontacts[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>

    <section id="content">
        <form action="<?php echo $ref_url; ?>" method="post" name="selectcontacts">

            <input type="hidden" value="<?php if(isset($ref_url)){echo $ref_url;} ?>" name="ref_url">

            <div>
                <div class="inline">
                    <input class="button" type="submit" name="selectcontacts" value="Accept">
                    <input class="button" type="button"
                           onclick="window.location.replace('<?php echo $ref_url; ?>')" value="Cancel">
                </div>
                <div class="inline"><span><h2><?php echo $pageheader; ?></h2></span></div>
            </div>

            <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

            <?php if ($contacts): ?>

                <table class="datagrid box-center">
                    <tr>
                        <th><input type="checkbox" onClick="selectAll(this)"/>All</th>
                        <th>
                            <a href="<?php echo SITE_ROOT; ?>/contacts/select&sort=fname<?php if (isset($queryparams) && $queryparams[0] == 'fname' && !isset($queryparams[1])) {
                                echo '.desc" class="asc';
                            } elseif (isset($queryparams) && $queryparams[0] == 'fname' && isset($queryparams[1])) {
                                echo '" class="desc';
                            } ?>">First Name</a></th>
                        <th>
                            <a href="<?php echo SITE_ROOT; ?>/contacts/select&sort=lname<?php if (isset($queryparams) && $queryparams[0] == 'lname' && !isset($queryparams[1])) {
                                echo '.desc" class="asc';
                            } elseif (isset($queryparams) && $queryparams[0] == 'lname' && isset($queryparams[1])) {
                                echo '" class="desc';
                            } ?>">Last Name</a></th>
                        <th>
                            <a href="<?php echo SITE_ROOT; ?>/contacts/select&sort=email<?php if (isset($queryparams) && $queryparams[0] == 'email' && !isset($queryparams[1])) {
                                echo '.desc" class="asc';
                            } elseif (isset($queryparams) && $queryparams[0] == 'email' && isset($queryparams[1])) {
                                echo '" class="desc';
                            } ?>">E-mail</a></th>
                        <th>Best phone</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Zip</th>
                        <th>Birthday</th>
                    </tr>

                    <?php foreach ($contacts as $contact): ?>

                        <tr>
                            <td><input type="checkbox" name="selctedcontacts[]"
                                       value="<?php echo $contact->getEmail(); ?>"></td>
                            <td><?php echo $contact->getFirstName(); ?></td>
                            <td><?php echo $contact->getLastName(); ?></td>
                            <td><?php echo $contact->getEmail(); ?></td>
                            <td><?php echo $contact->getPhoneBestPhone(); ?></td>
                            <td><?php echo $contact->getAddress1(); ?></td>
                            <td><?php echo $contact->getAddress2(); ?></td>
                            <td><?php echo $contact->getCity(); ?></td>
                            <td><?php echo $contact->getState(); ?></td>
                            <td><?php echo $contact->getCountry(); ?></td>
                            <td><?php echo $contact->getZip(); ?></td>
                            <td><?php echo $contact->getBirthday(); ?></td>
                        </tr>

                    <?php endforeach; ?>

                </table>

            <?php else: ?>

                <div><span><h3>Welcome!</h3></span></div>
                <p>We currently do not have any contact.</p>

            <?php endif; ?>

            <div>
                <input class="button" type="submit" name="selectcontacts" value="Accept">
                <input class="button" type="button"
                       onclick="window.location.replace('<?php echo $ref_url; ?>')" value="Cancel">
            </div>
        </form>
    </section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>