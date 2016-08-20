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
                    $prodRatingAvg = $product->getRatingAvg();
                    $prodRatingCnt = $product->getRatingCnt();
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
                            echo "Average Rating: " . $prodRatingAvg . " ( ". $prodRatingCnt ." votes)";
                            ?>
                        </div>
                        <div class="alignleft">
                            <input class="cartspin" id="qty<?php echo $pdodId; ?>" type="number" value="1"
                                   min="1" max="<?php echo $prodStock; ?>"/>
                            <button type="button" class="button"
                                    onclick="AddtoCart(<?php echo "'" . $pdodId . "','" . $prodName . "','" . $prodPrice . "','" . $prodStock . "','" . $prodThumb . "'" ?>);">
                                Add to Cart
                            </button>
                        </div>
                        <div class="alignleft">
                            <span>1<input class="ratingrange" id="prodrate<?php echo $pdodId; ?>" type="range" name="points" min="1" max="5">5</span>
                            <button type="button" class="button"
                                    onclick="RateProduct(<?php echo $pdodId; ?>);">
                                    Rate Product                            
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
            
            <form id="prodrating" action="<?php echo SITE_ROOT; ?>/products/saverating/" method="get" name="prodratingform">
                <input type="hidden" value="" id="prodrateid" name="prodrateid">
                <input type="hidden" value="" id="prodrateval" name="prodrateval">
            </form> 
        <?php else: ?>

            <div><span><h3>Welcome!</h3></span></div>
            <p>We currently do not have any product.</p>

        <?php endif; ?>

    </section>

    <script language="JavaScript">
        //add product to cart
        function AddtoCart(id, name, price, stock, thumb) 
        {
            //get current qty
            var itemQty = getCartQty(id);
            if (itemQty > 0) 
            {
                //get cart items from session
                var shoppingCart = getShoppingCart();
                //create JavaScript Object that will hold product properties and fill data
                var singleProduct = {};
                singleProduct.Id = id;
                singleProduct.Name = name;
                singleProduct.Price = price;
                singleProduct.Qty = itemQty;
                singleProduct.Stock = stock;
                singleProduct.Thumb = thumb;
                //Add newly created product to shopping cart
                shoppingCart.push(singleProduct);
                //update cart stored in session, update totals and re-display
                setShoppingCart(shoppingCart);
                updateCartTotals();
                displayMenuCartTotals();
            }
        }
        function RateProduct(id) 
        {
            var rating = parseInt(document.getElementById("prodrate" + id).value);
            document.getElementById("prodrateid").value = id;
            document.getElementById("prodrateval").value = rating;
            document.getElementById("prodrating").submit();
        }
    </script>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>