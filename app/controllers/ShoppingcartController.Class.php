<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 15.08.2016
 * Time: 11:56
 */
class ShoppingcartController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }
    
    public function index()
    {
        try 
        {            
            //$products = $this->_model->getAllProducts($queryparams);
            //$this->_view->set('products', $products);
            $this->_view->set('title', 'SemMarket - My Shopping Cart');
            $this->_view->set('pageheader', 'My Shopping Cart');

            return $this->_view->output();

        } catch (Exception $e) 
        {
            echo "Application error - cannot display Shopping Cart: " . $e->getMessage();
        }
    }
}