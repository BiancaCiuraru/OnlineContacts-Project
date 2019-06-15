<?php 
    session_start();
    include_once './models/addcontacts_model.php';
    class AddContacts{
        public $contactName;
        public $contactEmail;
        public $contactStatus;
        private $addContactsModel;
        public $nameValidity;
        public $emailValidity;
        public $username;
        public function __construct(){
            $this->contactName = true;
            $this->contactEmail = true;
            $this->contactStatus = false;
            $this->addContactsModel = new AddContactsModel();
            $this->username = $this->addContactsModel->username($_SESSION['emailLogin']);

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
    $controllerAddContacts=new AddContactsController();
?>
