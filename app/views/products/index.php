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
            <div class="rtable">
        <?php foreach ($products as $product): ?>
            <div >
                <div class="inline">
                    <img src="<?php echo SITE_ROOT. DS . 'media'. DS . 'catalog' . DS . $product->getThumbnail(); ?>" alt="<?php echo $product->getName(); ?>" height="100" width="100">
                </div>
                <div class="inline">
                    <?php
                    echo "Name: ".$product->getName()."<br>";
                    echo "Description: ".$product->getDescription()."<br>";
                    echo "Price, $: ".$product->getPrice()."<br>";
                    ?>
                </div>
                <div>
                    <span>
                        <input name="qty<?php echo $product->getId(); ?>" type="number" value="1" min="1" max="<?php echo $product->getStockqty(); ?>" />
                        <a class="button" href="<?php echo SITE_ROOT; ?>/products/add/<?php echo $product->getId(); ?>"
                           onclick="return confirm('Are you sure you want?')">Add to Cart</a>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
                </div>
            
            <table class="datagrid box-center">
                <tr>
                    <th>-</th>
                    <th>
                        Sorting: <a href="<?php echo SITE_ROOT; ?>/products/index&sort=name<?php if (isset($queryparams) && $queryparams[0] == 'name' && !isset($queryparams[1])) {
                            echo '.desc" class="asc';
                        } elseif (isset($queryparams) && $queryparams[0] == 'name' && isset($queryparams[1])) {
                            echo '" class="desc';
                        } ?>">Name</a>
                    </th>
                    <th width="50px">-</th>
                    <th width="150px">-</th>
                </tr>

                <?php foreach ($products as $product): ?>

                    <tr>
                        <td> <img src="<?php echo SITE_ROOT. DS . 'media'. DS . 'catalog' . DS . $product->getThumbnail(); ?>" alt="<?php echo $product->getName(); ?>" height="42" width="42"> </td>
                        <td>
                            <?php
                                echo "Name: ".$product->getName()."<br>";
                                echo "Description:".$product->getDescription()."<br>";
                                echo "Price, $: ".$product->getPrice()."<br>";
                            ?>
                        </td>
                        <td><input name="qty<?php echo $product->getId(); ?>" type="number" value="1" min="1" max="<?php echo $product->getStockqty(); ?>" /></td>
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