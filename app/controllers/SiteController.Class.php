<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 17:37
 */
class SiteController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function login()
    {
        try
        {

            if (isset($_POST['loginusersubmit']))
            {
                if ($_POST['loginusersubmit'] == 'cancel')
                {
                    $this->index();
                }
                else
                {
                    //get POST data
                    $userName = isset($_POST['username']) ? trim($_POST['username']) : NULL;
                    $password = isset($_POST['password']) ? trim($_POST['password']) : NULL;

                    $loggedUser = new UsersModel;
                    $login = $loggedUser->userLogin($userName, $password);

                    if ($login)
                    {
                        //login successfull
                        $_SESSION['loggeduser']['userId'] = $loggedUser->getIdUser();
                        $_SESSION['loggeduser']['userName'] = $loggedUser->getUserName();
                        $_SESSION['loggeduser']['userRole'] = $loggedUser->getRole();
                        header('Location: ' . SITE_ROOT . '/site/index');
                        //$this->index;                       
                    }
                    else
                    {
                        //login fail
                        $this->_view->set('loginerr', 'Unknown user/password combination!');
                    }
                }
            }

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'SemMarket Inc. - Login, please!');
            $this->_view->set('title', 'SemMarket Inc. - Login Form');

            return $this->_view->output();

        }
        catch (Exception $e)
        {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index()
    {
        try
        {
            $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'Wellcome SemMarket Inc. Site, ' . $userName . '!');
            $this->_view->set('title', 'SemMarket Inc.');

            return $this->_view->output();

        }
        catch (Exception $e)
        {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function logout()
    {
        unset($_SESSION['loggeduser']);
        $this->_setView('index');
        $this->index();
        //header('Location: /site/index');
    }

    public function err403($errmsg = NULL)
    {
        try
        {

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'BundleJoy Inc. - Forbidden!');
            $this->_view->set('title', 'BundleJoy Inc. - 403 Error');
            $this->_view->set('errmsg', $errmsg);

            return $this->_view->output();

        }
        catch (Exception $e)
        {
            echo "Application error:" . $e->getMessage();
        }
    }
}