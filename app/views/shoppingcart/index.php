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
            <th>Total</th>
            <th width="100px">-</th>
            </thead>
            <tbody id="tablecartbody">

            </tbody>
        </table>
    </section>

    <script language="JavaScript">
        var shoppingCart = [];
        function displayCart() {
            //get cart items from session
            var tableCartBody = document.getElementById("tablecartbody");
            var cartArrayJSON = sessionStorage.getItem("shoppingCart");
            if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
                shoppingCart = JSON.parse(cartArrayJSON);
                console.log(shoppingCart);
            }
            for (var i = 0; i < shoppingCart.length; ++i) {
                var item = shoppingCart[i];
                //console.log(item);
                var html = '<tr><td></td>';
                html = html + '<td>' + item.Name + '</td>';
                console.log(item.Name);
                html = html + '<td> $ ' + item.Price + '</td>';
                html = html + '<td><input name="qty"' + item.Id + ' type="number" value="' + item.Qty + '" min="1" max="999"/></td>';
                html = html + '<td></td>';
                html = html + '<td></td></tr>';
console.log(html);
                tableCartBody.innerHTML = tableCartBody.innerHTML + html ;
            }
            console.log(tableCartBody);
        }
        document.onload = displayCart();
    </script>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>