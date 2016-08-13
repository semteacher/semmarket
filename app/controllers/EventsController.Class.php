<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.07.2015
 * Time: 14:31
 */

class EventsController extends Controller {

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function share()
    {
        try {

            $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'BundleJoy Inc. - Events invitation (Demo), '.$userName.'!');
            $this->_view->set('title', 'BundleJoy Inc. - Events invitation.');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

}