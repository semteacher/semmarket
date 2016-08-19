<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 15.08.2016
 * Time: 11:54
 */
class ShoppingcartModel extends Model
{
    /**
     * @return mixed
     */
    public function getDeliveryOptions()
    {
        $testarray = array("pickup" => 0, "ups" => 5);
        return $testarray;
    }
}