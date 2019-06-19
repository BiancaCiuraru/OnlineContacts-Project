<?php 
if (!isset($_SESSION)) {
    session_start();
} else {
    session_destroy();
    session_start();
}
    include_once './models/grupuri_model.php';
    include_once './models/index_model.php';
    include_once './models/register_model.php';
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
        public $indexModel;
        public $editPassword;
        public $passwordRules;
        public $editEmail;
        public $editStatus;
        public function __construct(){
            parent::__construct();
            $this->groupName = true;
            $this->addGroupStatus = false;
            $this->groupNameStatus = true;
            $this->check = true;
            $this->groupList = null;
            $this->userPhoto = null;
            $this->editPassword = true;
            $this->passwordRules = true;
            $this->editEmail = true;
            $this->editStatus = false;
            $this->groupsModel = new Grupuri_Model();
            $this->indexModel = new Index_Model(); 
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
