<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:12
 */

class ContactsModel extends Model {
    private $_idContact;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_phoneHome;
    private $_phoneWork;
    private $_phoneCell;
    private $_phoneBest;
    private $_address1;
    private $_address2;
    private $_city;
    private $_state;
    private $_country;
    private $_zip;
    private $_birthday;
    
    private $_errors;

//    public function __construct()
//    {
//        parent::__construct();
//    }

    public function setContact($idContact=NULL, $firstName, $lastName, $email, $phoneHome=Null)
    {
        $this->_idContact = $idContact;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_phoneHome = $phoneHome;
        //TODO: complete
    }
    
    public function setContactByArray($contactDeatils)
    {
        $this->_idContact = isset($contactDeatils['id_contact']) ? trim($contactDeatils['id_contact']) : NULL;
        $this->_firstName = isset($contactDeatils['fname']) ? trim($contactDeatils['fname']) : NULL;
        $this->_lastName = isset($contactDeatils['lname']) ? trim($contactDeatils['lname']) : NULL;
        $this->_email = isset($contactDeatils['email']) ? trim($contactDeatils['email']) : NULL;
        $this->_phoneHome = isset($contactDeatils['phone_h']) ? trim($contactDeatils['phone_h']) : NULL;
        $this->_phoneWork = isset($contactDeatils['phone_w']) ? trim($contactDeatils['phone_w']) : NULL;
        $this->_phoneCell = isset($contactDeatils['phone_c']) ? trim($contactDeatils['phone_c']) : NULL;
        $this->_phoneBest = isset($contactDeatils['phone_best']) ? trim($contactDeatils['phone_best']) : NULL;
        $this->_address1 = isset($contactDeatils['address1']) ? trim($contactDeatils['address1']) : NULL;
        $this->_address2 = isset($contactDeatils['address2']) ? trim($contactDeatils['address2']) : NULL;
        $this->_city = isset($contactDeatils['city']) ? trim($contactDeatils['city']) : NULL;
        $this->_state = isset($contactDeatils['state']) ? trim($contactDeatils['state']) : NULL;
        $this->_country = isset($contactDeatils['country']) ? trim($contactDeatils['country']) : NULL;
        $this->_zip = isset($contactDeatils['zip']) ? trim($contactDeatils['zip']) : NULL;
        //Todo: convert to date;
        $this->_birthday = isset($contactDeatils['birthday']) ? trim($contactDeatils['birthday']) : NULL;
    }
    
    public function validateContactByArray($contactDeatils)
    {
    }
    
    public function validateContact()
    {
        $errors = array();
        $check = true;
        
        if (empty($this->_firstName))
        {
            $check = false;
            array_push($errors, "First Name is required!");
        }

        if (empty($this->_lastName))
        {
            $check = false;
            array_push($errors, "Last Name is required!");
        }

        if (empty($this->_email))
        {
            $check = false;
            array_push($errors, "E-mail is required!");
        }
        else if (!filter_var( $this->_email, FILTER_VALIDATE_EMAIL ))
        {
            $check = false;
            array_push($errors, "Invalid E-mail!");
        }

        if (empty($this->_phoneHome)&&empty($this->_phoneWork)&&empty($this->_phoneCell))
        {
            $check = false;
            array_push($errors, "At least one phone is required!");
        }
        
        if (!$check) {
            $this->_errors = $errors;
            return false;
        } else {
            return true;
        }
    }
    
    public function validationErrors() 
    {
        return $this->_errors;
    }
    
    /**
     * @param mixed $idContact
     */
    public function setIdContact($idContact)
    {
        $this->_idContact = $idContact;
    }

    /**
     * @return mixed
     */
    public function getIdContact()
    {
        return $this->_idContact;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    public function setPhoneHome($phoneHome)
    {
        $this->_phoneHome = $phoneHome;
    }

    /**
     * @return mixed
     */
    public function getPhoneHome()
    {
        return $this->_phoneHome;
    }
    
    /**
     * @return mixed
     */
    public function getPhoneWork()
    {
        return $this->_phoneWork;
    }
    
    /**
     * @return mixed
     */
    public function getPhoneCell()
    {
        return $this->_phoneCell;
    }
    
    /**
     * @return mixed
     */
    public function getPhoneBest()
    {
        return $this->_phoneBest;
    }
    
    /**
     * @return mixed
     */
    public function getPhoneBestPhone()
    {
        if ($this->_phoneBest == 'h'){
            return $this->_phoneHome;
        } elseif ($this->_phoneBest == 'w'){
            return $this->_phoneWork;
        } else {
            return $this->_phoneCell;
        }
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->_address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->_address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->_birthday;
    }
    
    public function getAllContacts($sortoptions=NULL)
    {
        $contactList = [];

        $sql = "SELECT
                    *
                FROM
                    contacts c";
        if ($sortoptions) {
            $sql = $sql . " ORDER BY c." . $sortoptions[0];
            if (isset($sortoptions[1])) {
                $sql = $sql .  " " . $sortoptions[1];
            }
        }
        $sql = $sql . ";";

        $this->_setSql($sql);
        $contacts = $this->getAll();
//var_dump($contacts);
        if (empty($contacts))
        {
            return false;
        } else {
            foreach ($contacts as $contact) {
                $tmpcontact = new ContactsModel;
                //$tmpcontact->setContact($contact['id_contact'], $contact['fname'], $contact['lname'], $contact['email']);
                $tmpcontact->setContactByArray($contact);
                array_push($contactList, $tmpcontact);
            }
//var_dump($contactlist);
            return $contactList;
        }

    }

    public function getContactByIdAsArray($id_contact)
    {
        $id_contact = intval($id_contact);

        $sql = "SELECT
                    *
                FROM
                    contacts c
                WHERE
                    c.id_contact = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($id_contact));

        if (empty($contactDetails))
        {
            return false;
        } else {
            return $contactDetails;
        }

    }

    public function getContactById($id_contact)
    {
        $id_contact = intval($id_contact);

        $sql = "SELECT
                    *
                FROM
                    contacts c
                WHERE
                    c.id_contact = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($id_contact));

        if (empty($contactDetails))
        {
            return false;
        } else {
            $tmpcontact=$this->setContactByArray($contactDetails);
            
            return $tmpcontact;
        }

    }

    public function getContactByEmailAsArray($email)
    {
        //$id_contact = intval($id_contact);

        $sql = "SELECT
                    *
                FROM
                    contacts c
                WHERE
                    c.email = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($email));

        if (empty($contactDetails))
        {
            return false;
        } else {
            return $contactDetails;
        }

    }

    public function updateContact()
    {
        $sql = "UPDATE contacts c
                SET
                    c.fname=?, c.lname=?, c.email=?, c.phone_h=?, c.phone_w=?, c.phone_c=?, c.phone_best=?, c.address1=?, c.address2=?, c.city=?, c.state=?, c.country=?, c.zip=?, c.birthday=?
                WHERE
                    c.id_contact = ?";

        $contactData = array(
            $this->_firstName,
            $this->_lastName,
            $this->_email,
            $this->_phoneHome,
            $this->_phoneWork,
            $this->_phoneCell,
            $this->_phoneBest,
            $this->_address1,
            $this->_address2,
            $this->_city,
            $this->_state,
            $this->_country,
            $this->_zip,
            $this->_birthday,
            $this->_idContact
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($contactData);
    }

    public function addContact()
    {
        $sql = "INSERT INTO contacts
                    (fname, lname, email, phone_h, phone_w, phone_c, phone_best, address1, address2, city, state, country, zip, birthday)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $contactData = array(
            $this->_firstName,
            $this->_lastName,
            $this->_email,
            $this->_phoneHome,
            $this->_phoneWork,
            $this->_phoneCell,
            $this->_phoneBest,
            $this->_address1,
            $this->_address2,
            $this->_city,
            $this->_state,
            $this->_country,
            $this->_zip,
            $this->_birthday
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($contactData);
    }

    public function deleteContact($id_contact) {
        // we make sure $id is an integer
        $id_contact = intval($id_contact);

        $sql = 'DELETE FROM contacts WHERE id_contact = '.$id_contact;

        return $sth = $this->_db->exec($sql);

    }
}