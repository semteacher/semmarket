/**
 * Created by SemenetsA on 15.08.2016.
 */
function fixround(value, decimals)
{
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}

function initCartTotals()
{
    //init shoppingCartTotals obj
    var shoppingCartTotals = {};
    shoppingCartTotals.totalQty = 0;
    shoppingCartTotals.totalFee = 0;
    return shoppingCartTotals;
}

function displayCartTotals()
{
    var shoppingCartTotals = initCartTotals();
    //get cart totlas info
    cartArrayJSON = sessionStorage.getItem("shoppingCartTotals");
    if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined")
    {
        var shoppingCartTotals = JSON.parse(cartArrayJSON);
    }
    document.getElementById("cartmenulink").innerHTML = "In Cart: "+ shoppingCartTotals.totalQty + " ($"+ shoppingCartTotals.totalFee +")";
}

function updateCartTotals()
{
    var shoppingCartTotals = initCartTotals();
    //get shoppingcart items
    var cartArrayJSON = sessionStorage.getItem("shoppingCart");
    if (cartArrayJSON !== null && typeof cartArrayJSON !== "undefined")
    {
        shoppingCart = JSON.parse(cartArrayJSON);
        for (var i=0; i < shoppingCart.length; i++)
        {
            shoppingCartTotals.totalQty = shoppingCartTotals.totalQty + shoppingCart[i].Qty;
            shoppingCartTotals.totalFee = fixround(shoppingCartTotals.totalFee + (shoppingCart[i].Qty*shoppingCart[i].Price),2);
        }
    }
    //update cart totals
    var jsonStr = JSON.stringify(shoppingCartTotals);
    sessionStorage.setItem("shoppingCartTotals", jsonStr);
}