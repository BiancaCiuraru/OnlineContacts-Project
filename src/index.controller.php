<?php
    session_start();
    include_once 'index.model.php';
    class IndexController{
        public $contactList;
        public $username;
        public $contactModel;
        public $character = '';
        public $groupName;
        public $groupNameStatus;
        public $addGroupStatus;
        function __construct()
        {
            $this->contactModel = new IndexModel();
            $this->username = $this->contactModel -> username($_SESSION['emailLogin']);
            $this->contactList = $this->contactModel -> show_contacts($_SESSION['emailLogin']);

            if(isset($_POST['export'])) {
                if(isset($_POST['csv'])){
                    $this->contactModel -> exportCSV($_SESSION['emailLogin']);
                }else if(isset($_POST['vCard'])){
                    $this->contactModel -> exportVCard($_SESSION['emailLogin']);
                }else if(isset($_POST['Atom'])){
                    $this->contactModel -> exportAtom($_SESSION['emailLogin']);
                }
            }
        }
        public function getContacts($contactEmail){
            return $this->contactModel->getContacts($_SESSION['emailLogin'], $contactEmail);
        }
    }

    $controllerIndex=new IndexController();
    include_once 'Index.php'; 
?>