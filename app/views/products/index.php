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
            <div class="box-center">
                <?php
                foreach ($products as $product):
                    $pdodId = $product->getId();
                    $prodName = $product->getName();
                    $prodDesc = $product->getDescription();
                    $prodStock = $product->getStockqty();
                    $prodPrice = $product->getPrice();
                    $prodThumb = $product->getThumbnail();
                    ?>
                    <div class="floating-box">
                        <div class="alignleft">
                            <img
                                src="<?php echo SITE_ROOT . DS . 'media' . DS . 'catalog' . DS . $prodThumb; ?>"
                                alt="<?php echo $prodName; ?>" height="200" width="200"/>
                        </div>
                        <div class="alignleft">
                            <?php
                            echo "Product: " . $prodName . "<br>";
                            echo "Description: " . $prodDesc . "<br>";
                            echo "Price, $: " . $prodPrice . "<br>";
                            ?>
                        </div>
                        <div class="alignleft">
                            <input class="cartspin" name="qty<?php echo $pdodId; ?>" type="number" value="1"
                                   min="1"
                                   max="<?php echo $prodStock; ?>"/>
                            <button type="button" class="button"
                                    onclick="AddtoCart(<?php echo "'".$pdodId."','".$prodName."','".$prodPrice."'"; ?>)">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <table class="datagrid box-center">
                <tr>
                    <th>-</th>
                    <th>
                        Sorting: <a
                            href="<?php echo SITE_ROOT; ?>/products/index&sort=name<?php if (isset($queryparams) && $queryparams[0] == 'name' && !isset($queryparams[1])) {
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
                        <td><img
                                src="<?php echo SITE_ROOT . DS . 'media' . DS . 'catalog' . DS . $product->getThumbnail(); ?>"
                                alt="<?php echo $product->getName(); ?>" height="50" width="50"></td>
                        <td>
                            <?php
                            echo "Name: " . $product->getName() . "<br>";
                            echo "Description:" . $product->getDescription() . "<br>";
                            echo "Price, $: " . $product->getPrice() . "<br>";
                            ?>
                        </td>
                        <td><input name="qty<?php echo $product->getId(); ?>" type="number" value="1" min="1"
                                   max="<?php echo $product->getStockqty(); ?>"/></td>
                        <td><a class="button"
                               href="<?php echo SITE_ROOT; ?>/products/add/<?php echo $product->getId(); ?>"
                               onclick="AddtoCart('Are you sure you want?')">Add to Cart</a></td>
                    </tr>

                <?php endforeach; ?>

            </table>

        <?php else: ?>

            <div><span><h3>Welcome!</h3></span></div>
            <p>We currently do not have any product.</p>

        <?php endif; ?>

    </section>

    <script language="JavaScript">
        var shoppingCart = [];
        //get qty from page by control name
        function getCartQty(id){
            var qty = 0;
            qty = parseInt(document.getElementsByName("qty"+id)[0].value);
            return qty;
        }
        //add product to cart
        function AddtoCart(id, name, price) {
            //get cart items from session
            var cartArrayJSON = sessionStorage.getItem("shoppingCart");
            //console.log(cartArrayJSON);
            if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
                shoppingCart.push(JSON.parse(cartArrayJSON));
            }
            //create JavaScript Object that will hold product properties
            var singleProduct = {};
            //Fill the product object with data
            singleProduct.Id = id;
            singleProduct.Name = name;
            singleProduct.Price = price;
            singleProduct.Qty = getCartQty(id);
            //Add newly created product to shopping cart
            shoppingCart.push(singleProduct);
            //update cart stored in session
            var jsonStr = JSON.stringify(shoppingCart);
            sessionStorage.setItem("shoppingCart", jsonStr);

            //get cart totlas info
            var cartArrayJSON = sessionStorage.getItem("shoppingCartTotals");
            console.log(cartArrayJSON);
            if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
                var shoppingCartTotals = JSON.parse(cartArrayJSON);
                shoppingCartTotals.totalQty = shoppingCartTotals.totalQty + singleProduct.Qty;
                shoppingCartTotals.totalFee = shoppingCartTotals.totalFee + (singleProduct.Qty*singleProduct.Price);
            } else {
                var shoppingCartTotals = {};
                shoppingCartTotals.totalQty = singleProduct.Qty;
                shoppingCartTotals.totalFee = singleProduct.Qty*singleProduct.Price;
            }
            //update cart totals
            jsonStr = JSON.stringify(shoppingCartTotals);
            sessionStorage.setItem("shoppingCartTotals", jsonStr);
            console.log(shoppingCartTotals);
        }

    </script>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>