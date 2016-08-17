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
            //$userName = $_SESSION['loggeduser']['userName'];
            if (isset($_SESSION['loggeduser']['userName']))
            {
                $billtitle = 'Bill for ' . $_SESSION['loggeduser']['userName'];
                $balancetitle = 'Your balance: $ ';
                $loggedUser = new UsersModel;
                $userbalance = $loggedUser->getUserBalance();
            }
            else
            {
                $billtitle = 'Bill for Guest';
                $balancetitle = 'Your Gift is: $ ';
                $userbalance = SHOPPING_GIFT; //test task gift
            }
            //$products = $this->_model->getAllProducts($queryparams);
            //$this->_view->set('products', $products);
            $this->_view->set('title', 'SemMarket - My Shopping Cart');
            $this->_view->set('pageheader', 'My Shopping Cart');
            $this->_view->set('billtitle', $billtitle);
            $this->_view->set('balancetitle', $balancetitle);
            $this->_view->set('userbalance', $userbalance);

            return $this->_view->output();

        } catch (Exception $e) 
        {
            echo "Application error - cannot display Shopping Cart: " . $e->getMessage();
        }
    }
}