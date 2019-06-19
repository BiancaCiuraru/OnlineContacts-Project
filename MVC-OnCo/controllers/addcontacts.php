<?php 
    if (!isset($_SESSION)) {
        session_start();
    } else {
        session_destroy();
        session_start();
    }
    include_once './models/addcontacts_model.php';
    class AddContacts extends Controller{
        public $contactName;
        public $contactEmail;
        public $contactStatus;
        public $addContactsModel;
        public $nameValidity;
        public $emailValidity;
        public $username;
        public $userPhoto;
        public function __construct(){
            parent::__construct();
            $this->contactName = true;
            $this->contactEmail = true;
            $this->contactStatus = false;
            $this->userPhoto = null;
            $this->addContactsModel = new AddContacts_Model();
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
        }
    }
    $controllerAddContacts=new AddContacts();
?>
