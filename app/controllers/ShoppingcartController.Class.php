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
            $deliveryOptions = $this->_model->getDeliveryOptions(); //TODO: does not implementd due to test case
            //$deliveryOptions = ["pickup"=>0, "ups"=>5];
            
            if (isset($_SESSION['loggeduser']['userName']))
            {
                $billtitle = 'Order Bill for ' . $_SESSION['loggeduser']['userName'];
                $balancetitle = 'Your balance: $ ';
                $loggedUser = new UsersModel;
                $userbalance = $loggedUser->getUserBalance();
            }
            else
            {
                $billtitle = 'Order Bill for Guest';
                $balancetitle = 'Your Gift is: $ ';
                $userbalance = SHOPPING_GIFT;
            }

            $this->_view->set('title', 'SemMarket - My Shopping Cart');
            $this->_view->set('pageheader', 'My Shopping Cart');
            $this->_view->set('billtitle', $billtitle);
            $this->_view->set('balancetitle', $balancetitle);
            $this->_view->set('userbalance', $userbalance);
            $this->_view->set('deliveryOptions', $deliveryOptions);

            return $this->_view->output();

        } 
        catch (Exception $e) 
        {
            echo "Application error - cannot display Shopping Cart: " . $e->getMessage();
        }
    }
    
    public function saveorder()
    {
        try
        {
            //get order data
            if (isset($_POST['order']))
            {
                $orderId = isset($_POST['order']['orderId']) ? $_POST['order']['orderId'] : NULL;
                $orderdetails = $_POST['order']['orderdetails'];
                var_dump(json_decode($orderdetails));
                $deliverymethod = $_POST['order']['deliverymethod'];
            }
            //save order
            //TODO: test case
            //processing fee
            //TODO: test case
            //prepare receipt view
            $this->_setView('receipt');
            $this->_view->set('title', 'SemMarket - Your recipe');
            $this->_view->set('pageheader', 'Your recipe');

            return $this->_view->output();

        } 
        catch (Exception $e)
        {
            echo "Application error - cannot display Shopping Cart: " . $e->getMessage();
        }
    }
}