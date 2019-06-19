<?php 
    if (!isset($_SESSION)) {
        session_start();
    } else {
        session_destroy();
        session_start();
    }
    include_once './models/addcontacts_model.php';
    include_once './models/index_model.php';
    include_once './models/register_model.php';
    class AddContacts extends Controller{
        public $contactName;
        public $contactEmail;
        public $contactStatus;
        public $addContactsModel;
        public $nameValidity;
        public $emailValidity;
        public $username;
        public $userPhoto;
        public $editPassword;
        public $passwordRules;
        public $editEmail;
        public $editStatus;
        public $indexModel;
        public function __construct(){
            parent::__construct();
            $this->contactName = true;
            $this->contactEmail = true;
            $this->contactStatus = false;
            $this->userPhoto = null;
            $this->editPassword = true;
            $this->passwordRules = true;
            $this->editEmail = true;
            $this->editStatus = false;
            $this->addContactsModel = new AddContacts_Model();
            $this->indexModel = new Index_Model(); 
            $this->view->render('pages/add-contacts');
            $this->username = $this->addContactsModel->username($_SESSION['emailLogin']);
            $this->userPhoto = $this->addContactsModel->getPhotoUser($_SESSION['emailLogin']);

            if(isset($_POST['submit'])) {
                if($_POST['submit']==='addButton'){
                    if(!$this->addContactsModel -> nameValidity($_POST['firstname'], $_POST['lastname'])){
                        $this->contactName = false;
                    }else{
                        if($this->addContactsModel -> emailValidity($_POST['email'])>0){
                            $this->contactEmail = false;
                        }else{
                            $this->contactStatus = true;
                            $this->addContactsModel -> addContact($_POST['firstname'], $_POST['lastname'], $_POST['bday'], $_POST['phone'], $_POST['email'], $_POST['adress'], $_POST['interests'], $_POST['description']);
                        }
                    }
                }
            }
            if (isset($_POST['submit'])) {
                if ($_POST['submit'] === 'editProfileBtn') {
                        $this->indexModel->editProfilePhoto($_SESSION['emailLogin']);
                        $this->editStatus = true;
                    if ($_POST['emailE']!='') {
                        if ($this->modelLoginRegister->emailValidity($_POST['emailE']) > 0) {
                            $this->editEmail = false;
                        } else {
                            $this->indexModel->editProfileEmail($_SESSION['emailLogin'], $_POST['emailE']);
                            $this->editStatus = true;
                        }
                    }
                    if ($_POST['passwordE']!='' && $_POST['password2E']!='') {
                        if (!$this->modelLoginRegister->passwordValidity($_POST['passwordE'], $_POST['password2E'])) {
                            $this->editPassword = false;
                        } else if (!$this->modelLoginRegister->passwordRules($_POST['passwordE'], $_POST['password2E'])) {
                            $this->passwordRules = false;
                        } else {
                            $this->indexModel->editProfilePass($_SESSION['emailLogin'], $_POST['passwordE']);
                            $this->editStatus = true;
                        }
                    }
                }
            }
        }
    }
    $controllerAddContacts=new AddContacts();
?>
