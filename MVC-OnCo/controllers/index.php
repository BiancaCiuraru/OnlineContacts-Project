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
    public $fieldsStatus;
    public $edit;
    public $editStatus;
    function __construct()
    {
        parent::__construct();
        if ($_SESSION['loggedIn'] == false) {
            require_once 'register.php';
            return false;
        }
        $this->edit = NULL;
        $this->editPassword = true;
        $this->fieldsStatus = true;
        $this->passwordRules = true;
        $this->editEmail = true;
        $this->editStatus = false;
        $this->contactModel = new Index_Model();
        $this->modelLoginRegister = new Register_Model();
        $this->view->render('index');
        if (isset($_SESSION['emailLogin'])) {
            $this->username = $this->contactModel->username($_SESSION['emailLogin']);
            $this->contactList = $this->contactModel->show_contacts($_SESSION['emailLogin']);
            $file = $this->contactModel->getContact($_SESSION['emailLogin']);
            if (count($file)) {
                $this->contactModel->xmlContact($file, $_SESSION['emailLogin']);
            }
        }

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] === 'editProfileBtn') {
                if ($_POST['photo'] && !$_POST['emailE'] && !$_POST['passwordE'] && !$_POST['password2E']) {
                    $this->edit = $this->contactModel->editPhoto($_SESSION['emailLogin']);
                } else if (!$this->modelLoginRegister->passwordValidity($_POST['passwordE'], $_POST['password2E'])) {
                    $this->editPassword = false;
                } else if (!$this->modelLoginRegister->passwordRules($_POST['passwordE'], $_POST['password2E'])) {
                    $this->passwordRules = false;
                } else {
                    if ($this->modelLoginRegister->emailValidity($_POST['emailE']) > 0) {
                        $this->editEmail = false;
                    } else {
                        $this->edit = $this->contactModel->editProfile($_SESSION['emailLogin'], $_POST['emailE'], $_POST['passwordE'], $_POST['photo']);
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
            $this->session->distroySession();
            $_SESSION['loggedIn'] = false;
            echo '<script language="JavaScript"> window.location.href ="register" </script>';
            die();
        }
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
