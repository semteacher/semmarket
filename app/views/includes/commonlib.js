/**
 * Created by SemenetsA on 15.08.2016.
 */
function fixround(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

function getShoppingCart() {
    var shoppingCart = [];
    var cartArrayJSON = sessionStorage.getItem("shoppingCart");
    if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
        shoppingCart = JSON.parse(cartArrayJSON);
    }
    return shoppingCart;
}

function setShoppingCart(shoppingCart) {
    var jsonStr = JSON.stringify(shoppingCart);
    sessionStorage.setItem("shoppingCart", jsonStr);
}

function deduplicateCart() {
    var shoppingCart = getShoppingCart();
    for (var i = 0; i < shoppingCart.length; i++) {
        for (var j = i + 1; j < shoppingCart.length; j++) {
            //detect duplicates, summ Qty  and remove second instance
            if (shoppingCart[i].Id == shoppingCart[j].Id) {
                shoppingCart[i].Qty = shoppingCart[i].Qty + shoppingCart[j].Qty;
                shoppingCart.splice(j, 1);
            }
        }
    }
    setShoppingCart(shoppingCart);
}

//get qty from page by control id
function getCartQty(id) {
    var qty = 0;
    qty = parseInt(document.getElementById("qty" + id).value);
    return qty;
}

function initCartTotals() {
    //init shoppingCartTotals obj
    var shoppingCartTotals = {};
    shoppingCartTotals.totalQty = 0;
    shoppingCartTotals.totalFee = 0;
    return shoppingCartTotals;
}

function getShoppingCartTotals() {
    var shoppingCartTotals = initCartTotals();
    //get cart totlas info
    cartArrayJSON = sessionStorage.getItem("shoppingCartTotals");
    if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined") {
        shoppingCartTotals = JSON.parse(cartArrayJSON);
    }
    return shoppingCartTotals;
}

function displayMenuCartTotals() {
    var shoppingCartTotals = getShoppingCartTotals();
    document.getElementById("cartmenulink").innerHTML = "In Cart: " + shoppingCartTotals.totalQty + " ($" + shoppingCartTotals.totalFee + ")";
}

function displayTableFooterCartTotals() {
    var shoppingCartTotals = getShoppingCartTotals();
    document.getElementById("ftotalqty").innerHTML = shoppingCartTotals.totalQty;
    document.getElementById("ftotalfee").innerHTML = "$ " + shoppingCartTotals.totalFee;
}

function updateCartTotals() {
    var shoppingCartTotals = initCartTotals();
    var shoppingCart = getShoppingCart();
    for (var i = 0; i < shoppingCart.length; i++) {
        shoppingCartTotals.totalQty = shoppingCartTotals.totalQty + shoppingCart[i].Qty;
        shoppingCartTotals.totalFee = fixround(shoppingCartTotals.totalFee + (shoppingCart[i].Qty * shoppingCart[i].Price), 2);
    }
    //update cart totals
    var jsonStr = JSON.stringify(shoppingCartTotals);
    sessionStorage.setItem("shoppingCartTotals", jsonStr);
}