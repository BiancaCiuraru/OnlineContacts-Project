<?php 
if (!isset($_SESSION)) {
    session_start();
} else {
    session_destroy();
    session_start();
}
    include_once './models/grupuri_model.php';
    class Grupuri extends Controller{
        private $groupsModel;
        public $groupName;
        public $groupNameStatus;
        public $addGroupStatus;
        public $groupList;
        public $detailsList;
        public $check;
        public $username;
        public $userPhoto;
        public function __construct(){
            parent::__construct();
            $this->groupName = true;
            $this->addGroupStatus = false;
            $this->groupNameStatus = true;
            $this->check = true;
            $this->groupList = null;
            $this->userPhoto = null;
            $this->groupsModel = new Grupuri_Model();
            $this->view->render('pages/grupuri');
            $this->username = $this->groupsModel -> username($_SESSION['emailLogin']);
            $this->userPhoto = $this->groupsModel->getPhotoUser($_SESSION['emailLogin']);

            //adaugare grup
            if(isset($_POST['submit']))
            if($_POST['submit']==='addGroupBtn'){
                if(!$this->groupsModel -> nameGroupValidity($_POST['groupN'])){
                    $this->groupName = false;
                }else{
                    // $this->groupsModel->addGroup($_POST['groupN'], $_POST['description']);
                    if(!$this->groupsModel->addGroup($_POST['groupN'], $_POST['description'])){
                        $this->groupNameStatus = false;
                    }else{
                        $this->addGroupStatus = true;
                    }
                // }
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
    $controllerGroups = new Grupuri();
?>
