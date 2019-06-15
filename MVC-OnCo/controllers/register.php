<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
else
{
    session_destroy();
    session_start(); 
}
    include_once './models/register_model.php';
    class Register extends Controller{
        public $register;
        public $registerStatus;
        public $registerName;
        public $registerEmail;
        public $registerPassword;
        public $passwordRules;
        public $loginStatus;
        public $fieldsStatus;
        public $user;
        public function __construct(){
            parent::__construct();
            $this->register = NULL;
            $this->user = NULL;
            $this->registerStatus = false;
            $this->registerName = true;
            $this->registerEmail = true;
            $this->registerPassword = true;
            $this->passwordRules = true;
            $this->loginStatus = null;
            $this->fieldsStatus = true;
            $this->session->checkLogedIn();
            $this->model = new Register_Model();
            $this->view->render('pages/login.register');
            if (isset($_POST['submit'])) {
                if ($_POST['submit'] === 'registerButton') {
                    if (!$_POST['Fname'] || !$_POST['Lname'] || !$_POST['email'] || !$_POST['password1'] || !$_POST['password2']) {
                        $this->fieldsStatus = false;
                    }else if(!$this->model->nameValidity($_POST['Fname'], $_POST['Lname'])){
                        $this->registerName = false;
                    }else if (!$this->model->passwordValidity($_POST['password1'], $_POST['password2'])) {
                        $this->registerPassword = false;
                    } else if (!$this->model->passwordRules($_POST['password1'], $_POST['password2'])) {
                        $this->passwordRules = false;
                    } else {
                        if ($this->model->emailValidity($_POST['email']) > 0) {
                            $this->registerEmail = false;
                        } else {
                            $this->register = $this->model->register($_POST['Fname'], $_POST['Lname'], $_POST['email'], $_POST['password1'], $_POST['password2']);
                            $this->registerStatus = true;
                            // header('Location: ./register.controller.php');
                        }
                    }
                } else if ($_POST['submit'] === 'loginButton') {
                    // if($_POST['emailLogin'] !== '' && $_POST['password'] !== ''){
                        $this->user = $this->model->login($_POST['emailLogin'], $_POST['password']);
                        $id_user=$this->model->getID($this->user);
                        if($this->user !== NULL){
                            $this->session->genToken($id_user); 
                            $_SESSION['emailLogin'] = $this->user -> emailLogin;
                            $_SESSION['hashedPassword'] = $this->user -> hashedPassword;    
                            header('Location: ./index');
                        }
                        else{
                            $this->loginStatus = false;
                        }
                    
                }
                }
            }
        // public function run(){
        //     $this->model->login();
        // }
    } 
    $controllerLoginRegister = new Register();
?>
