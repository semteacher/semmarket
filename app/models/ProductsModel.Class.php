<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:12
 */

class ProductsModel extends Model {
    private $_id;
    private $_code;
    private $_name;
    private $_description;
    private $_stockqty;
    private $_price;
    private $_picture;
    private $_thumbail;

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
    public function getThumbail()
    {
        return $this->_thumbail;
    }

    public function setProductByArray($productDeatils)
    {
        $this->_idContact = isset($productDeatils['id']) ? trim($productDeatils['id']) : NULL;
        $this->_firstName = isset($productDeatils['code']) ? trim($productDeatils['code']) : NULL;
        $this->_lastName = isset($productDeatils['name']) ? trim($productDeatils['name']) : NULL;
        $this->_email = isset($productDeatils['description']) ? trim($productDeatils['description']) : NULL;
        $this->_phoneHome = isset($productDeatils['stockqty']) ? trim($productDeatils['stockqty']) : NULL;
        $this->_phoneWork = isset($productDeatils['price']) ? trim($productDeatils['price']) : NULL;
        $this->_phoneCell = isset($productDeatils['picture']) ? trim($productDeatils['picture']) : NULL;
        $this->_phoneBest = isset($contactDeatils['thumbail']) ? trim($contactDeatils['thumbail']) : NULL;
    }
    
    public function getAllProducts($sortoptions=NULL)
    {
        $productList = [];

        $sql = "SELECT
                    *
                FROM
                    producs p";
        if ($sortoptions) {
            $sql = $sql . " ORDER BY p." . $sortoptions[0];
            if (isset($sortoptions[1])) {
                $sql = $sql .  " " . $sortoptions[1];
            }
        }
        $sql = $sql . ";";

        $this->_setSql($sql);
        $producs = $this->getAll();
//var_dump($contacts);
        if (empty($producs))
        {
            return false;
        } else {
            foreach ($producs as $produc) {
                $tmpproduct = new ContactsModel;
                $tmpproduct->setProductByArray($produc);
                array_push($productList, $tmpproduct);
            }
//var_dump($contactlist);
            return $productList;
        }

    }

    public function getProductByIdAsArray($id)
    {
        $id = intval($id);

        $sql = "SELECT
                    *
                FROM
                    producs p
                WHERE
                    p.id = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($id));

        if (empty($contactDetails))
        {
            return false;
        } else {
            return $contactDetails;
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
        $productDeatils = $this->getRow(array($id));

        if (empty($productDeatils))
        {
            return false;
        } else {
            $tmpproduct=$this->setProductByArray($productDeatils);
            
            return $tmpproduct;
        }

    }

}