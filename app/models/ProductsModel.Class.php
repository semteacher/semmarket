<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:12
 */
class ProductsModel extends Model
{
    private $_id;
    private $_code;
    private $_name;
    private $_description;
    private $_stockqty;
    private $_price;
    private $_picture;
    private $_thumbnail;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getStockqty()
    {
        return $this->_stockqty;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->_picture;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->_thumbnail;
    }

    public function getAllProducts($sortoptions = NULL)
    {
        $productList = [];

        $sql = "SELECT
                    *
                FROM
                    products p";
        if ($sortoptions)
        {
            $sql = $sql . " ORDER BY p." . $sortoptions[0];
            if (isset($sortoptions[1]))
            {
                $sql = $sql . " " . $sortoptions[1];
            }
        }
        $sql = $sql . ";";

        $this->_setSql($sql);
        $products = $this->getAll();
//var_dump($contacts);
        if (empty($products))
        {
            return false;
        }
        else
        {
            foreach ($products as $product)
            {
                $tmpproduct = new ProductsModel;
                $tmpproduct->setProductByArray($product);
                array_push($productList, $tmpproduct);
            }
//var_dump($contactlist);
            return $productList;
        }

    }

    public function setProductByArray($productDeatils)
    {
        $this->_id = isset($productDeatils['id']) ? trim($productDeatils['id']) : NULL;
        $this->_code = isset($productDeatils['code']) ? trim($productDeatils['code']) : NULL;
        $this->_name = isset($productDeatils['name']) ? trim($productDeatils['name']) : NULL;
        $this->_description = isset($productDeatils['description']) ? trim($productDeatils['description']) : NULL;
        $this->_stockqty = isset($productDeatils['stockqty']) ? trim($productDeatils['stockqty']) : NULL;
        $this->_price = isset($productDeatils['price']) ? trim($productDeatils['price']) : NULL;
        $this->_picture = isset($productDeatils['picture']) ? trim($productDeatils['picture']) : NULL;
        $this->_thumbnail = isset($productDeatils['thumbnail']) ? trim($productDeatils['thumbnail']) : NULL;
    }

    public function getProductByIdAsArray($id)
    {
        $id = intval($id);

        $sql = "SELECT
                    *
                FROM
                    products p
                WHERE
                    p.id = ?";

        $this->_setSql($sql);
        $productDetails = $this->getRow(array($id));

        if (empty($productDetails))
        {
            return false;
        }
        else
        {
            return $productDetails;
        }

    }

    public function getProductById($id)
    {
        $id = intval($id);

        $sql = "SELECT
                    *
                FROM
                    producs p
                WHERE
                    p.id = ?";

        $this->_setSql($sql);
        $productDetails = $this->getRow(array($id));

        if (empty($productDetails))
        {
            return false;
        }
        else
        {
            $tmpproduct = $this->setProductByArray($productDetails);

            return $tmpproduct;
        }

    }

}