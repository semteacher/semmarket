<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 17.08.2016
 * Time: 21:18
 */
class OrderdetailsModel
{
    private $_id;
    private $_orderId;
    private $_productId;
    private $_qty;
    private $_price;

    public function getOrderDetails($idOrder)
    {
        $orderDetailsList = [];

        $sql = "SELECT
                    *
                FROM
                    orderdetails od
                WHERE
                    od.orderid = ?";

        $this->_setSql($sql);
        $orderDetailRows = $this->getAll($idOrder);
var_dump($orderDetailRows);
        if (empty($orderDetailRows))
        {
            return false;
        } else {
            foreach ($orderDetailRows as $orderDetail) {
                $tmporderdetail = new OrderdetailsModel;
                $tmporderdetail->setOrderDeatilByArray($orderDetail);
                array_push($orderDetailsList, $tmporderdetail);
            }
var_dump($orderDetailsList);
            return $orderDetailsList;
        }

    }

    public function setOrderDeatil($orderId, $productId, $qty, $price=NULL)
    {
        $this->_orderId = $orderId;
        $this->_productId = $productId;
        $this->_qty = $qty;
        $this->_price = $price;
    }

    public function  setOrderDeatilByArray($orderDeatil)
    {
        $this->_id = isset($orderDeatil['id']) ? trim($orderDeatil['id']) : NULL;
        $this->_orderId = $orderDeatil['orderId'];
        $this->_productId = $orderDeatil['productId'];
        $this->_qty = $orderDeatil['qty'];
        $this->_price = isset($productDeatils['price']) ? trim($productDeatils['price']) : NULL;
    }

    public function addOrderDetail()
    {
        $sql = "INSERT INTO orderdetails
                    (orderid, productid, qty, price)
                VALUES
                    (?, ?, ?)";

        $orderDetailData = array(
            $this->_orderId,
            $this->_productId,
            $this->_qty,
            $this->_price
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($orderDetailData);
    }

}