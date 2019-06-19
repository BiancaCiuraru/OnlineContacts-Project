<?php
if (!isset($_SESSION)) {
    session_start();
} else {
    session_destroy();
    session_start();
}
include_once './models/index_model.php';
include_once './models/register_model.php';
class Index extends Controller
{
    public $contactList;
    public $username;
    public $contactModel;
    public $editPassword;
    public $passwordRules;
    public $editEmail;
    public $editStatus;
    public $iduser;
    public $userPhoto;
    function __construct()
    {
        parent::__construct();
        if ($_SESSION['loggedIn'] == false) {
            require_once 'register.php';
            return false;
        }
        $this->editPassword = true;
        $this->passwordRules = true;
        $this->editEmail = true;
        $this->editStatus = false;
        $this->userPhoto = null;
        $this->contactModel = new Index_Model();
        $this->modelLoginRegister = new Register_Model();
        $this->view->render('index');
        if (isset($_SESSION['emailLogin'])) {
            $this->username = $this->contactModel->username($_SESSION['emailLogin']);
            $this->contactList = $this->contactModel->show_contacts($_SESSION['emailLogin']);
            $this->iduser = $this->contactModel->getUserID($_SESSION['emailLogin']);
            $this->userPhoto = $this->contactModel->getPhotoUser($_SESSION['emailLogin']);
            $file = $this->contactModel->getContact($_SESSION['emailLogin']);
            if (count($file)) {
                $this->contactModel->xmlContact($file, $this->iduser);
            }
        }

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] === 'editProfileBtn') {
                if ($_POST['photoU']!='') {
                    $this->contactModel->editProfilePhoto($_SESSION['emailLogin'],$_POST['photoU']);
                    $this->editStatus = true;
                }
                if ($_POST['emailE']!='') {
                    if ($this->modelLoginRegister->emailValidity($_POST['emailE']) > 0) {
                        $this->editEmail = false;
                    } else {
                        $this->contactModel->editProfileEmail($_SESSION['emailLogin'], $_POST['emailE']);
                        $this->editStatus = true;
                    }
                }
                if ($_POST['passwordE']!='' && $_POST['password2E']!='') {
                    if (!$this->modelLoginRegister->passwordValidity($_POST['passwordE'], $_POST['password2E'])) {
                        $this->editPassword = false;
                    } else if (!$this->modelLoginRegister->passwordRules($_POST['passwordE'], $_POST['password2E'])) {
                        $this->passwordRules = false;
                    } else {
                        $this->contactModel->editProfilePass($_SESSION['emailLogin'], $_POST['passwordE']);
                        $this->editStatus = true;
                    }
                }
            }
        }

        if (isset($_POST['export'])) {
            if (isset($_POST['csv'])) {
                $this->contactModel->exportCSV($_SESSION['emailLogin']);
            } else if (isset($_POST['vCard'])) {
                $this->contactModel->exportVCard($_SESSION['emailLogin']);
            } else if (isset($_POST['Atom'])) {
                $this->contactModel->exportAtom($_SESSION['emailLogin']);
            }
        }

        if (isset($_GET['logout'])) {
            $this->session->distroySession($_SESSION['emailLogin']);
            $_SESSION['loggedIn'] = false;
            echo '<script language="JavaScript"> window.location.href ="register" </script>';
            die();
        }

        //edit contact
        if (isset($_POST['editContactBtn'])) {
            if (!($_POST['nameContact'] == "")) {
                $this->contactModel->updateFirstName($_SESSION['emailLogin'], $_GET['contactEmail'], $_POST['nameContact']);
            }
            if (!($_POST['adressContact'] == "")) {
                $this->contactModel->updateAdress($_SESSION['emailLogin'], $_GET['contactEmail'], $_POST['adressContact']);
            }
            if (!($_POST['interestsContact'] == "")) {
                $this->contactModel->updateInterests($_SESSION['emailLogin'], $_GET['contactEmail'], $_POST['interestsContact']);
            }
            if (!($_POST['descriptionContact'] == "")) {
                $this->contactModel->updateDescription($_SESSION['emailLogin'], $_GET['contactEmail'], $_POST['descriptionContact']);
            }
            if (!($_FILES["photoContact"]["name"] == "")) {
                $this->contactModel->updatePhoto($_SESSION['emailLogin'], $_GET['contactEmail']);
            }
        }

        if(isset($_POST['submit'])){
            if ($_POST['submit'] === 'addToGroupBtn') {
                if (isset($_POST['idGroupp'])) {
                    $this->contactModel->addToGroup($_SESSION['emailLogin'],$_GET['contactEmail'], $_POST['idGroupp']);
                }
            }
        }
    }

    public function addToGroup($contactEmail, $idGroup)
    {
        return $this->contactModel->addToGroup($_SESSION['emailLogin'], $contactEmail, $idGroup);
    }

    public function getContacts($contactEmail)
    {
        return $this->contactModel->getContacts($_SESSION['emailLogin'], $contactEmail);
    }
    public function getGroups()
    {
        return $this->contactModel->getGroups($_SESSION['emailLogin']);
    }
}

$controllerIndex = new Index();
