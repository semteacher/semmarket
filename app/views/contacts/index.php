<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 17:55
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <section id="content">
        <div>
            <div class="inline"><span><a class="button" href="<?php echo SITE_ROOT; ?>/contacts/edit">Add</a></span>
            </div>
            <div class="inline"><span><h2><?php echo $pageheader; ?></h2></span></div>
        </div>

        <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

        <?php if ($contacts): ?>

            <table class="datagrid box-center">
                <tr>
                    <th>
                        <a href="<?php echo SITE_ROOT; ?>/contacts/index&sort=fname<?php if (isset($queryparams) && $queryparams[0] == 'fname' && !isset($queryparams[1])) {
                            echo '.desc" class="asc';
                        } elseif (isset($queryparams) && $queryparams[0] == 'fname' && isset($queryparams[1])) {
                            echo '" class="desc';
                        } ?>">First Name</a></th>
                    <th>
                        <a href="<?php echo SITE_ROOT; ?>/contacts/index&sort=lname<?php if (isset($queryparams) && $queryparams[0] == 'lname' && !isset($queryparams[1])) {
                            echo '.desc" class="asc';
                        } elseif (isset($queryparams) && $queryparams[0] == 'lname' && isset($queryparams[1])) {
                            echo '" class="desc';
                        } ?>">Last Name</a></th>
                    <th>
                        <a href="<?php echo SITE_ROOT; ?>/contacts/index&sort=email<?php if (isset($queryparams) && $queryparams[0] == 'email' && !isset($queryparams[1])) {
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
                    <th></th>
                    <th></th>
                </tr>

                <?php foreach ($contacts as $contact): ?>

                    <tr>
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
                        <td><a class="button" href="<?php echo SITE_ROOT; ?>/contacts/edit/<?php echo $contact->getIdContact(); ?>">Edit/View</a>
                        </td>
                        <td><a class="button" href="<?php echo SITE_ROOT; ?>/contacts/del/<?php echo $contact->getIdContact(); ?>"
                               onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                    </tr>

                <?php endforeach; ?>

            </table>

        <?php else: ?>

            <div><span><h3>Welcome!</h3></span></div>
            <p>We currently do not have any contact.</p>

        <?php endif; ?>

        <div class="divpadd" ><span><a class="button" href="<?php echo SITE_ROOT; ?>/contacts/edit">Add</a></span></div>
    </section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>