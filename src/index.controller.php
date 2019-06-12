<?php
    session_start();
    include_once 'index.model.php';
    class IndexController{
        public $contactList;
        public $username;
        public $contactModel;
        public $character = '';
        function __construct()
        {
            $this->contactModel = new IndexModel();
            $this->username = $this->contactModel -> username($_SESSION['emailLogin']);
            $this->contactList = $this->contactModel -> show_contacts($_SESSION['emailLogin']);
        }
        public function getContacts($contactEmail){
            return $this->contactModel->getContacts($_SESSION['emailLogin'], $contactEmail);
        }
    }

    $controllerIndex=new IndexController();
    include_once 'Index.php'; 
?>