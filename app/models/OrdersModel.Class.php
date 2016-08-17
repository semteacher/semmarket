<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 17.08.2016
 * Time: 20:52
 */
class OrdersModel extends Model
{
    private $_id;
    private $_userId;
    private $_creatertime;
    private $_deliverytype;
    private $_grandtotal;

    public function getOrderByIdAsArray($idOrder)
    {
        $idOrder = intval($idOrder);

        $sql = "SELECT
                    *
                FROM
                    orders o
                WHERE
                    o.id = ?";

        $this->_setSql($sql);
        $orderData = $this->getRow(array($idOrder));

        if (empty($orderData))
        {
            return false;
        } else {
            return $orderData;
        }

    }
    
    public function setOrder($idUser=0, $deliverytype, $grandtotal)
    {
        $this->_userId = $idUser;
        $this->_creatertime = time();
        $this->_deliverytype = $deliverytype;
        $this->_grandtotal = $grandtotal;
    }

    public function addOrder()
    {
        $sql = "INSERT INTO orders
                    (userid, creatertime, deliverytype, grandtotal)
                VALUES
                    (?, ?, ?, ?)";

        $orderData = array(
            $this->_userId,
            $this->_creatertime,
            $this->_deliverytype,
            $this->_grandtotal
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($orderData);
    }
}