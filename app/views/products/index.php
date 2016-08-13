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
            <div class="inline"><span><h2><?php echo $pageheader; ?></h2></span></div>
        </div>

        <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

        <?php if ($products): ?>

            <table class="datagrid box-center">
                <tr>
                    <th>-</th>
                    <th>
                        <a href="<?php echo SITE_ROOT; ?>/products/index&sort=fname<?php if (isset($queryparams) && $queryparams[0] == 'name' && !isset($queryparams[1])) {
                            echo '.desc" class="asc';
                        } elseif (isset($queryparams) && $queryparams[0] == 'name' && isset($queryparams[1])) {
                            echo '" class="desc';
                        } ?>">First Name</a>
                    </th>
                    <th>-</th>
                    <th>-</th>
                </tr>

                <?php foreach ($products as $product): ?>

                    <tr>
                        <td><?php echo $product->getThumbail(); ?></td>
                        <td>
                            <?php
                                echo "Product Id: ".$product->getId()."<br>";
                                echo "Product Name: ".$product->getName()."<br>";
                                echo "Description:".$product->getDescription()."<br>";
                                echo "Price: ".$product->getPrice()."<br>";
                            ?>
                        </td>
                        <td>--input--</td>
                        <td><a class="button" href="<?php echo SITE_ROOT; ?>/products/add/<?php echo $product->getId(); ?>"
                               onclick="return confirm('Are you sure you want?')">Add to Cart</a></td>
                    </tr>

                <?php endforeach; ?>

            </table>

        <?php else: ?>

            <div><span><h3>Welcome!</h3></span></div>
            <p>We currently do not have any product.</p>

        <?php endif; ?>

    </section>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>