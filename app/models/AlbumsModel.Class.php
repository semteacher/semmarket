<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.07.2015
 * Time: 14:31
 */
class AlbumsModel extends Model
{
    private $_idAlbum;
    private $_albumTitle;

    public function setContact($idAlbum = NULL, $albumTitle)
    {
        $this->_idAlbum = $idAlbum;
        $this->_albumTitle = $albumTitle;
    }

    /**
     * @return mixed
     */
    public function getIdAlbum()
    {
        return $this->_idAlbum;
    }

    /**
     * @return mixed
     */
    public function getAlbumTitle()
    {
        return $this->_albumTitle;
    }

    public function getAlbumByIdAsArray($albumId)
    {
        $albumId = intval($albumId);

        //$albumDetails = $this->getRow(array($albumId));

        //tmp - just for a test
        $albumDetails['albumtitle'] = 'My Demo Album';
        $albumDetails['albumId'] = 1;

//        $this->_albumTitle = $albumDetails['albumtitle'];
//        $this->_idAlbum = $albumDetails['albumId'] = 1;

        if (empty($albumDetails)) {
            return false;
        } else {
            return $albumDetails;
        }
    }

    public function checkEmailsExist($emailsstr)
    {
        $emails = explode(", ", $emailsstr);
        $emailstoadd = array();
        foreach ($emails as $email) {
            //check if contact exist
            $contact = new ContactsModel();
            if (!$contact->getContactByEmailAsArray($email)) {
                array_push($emailstoadd, $email);
            }
        }
        if (isset($emailstoadd)) {
            return $emailstoadd;
        } else {
            return false;
        }
    }

    public function addEmailsToContacts($selctedemailstoadd)
    {
        $errcount = 0;

        foreach ($selctedemailstoadd as $selctedemailtoadd) {
            //check if contact exist
            $contact = new ContactsModel();
            $contact->setContactByArray(array('email'=>$selctedemailtoadd));
            $curremailres = $contact->addContact();
            if (!$curremailres) {
                $errcount = $errcount+1;
            }
        }

        if ($errcount >0) {
            return $errcount;
        } else {
            return true;
        }

    }
}