<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:10
 */
class ProductsController extends Controller
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
            //TODO - create APP class and implement request method (like in YII)?
            $queryparams = array();
            if (isset($_GET['sort']))
            {
                $params = array();
                $params = explode(".", $_GET['sort']);

                //set sort option
                $queryparams[0] = $params[0];

                if (isset($params[1]) && !empty($params[1]))
                {
                    //set sort optional param
                    $queryparams[1] = $params[1];
                }

                $this->_view->set('queryparams', $queryparams);
            }

            $products = $this->_model->getAllProducts($queryparams);
            $this->_view->set('products', $products);
            $this->_view->set('title', 'SemMarket - Products Catalog');
            $this->_view->set('pageheader', 'Products Catalog');

            return $this->_view->output();

        }
        catch (Exception $e)
        {
            echo "Application error - cannot display Products Catalog: " . $e->getMessage();
        }
    }
        
    public function saverating()
    {
        try
        {
            $this->_setView('index');
            $this->index();
            
        }
         catch (Exception $e)
        {
            echo "Application error - cannot display Products Catalog: " . $e->getMessage();
        }
    }    
}