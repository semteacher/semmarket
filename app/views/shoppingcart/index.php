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
            <th width="60px">Image</th>
            <th>Name</th>
            <th width="80px">Price</th>
            <th width="80px">Qty</th>
            <th width="120px">Sub Total</th>
            <th width="120px">-</th>
            </thead>
            <tfoot>
            <tr>
                <td colspan="3">Total</td>
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
        var shoppingCart = [];

        function deleteCartitem(id)
        {
            //get cart items from session
            var cartArrayJSON = sessionStorage.getItem("shoppingCart");
            if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined")
            {
                shoppingCart = JSON.parse(cartArrayJSON);
                for (var i=0; i < shoppingCart.length; i++)
                {
                    if (shoppingCart[i].Id == id) {
                        shoppingCart.splice(i, 1);
                        var jsonStr = JSON.stringify(shoppingCart);
                        sessionStorage.setItem("shoppingCart", jsonStr);
                    }
                }
                //redraw table
                updateCartTotals();
                displayCart();
                displayMenuCartTotals();
            }
        }



        function displayCart()
        {
            //get and clean table body
            var tableCartBody = document.getElementById("tablecartbody");
            tableCartBody.innerHTML = '';
            //get cart items from session
            var shoppingCart = getShoppingCart();
            //display table rows
            for (var i = 0; i < shoppingCart.length; ++i)
            {
                var item = shoppingCart[i];
                //console.log(item);
                //need to break-out escaping var mpath = '\\media\\catalog\\';
                var mpath = '<?php echo SITE_ROOT . DS . DS . "media" . DS . DS . "catalog" . DS. DS; ?>';
                var html = '<tr><td><img src="' + mpath + item.Thumb + '" alt="' + item.Name + '" height="50" width="50"></td>';
                html = html + '<td>' + item.Name + '</td>';
                html = html + '<td class="text-center"> $ ' + item.Price + '</tdclass>';
                html = html + '<td><input name="qty"' + item.Id + ' type="number" class="cartspin" value="' + item.Qty + '" min="1" max="' + item.Stock + '"/></td>';
                html = html + '<td class="text-center"> $ '+ fixround(item.Qty * item.Price, 2) +'</td>';
                html = html + '<td><button type="button" class="button" onclick="deleteCartitem(' + item.Id + ')">Delete Item</button></td></tr>';
                tableCartBody.innerHTML = tableCartBody.innerHTML + html ;
            }
            displayTableFooterCartTotals();
        }
        window.onload = deduplicateCart();
        window.onload = displayCart();
    </script>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>