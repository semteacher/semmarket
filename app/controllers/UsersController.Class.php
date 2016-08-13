<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 4.07.2015
 * Time: 18:10
 */

class UsersController extends Controller {

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {

            $users = $this->_model->getAllUsers();
            $this->_view->set('users', $users);
            $this->_view->set('title', 'BundleJoy - User Manager');
            $this->_view->set('pageheader', 'User Management Main Page');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error - cannot display Users list: " . $e->getMessage();
        }
    }
        
    public function add()
    {
        try {
//$this->_setView(edit);
            $this->_view->set('pageheader', 'Add User');
            $this->_view->set('title', 'Add User Form');
            $this->_view->set('mode', 'add');
           
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error - cannot show User form: " . $e->getMessage();
        }
    }
    
    public function edit($userId)
    {
        try {

            $user = $this->_model->getUserByIdAsArray((int)$userId);

            if ($user)
            {
                $this->_view->set('user', $user);
                $this->_view->set('mode', 'edit');
            }
            else
            {
                $this->_setView(add);
                $this->_view->set('mode', 'add');
            }
            
            $this->_view->set('pageheader', 'User Details Edit');
            $this->_view->set('title', 'User Details Edit Form');
            
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error - cannot display User data: " . $e->getMessage();
        }
    }
    
    public function changepassword($userId)
    {
        try {

            $user = $this->_model->getUserByIdAsArray((int)$userId);

            if ($user)
            {
                $this->_view->set('user', $user);
                $this->_view->set('mode', 'changepassword');
            }
            else
            {
                $this->_setView(add);
                $this->_view->set('mode', 'add');
            }
            
            $this->_view->set('pageheader', 'Change User Password');
            $this->_view->set('title', 'Change User Password Form');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error - cannot display User data: " . $e->getMessage();
        }
    }
    
    public function save()
    {
       // var_dump($_POST);
        if (!isset($_POST['editusersubmit'])||!isset($_POST['addusersubmit'])||!isset($_POST['changepasswordsubmit']))
        {
            header('Location: '.SITE_ROOT.'/users/index');
            //$this->index();
        } elseif ($_POST['editusersubmit']=='cancel'||$_POST['addusersubmit']=='cancel'||$_POST['changepasswordsubmit']=='cancel'){
            header('Location: '.SITE_ROOT.'/users/index');
            //$this->index();
        }
        $errors = array();
        $check = true;

        //get POST data
        $userName = isset($_POST['username']) ? trim($_POST['username']) : NULL;
        $password = isset($_POST['password']) ? trim($_POST['password']) : NULL;
        $confirmpassword = isset($_POST['confirmpassword']) ? trim($_POST['confirmpassword']) : NULL;
        $role = isset($_POST['role']) ? trim($_POST['role']) : NULL;

        //form data validation
        //TODO: create separate model method for the validation
        // if $this->_model->validateContact(-params-) {
        // $this->_model->setContact(-params-)} else { output form with data end error}
        if (empty($userName)&&(isset($_POST['editusersubmit'])||isset($_POST['addusersubmit'])))
        {
            $check = false;
            array_push($errors, "Username is required!");
        }

        if (empty($password)&&(isset($_POST['addusersubmit'])||isset($_POST['changepassword'])))
        {
            $check = false;
            array_push($errors, "Password is required!");
        }
        
        if (empty($confirmpassword)&&(isset($_POST['addusersubmit'])||isset($_POST['changepassword'])))
        {
            $check = false;
            array_push($errors, "Password confirmation is required!");
        }
        
        //TODO:check is null!
        if (!empty($password)&&(isset($_POST['editusersubmit'])||isset($_POST['changepasswordsubmit']))){
            //TODO: password validation rules
            if ($password !=$confirmpassword) {
                $check = false;
                array_push($errors, "Passwords mismatch!");
            }
        }
//var_dump($check);
//var_dump($errors);
//        else if (!filter_var( $email, FILTER_VALIDATE_EMAIL ))
//        {
//            $check = false;
//            array_push($errors, "Invalid E-mail!");
//        }

        //form data is invalid
        if (!$check)
        {
            if (isset($_POST['editusersubmit'])){
                $this->_setView('edit');
            } elseif (isset($_POST['changepasswordsubmit'])) {
                $this->_setView('edit');
            } else {
                $this->_setView('add');
            }
            
            $this->_view->set('title', 'User Details Form - Error');
            $this->_view->set('pageheader', 'User Details - Invalid user form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('mode', $_POST['mode']);
            $this->_view->set('user', $_POST);
            return $this->_view->output();
        }

        //store correct data
        try {
//var_dump($_POST);
            //TODO: remove
            $contact = $_POST['mode'] == 'add' ? new $this->_model : $this->_model->getUserById((int)$_POST['id_user']);
            //$contact->setFirstName($firstName);
            //$contact->setLastName($lastName);
            //$contact->setEmail($email);
            //$contact->setPhoneHome($phoneHome);

//var_dump($contact);
            //$_POST['mode'] == 'add' ? $contact->addContact() : $contact->updateContact();

            $this->_model->setUser($_POST['id_user'], $userName, md5($password), $role);
//var_dump($this->_model);
            $_POST['mode'] == 'add' ?  $this->_model->addUser() :  $this->_model->updateUser();

            $this->_setView('index');
            $this->_view->set('title', 'BundleJoy - User Manager');
            $this->_view->set('pageheader', 'User Management Page - store success!');

//            $data = array(
//                'firstName' => $firstName,
//                'lastName' => $lastName,
//                'email' => $email,
//                'message' => $phoneHome
//            );
//
//            $this->_view->set('userData', $data);

            $users = $this->_model->getAllUsers();
            $this->_view->set('users', $users);

        } catch (Exception $e) {
        
            if (isset($_POST['editusersubmit'])){
                $this->_setView('edit');
            } elseif (isset($_POST['changepasswordsubmit'])) {
                $this->_setView('edit');
            } else {
                $this->_setView('add');
            }
            
            $this->_view->set('title', 'User Details Form - Error');
            $this->_view->set('pageheader', 'User Details - There was an error saving the data!');
            $this->_view->set('mode', $_POST['mode']);
            $this->_view->set('user', $_POST);
            $this->_view->set('saveError', $e->getMessage());
        }

        return $this->_view->output();
    }
}