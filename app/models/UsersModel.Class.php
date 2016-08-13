<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 4.07.2015
 * Time: 18:12
 */

class UsersModel extends Model {
    private $_idUser;
    private $_userName;
    private $_password;
    private $_role;

//    public function __construct()
//    {
//        parent::__construct();
//    }

    public function setUser($idUser=NULL, $userName, $password=Null, $role='user')
    {
        $this->_idUser = $idUser;
        $this->_userName = $userName;
        $this->_password = $password;
        $this->_role = $role;
    }
        /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->_idUser;
    }
    
    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->_userName;
    }
    
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->_role;
    }
    
    public function getAllUsers()
    {
        $userList = [];

        $sql = "SELECT
                    id_user, username, role
                FROM
                    users u";

        $this->_setSql($sql);
        $users = $this->getAll();
//var_dump($users);
        if (empty($users))
        {
            return false;
        } else {
            foreach ($users as $user) {
                $tmpuser = new UsersModel;
                $tmpuser->setUser($user['id_user'], $user['username'], null, $user['role']);
                array_push($userList, $tmpuser);
            }
//var_dump($userList);
            return $userList;
        }
    }
    
    public function getUserByIdAsArray($id_user)
    {
        $id_user = intval($id_user);

        $sql = "SELECT
                    id_user, username, role
                FROM
                    users u
                WHERE
                    u.id_user = ?";

        $this->_setSql($sql);
        $userDetails = $this->getRow(array($id_user));

        if (empty($userDetails))
        {
            return false;
        } else {
            return $userDetails;
        }

    }
    
    public function getUserById($id_user)
    {
        $id_user = intval($id_user);

        $sql = "SELECT
                    id_user, username, role
                FROM
                    users u
                WHERE
                    u.id_user = ?";

        $this->_setSql($sql);
        $userDetails = $this->getRow(array($id_user));

        if (empty($userDetails))
        {
            return false;
        } else {

            $this->_idUser = $userDetails['id_user'];
            $this->_lastName = $userDetails['username'];
            $this->_role = $userDetails['role'];

            return $this;
        }

    }
    
    public function userLogin($userName, $password)
    {
        $sql = "SELECT
                    id_user, username, role
                FROM
                    users u
                WHERE
                    (u.username = ?)AND(u.password = ?)";

        $this->_setSql($sql);
        $userDetails = $this->getRow(array($userName, md5($password)));

        if (empty($userDetails))
        {
    //var_dump($userDetails);
            return false;
        } else {
        //var_dump($userDetails);
            $this->_idUser = $userDetails['id_user'];
            $this->_userName = $userDetails['username'];
            $this->_role = $userDetails['role'];

            return $this;
        }
    }
    
    public function addUser()
    {
        $sql = "INSERT INTO users
                    (username, password, role)
                VALUES
                    (?, ?, ?)";

        $userData = array(
            $this->_userName,
            $this->_password,
            $this->_role
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($userData);
    }

    public function UpdateUser()
    {
        $sql = "UPDATE users u
                SET
                    u.username=?, u.password=?, u.role=?
                WHERE
                    u.id_user = ?";

        $userData = array(
            $this->_userName,
            $this->_password,
            $this->_role,
            $this->_idUser
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($userData);
    }
}