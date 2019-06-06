<?php 
    session_start();
    include_once 'register.model.php';
    $register = NULL;
    $registerStatus = false;
    $registerName = true;
    $registerEmail = true;
    $registerPassword = true;
    $passwordRules = true;
    $loginStatus = null;
    $fieldsStatus = true;
    if(isset($_POST['submit'])) {
        switch($_POST['submit']){
            case "registerButton":
                if(!$_POST['Fname'] || !$_POST['Lname'] || !$_POST['email'] || !$_POST['password1'] || !$_POST['password2']){
                    $fieldsStatus = false;
                }else if(!nameValidity($_POST['Fname'], $_POST['Lname'], $_POST['email'])){
                    $registerName = false;
                // }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                //     $registerEmail = false;
                }else if( !passwordValidity($_POST['password1'], $_POST['password2'])){
                    $registerPassword = false;
                }else if(!passwordRules($_POST['password1'], $_POST['password2'])){
                    $passwordRules = false;
                }else{
                    if($em = emailValidity($_POST['email'])>0){
                        $registerEmail = false;
                    }else{
                        $register = register($_POST['Fname'], $_POST['Lname'], $_POST['email'], $_POST['password1'], $_POST['password2']);
                        $registerStatus = true;
                        // header('Location: ./register.controller.php#openModal');
                    }
                }
                break;
            case "loginButton":
                $user = login($_POST['emailLogin'], $_POST['password']);
                if($user !== NULL) {
                    header('Location: ../index.html');
                    $_SESSION['emailLogin'] = $user -> email;
                    $_SESSION['hashedPassword'] = $user -> hashedPassword;
                } else {
                    $loginStatus = false;
                }
                break;
        }
    }
    include_once 'login.register.php';
?>