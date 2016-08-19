<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 15.08.2016
 * Time: 12:04
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

        <form class="alignright" action="<?php echo SITE_ROOT; ?>/shoppingcart/saveorder" method="post"
              id="cartcheckoutform" name="cartcheckout">
            <input type="hidden" value="<?php if (isset($order['orderId']))
            {
                echo $order['orderId'];
            } ?>" id="order[orderId]" name="order[orderId]">
            <input type="hidden" value="<?php if (isset($order['ordergrandtotal']))
            {
                echo $order['ordergrandtotal'];
            } ?>" id="order[ordergrandtotal]" name="order[ordergrandtotal]">
            <input type="hidden" value="<?php if (isset($order['orderdetails']))
            {
                echo $order['orderdetails'];
            } ?>" id="order[orderdetails]" name="order[orderdetails]">
            <div id="billtitlebox" class="text-center">
                <?php echo $billtitle; ?>
            </div>
            <div id="balance">
                <?php echo $balancetitle . $userbalance; ?>
            </div>
            <div>
                <label for="order[deliverymethod]">How to Delivery: </label>
                <select name="order[deliverymethod]" id="deliverymethod" onchange="updateBill()">
                    <option value="-1" selected>--Please, choose an option:--</option>
                    <?php foreach ($deliveryOptions as $optName => $optCost): ?>
                        <option
                            value="<?php echo $optName; ?>"><?php echo $optName . " ( $ " . $optCost . " )"; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <hr>
            <div>
                Grand Total: $ <span id="grandtotal"></span> <span class="alignright">Rest: $ <span
                        id="rest"></span></span>
            </div>
            <hr>
            <div class="text-center">
                <input type="button" class="button" name="ordersubmit" onclick="orderSubmit()"
                       value="Check-out and Pay now!">
            </div>
        </form>


        <table class="datagrid box-center" met>
            <thead>
            <th width="60px">Image</th>
            <th>Name</th>
            <th width="80px">Price</th>
            <th width="80px">Qty</th>
            <th width="120px">Sub Total</th>
            <th width="120px">-</th>
            </thead>
            <tfoot>
            <tr>
                <td colspan="3">Total:</td>
                <td id="ftotalqty" class="text-center">$180</td>
                <td id="ftotalfee" class="text-center">$180</td>
                <td></td>
            </tr>
            </tfoot>
            <tbody id="tablecartbody">

            </tbody>
        </table>
    </section>

    <script language="JavaScript">
        //check that delivery was chosen and submit order form
        function orderSubmit() {
            var delivetySel = document.getElementById("deliverymethod");
            var deliveryOpt = delivetySel.options[delivetySel.selectedIndex].value;
            console.log(deliveryOpt);
            if (deliveryOpt != '-1') {
                var shoppingCart = getShoppingCart();
                document.getElementById("order[orderdetails]").value = JSON.stringify(shoppingCart);
                document.getElementById("order[ordergrandtotal]").value = document.getElementById("grandtotal").innerHTML;
                //clean current local shopping data and submit form
                shoppingCart = [];
                setShoppingCart(shoppingCart);
                initCartTotals();
                updateCartTotals();
                document.getElementById("cartcheckoutform").submit();
            }
            else {
                alert("Delivery optin did not selected!");
            }
        }

        //update grand total and rest on delivery choice
        function updateBill() {
            //get delivery options object from PHP
            var deliveryOptObj = JSON.parse('<?php echo json_encode($deliveryOptions); ?>');
            //get selected delivery option
            var delivetySel = document.getElementById("deliverymethod");
            var deliveryOpt = delivetySel.options[delivetySel.selectedIndex].value;
            //get finance data
            var userBalance = '<?php echo $userbalance; ?>';
            var shoppingCartTotals = getShoppingCartTotals();
            var grandTotal = shoppingCartTotals.totalFee;
            //calculate an display grandtotal
            if (deliveryOpt != '-1') {
                grandTotal = grandTotal + parseFloat(deliveryOptObj[deliveryOpt]);
            }
            document.getElementById("grandtotal").innerHTML = fixround(grandTotal, 2);
            document.getElementById("rest").innerHTML = fixround(userBalance - grandTotal, 2);
        }

        //delete items by id from cart
        function deleteCartItem(id) {
            //get cart items from session
            var shoppingCart = getShoppingCart();
            for (var i = 0; i < shoppingCart.length; i++) {
                if (shoppingCart[i].Id == id) {
                    shoppingCart.splice(i, 1);
                    setShoppingCart(shoppingCart);
                    break;
                }
            }
            //redraw table
            updateCartTotals();
            updateBill();
            displayCart();
            displayMenuCartTotals();
        }

        //fired when any cart item qty is changed
        function updateCartItemQty(id) {
            //get current qty
            var newQty = getCartQty(id);
            if (newQty > 0) {
                //get cart items from session
                var shoppingCart = getShoppingCart();
                for (var i = 0; i < shoppingCart.length; i++) {
                    if (shoppingCart[i].Id == id) {
                        shoppingCart[i].Qty = newQty;
                        document.getElementById("stotal" + id).innerHTML = "$ " + fixround(shoppingCart[i].Qty * shoppingCart[i].Price, 2);
                        setShoppingCart(shoppingCart);
                        break;
                    }
                }
                //redraw table
                updateCartTotals();
                updateBill();
                displayMenuCartTotals();
                displayTableFooterCartTotals();
            }
        }

        //re-display cart content as table
        function displayCart() {
            //get and clean table body
            var tableCartBody = document.getElementById("tablecartbody");
            tableCartBody.innerHTML = '';
            //get cart items from session
            var shoppingCart = getShoppingCart();
            //display table rows
            for (var i = 0; i < shoppingCart.length; ++i) {
                var item = shoppingCart[i];
                //console.log(item);
                //need to break-out escaping var mpath = '\\media\\catalog\\';
                var mpath = '<?php echo SITE_ROOT . DS . DS . "media" . DS . DS . "catalog" . DS . DS; ?>';
                //var mpath = '<?php echo SITE_ROOT . DS . "media" . DS . "catalog" . DS; ?>';//for zzz hosting!!
                var html = '<tr><td><img src="' + mpath + item.Thumb + '" alt="' + item.Name + '" height="50" width="50"></td>';
                html = html + '<td>' + item.Name + '</td>';
                html = html + '<td class="text-center"> $ ' + item.Price + '</tdclass>';
                html = html + '<td><input id="qty' + item.Id + '" type="number" class="cartspin" value="' + item.Qty +
                    '" min="1" max="' + item.Stock + '" oninput="updateCartItemQty(' + item.Id + ')"/></td>';
                html = html + '<td id="stotal' + item.Id + '" class="text-center"> $ ' + fixround(item.Qty * item.Price, 2) + '</td>';
                html = html + '<td><button type="button" class="button" onclick="deleteCartItem(' + item.Id + ')">Delete Item</button></td></tr>';
                tableCartBody.innerHTML = tableCartBody.innerHTML + html;
            }
            displayTableFooterCartTotals();
        }
        //page default actions
        window.onload = deduplicateCart();
        window.onload = displayCart();
        window.onload = updateBill();
    </script>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>