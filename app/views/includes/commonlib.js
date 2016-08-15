/**
 * Created by SemenetsA on 15.08.2016.
 */
function fixround(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}