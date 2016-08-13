<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.07.2015
 * Time: 14:30
 */
class AlbumsController extends Controller
{

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function share($albumId)
    {
        $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';
        $errors = array();

        try {
            //Get album data
            $album = $this->_model->getAlbumByIdAsArray((int)$albumId);

            if (!$album) {
                $album['albumtitle'] = '';
                array_push($errors, "Album with ID=" . $albumId . " does not exist!");
            }

            if (isset($_POST['selectcontacts'])) {
                $album['shareemails'] = implode(', ', $_POST['selctedcontacts']);
            }
            //set initial sharing view
            $this->_view->set('pageheader', $userName . ': Albums Share (Demo) - ' . $album['albumtitle']);
            $this->_view->set('title', 'BundleJoy Inc. - Albums Share.');
            $this->_view->set('album', $album);
            $this->_view->set('errors', $errors);

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function selectcontacts()
    {
        try {
            //we can use select from other page only!
            if (!empty($_SERVER['HTTP_REFERER'])) {
                $_SESSION['selectcontact']['ref_url'] = $_SERVER['HTTP_REFERER'];

                $cont = new ContactsController('Contacts', 'select');
                return $cont->select();
            } else {
                header('Location: ' . SITE_ROOT . '/site/err403');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //public function sharereport($errors = null, $emailstoadd = null)
    public function sharereport()
    {
        //check current form submission1
        if (isset($_POST['sharereportgotoindex'])) {
            //goto list of albums
            //tmp - redirect to site home
            unset($_SESSION['sharealbum']['shareemails']);
            header('Location: ' . SITE_ROOT . '/site/index');
        } elseif (isset($_POST['sharealbumsubmit'])) {
            if ($_POST['sharealbumsubmit'] == 'Cancel') {
                //goto list of albums
                //tmp - redirect to site home
                header('Location: ' . SITE_ROOT . '/site/index');
            }
        }

        $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';
        $errors = array();
        $emailstoadd = array();
        $albumId = 0;

        try {
            //check current form submission2
            if (isset($_POST['sharereportaddcontacts'])) {
                $albumId = $_POST['albumId'];

                if (isset($_POST['selectedemailstoadd'])) {
                    //get list of selected emails and full list of the all emails to add
                    $selectedemailstoadd = $_POST['selectedemailstoadd'];
                    $emailstoadd = $_SESSION['sharealbum']['shareemails'];
                    //add emails to DB
                    $addcontactres = $this->_model->addEmailsToContacts($selectedemailstoadd);
                    if ($addcontactres !== true) {
                        array_push($errors, "Error when trying to add new contacts! Failed to add ".$addcontactres." email(s)");
                    }
                    //exclude it from list
                    foreach ($selectedemailstoadd as $selectedemailtoadd) {
                        if (($key = array_search($selectedemailtoadd, $emailstoadd)) !== false) {
                            unset($emailstoadd[$key]);
                        }
                    }
                    //update list of sharing emails
                    $_SESSION['sharealbum']['shareemails'] = $emailstoadd;
                }
            }
            //check sharing form submission
            if (isset($_POST['sharealbumsubmit'])) {
                $albumId = $_POST['album']['albumId'];
                //TODO: send email(s)
                //$this->sendemails($_POST['album']);
                $emailsuccess = true; //tmp....
                if (!$emailsuccess) {
                    array_push($errors, "Emails sending failure!");
                }
                $emailstoadd = $this->_model->checkEmailsExist($_POST['album']['shareemails']);
                //store list of sharing emails
                $_SESSION['sharealbum']['shareemails'] = $emailstoadd;
            }
            //Get album data
            $album = $this->_model->getAlbumByIdAsArray((int)$albumId);

            if (!$album) {
                $album['albumtitle'] = '';
                array_push($errors, "Album with ID=" . $albumId . " does not exist!");
            }
            //display "Add to contacts" form
            if (empty($errors)) {
                $this->_view->set('pageheader', $userName . ': Album - ' . $album['albumtitle'] . ' - shared successfully!');
            } else {
                $this->_view->set('pageheader', $userName . ': Albums - ' . $album['albumtitle'] . ' - error(s) occured!');
            }

            $this->_view->set('title', 'BundleJoy Inc. - Albums Sharing Report Page.');
            $this->_view->set('emailstoadd', $emailstoadd);
            $this->_view->set('errors', $errors);
            $this->_view->set('albumId', $albumId);

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}