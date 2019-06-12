<?php 
    session_start();
    include_once '../models/add-contacts.model.php';
    class AddContactsController{
        public $contactName;
        public $contactEmail;
        public $contactStatus;
        private $addContactsModel;
        public $nameValidity;
        public $emailValidity;

        public function __construct(){
            $this->contactName = true;
            $this->contactEmail = true;
            $this->contactStatus = false;
            $addContactsModel = new AddContactsModel();

            if(isset($_POST['submit'])) {
                if($_POST['submit']==='addButton'){
                    if(!$addContactsModel -> nameValidity($_POST['firstname'], $_POST['lastname'])){
                        $this->contactName = false;
                    }else{
                        if($addContactsModel -> emailValidity($_POST['email'])>0){
                            $this->contactEmail = false;
                        }else{
                            $this->contactStatus = true;
                            $addContactsModel -> addContact($_POST['firstname'], $_POST['lastname'], $_POST['bday'], $_POST['phone'], $_POST['email'], $_POST['adress'], $_POST['interests'], $_POST['description']);
                        }
                    }
                }
            }
        }
    }
    $controllerAddContacts=new AddContactsController();
    include_once '../views/add-contacts.php'; 
?>
