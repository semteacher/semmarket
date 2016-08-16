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
        <div>
            <div class="inline"><span><h2><?php echo $pageheader; ?></h2></span></div>
        </div>

        <?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_errorbox.inc.php'; ?>

        <table class="datagrid box-center">
            <thead>
            <th>Image</th>
            <th>Name</th>
            <th width="50px">Price</th>
            <th width="100px">Qty</th>
            <th width="100px">Total</th>
            <th width="150px">-</th>
            </thead>
            <tbody id="tablecartbody">

            </tbody>
        </table>
    </section>

    <script language="JavaScript">
        var shoppingCart = [];
        function deleteCartitem(id)
        {
            console.log(id);
            //get cart items from session
            var cartArrayJSON = sessionStorage.getItem("shoppingCart");
            if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
                shoppingCart = JSON.parse(cartArrayJSON);
                for (var i=0; i < shoppingCart.length; i++) {
                    if (shoppingCart[i].Id == id) {
                        shoppingCart.splice(i, 1);
                        var jsonStr = JSON.stringify(shoppingCart);
                        sessionStorage.setItem("shoppingCart", jsonStr);
                    }
                }
                //redraw table
                displayCart();
                updateCartTotals();
                displayCartTotals();
            }


        }

        deduplicateCart(shoppingCart)
        {

        }

        function displayCart()
        {
            var shoppingCart = [];
            //get and clean table body
            var tableCartBody = document.getElementById("tablecartbody");
            tableCartBody.innerHTML = '';
            //get cart items from session
            var cartArrayJSON = sessionStorage.getItem("shoppingCart");
            if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
                shoppingCart = JSON.parse(cartArrayJSON);
                deduplicateCart(shoppingCart);
                //console.log(shoppingCart);
            }
            //display table rows
            for (var i = 0; i < shoppingCart.length; ++i) {
                var item = shoppingCart[i];
                //console.log(item);
                //need to break-out escaping var mpath = '\\media\\catalog\\';
                var mpath = '<?php echo SITE_ROOT . DS . DS . "media" . DS . DS . "catalog" . DS. DS; ?>';
                var html = '<tr><td><img src="' + mpath + item.Thumb + '" alt="' + item.Name + '" height="50" width="50"></td>';
                html = html + '<td>' + item.Name + '</td>';
                html = html + '<td> $ ' + item.Price + '</td>';
                html = html + '<td><input name="qty"' + item.Id + ' type="number" value="' + item.Qty + '" min="1" max="' + item.Stock + '"/></td>';
                html = html + '<td> $ '+ item.Qty * item.Price +'</td>';
                html = html + '<td><button type="button" class="button" onclick="deleteCartitem(' + item.Id + ')">Delete Item</button></td></tr>';
//console.log(html);
                tableCartBody.innerHTML = tableCartBody.innerHTML + html ;
            }
            //console.log(tableCartBody);
        }
        window.onload = displayCart();
    </script>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>