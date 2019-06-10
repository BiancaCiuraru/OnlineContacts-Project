<?php 
    session_start();
    include_once 'grupuri.model.php';
    class GroupsController{
        private $groupsModel;
        public $groupName;
        public $groupNameStatus;
        public $addGroupStatus;
        public $groupList;
        public $detailsList;
        public $check;

        public function __construct(){
            $this->groupName = true;
            $this->addGroupStatus = false;
            $this->groupNameStatus = true;
            $this->check = true;
            $this->groupList = null;
            $this->groupsModel = new GroupsModel();
            

            //adaugare grup
            if(isset($_POST['groupN'])){
                if(!$this->groupsModel -> nameGroupValidity($_POST['groupN'])){
                    // header('Location: ./grupuri.controller.php?check=false#groupsModal');
                    $this->groupName = false;
                    // $this->check = false;
                }else{
                    if(!$this->groupsModel->addGroup($_POST['groupN'], $_POST['description'])){
                        // header('Location: ./grupuri.controller.php?check=false#groupsModal');
                        $this->groupNameStatus = false;
                        // $this->check = false;
                    }else{
                        // header('Location: ./grupuri.controller.php?check=true#groupsModal');
                        $this->addGroupStatus = true;
                        // $this->check = true;
                    }
                }
            }

            //listarea grupurilor
            $this->groupList = $this->groupsModel -> listGroup($_SESSION['emailLogin']);
        }

        //vizualizare detalii
        public function getDescription($groupName){
            return $this->groupsModel->getDescription($_SESSION['emailLogin'], $groupName);
        }
        public function getGroupName($groupName){
            return $this->groupsModel->getGroupName($_SESSION['emailLogin'], $groupName);
        }
        public function getContacts($groupName){
            return $this->groupsModel->getContacts($_SESSION['emailLogin'], $groupName);
        }
    }
    $controllerGroups = new GroupsController();
    include_once 'grupuri.php'; 
?>
