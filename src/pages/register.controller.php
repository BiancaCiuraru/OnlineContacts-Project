<?php
    session_start();
    include_once 'register.model.php';
    class LoginRegisterController{
        public $register;
        public $registerStatus;
        public $registerName;
        public $registerEmail;
        public $registerPassword;
        public $passwordRules;
        public $loginStatus;
        public $fieldsStatus;
        public $modelLoginRegister;
        public $user;
        public function __construct(){
            $this->register = NULL;
            $this->user = NULL;
            $this->registerStatus = false;
            $this->registerName = true;
            $this->registerEmail = true;
            $this->registerPassword = true;
            $this->passwordRules = true;
            $this->loginStatus = null;
            $this->fieldsStatus = true;
            $this->modelLoginRegister = new LoginRegisterModel();
            if (isset($_POST['submit'])) {
                if ($_POST['submit'] === 'registerButton') {
                    if (!$_POST['Fname'] || !$_POST['Lname'] || !$_POST['email'] || !$_POST['password1'] || !$_POST['password2']) {
                        $this->fieldsStatus = false;
                    }else if(!$this->modelLoginRegister->nameValidity($_POST['Fname'], $_POST['Lname'])){
                        $this->registerName = false;
                    }else if (!$this->modelLoginRegister->passwordValidity($_POST['password1'], $_POST['password2'])) {
                        $this->registerPassword = false;
                    } else if (!$this->modelLoginRegister->passwordRules($_POST['password1'], $_POST['password2'])) {
                        $this->passwordRules = false;
                    } else {
                        if ($this->modelLoginRegister->emailValidity($_POST['email']) > 0) {
                            $this->registerEmail = false;
                        } else {
                            $this->register = $this->modelLoginRegister->register($_POST['Fname'], $_POST['Lname'], $_POST['email'], $_POST['password1'], $_POST['password2']);
                            $this->registerStatus = true;
                            // header('Location: ./register.controller.php');
                        }
                    }
                } else if ($_POST['submit'] === 'loginButton') {
                    $user = $login($_POST['emailLogin'], $_POST['password']);
                    if ($user !== NULL) {
                        header('Location: ../index.php');
                        $_SESSION['emailLogin'] = $user -> emailLogin;
                        $_SESSION['hashedPassword'] = $user -> hashedPassword;
                    } else {
                        $loginStatus = false;
                    }
                }
            }
        }
    } 
    $controllerLoginRegister = new LoginRegisterController();
    include_once 'login.register.php';
?>
