<?php
    $controllerLoginRegister=new Register();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo - Login</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="stylesheet" href="../../public/css/register.css">

    <style>
        .error, .success{
            color: red; 
            margin-top: 1em; 
            text-align: center; 
            font-weight: bold; 
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="container">
            <div class="left">
                <img src="../../public/images/logo.png" />
            </div>

            <div class="right">
                <div class="loginForm">
                    <div class="header">
                        <h6 class="over-title">Welcome back!</h6>
                        <h2 class="title">Log In</h2>
                    </div>
                    <form class="form" action = "#" method="POST" >
                        <div class="form-element">
                            <label for="emailLogin">Email adress</label>
                            <input type="email" class="form-control" id="emailLogin" name = "emailLogin" placeholder="👤 Enter your email" required />
                        </div>
                        <div class="form-element">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name = "password" placeholder="⚿ Enter your password" required />
                        </div>

                        <div class="forgotPass">
                            <a class="link" href="#">
                                Forgot password?
                            </a>
                        </div>

                        <div class="container-btn">
                            <button class="button" id="loginButton" name="submit" type="submit" value = "loginButton">Login</button>
                        </div>
                    </form>
                    <?php    
                        if(isset($this->controllerLoginRegister->loginStatus) && $this->controllerLoginRegister->loginStatus === false) {
                                echo '<p style="color: blue;"> Login error!</p>';
                                echo '<p style="color: blue;">'.$_POST['emailLogin'].'<br>'.$_POST['password'].'</p>';
                            } 
                    ?>
                    <div class="registerDiv">
                        <p>You don't have an account yet?</p>
                        <a class="link" href="#openModal">Create your personal account!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="openModal" class="modalDialog">
        <div class="right">
            <a href="#close" title="Close" class="close">X</a>
            <div class="registerForm">
                <div class="header">
                    <h6 class="over-title">Welcome!</h6>
                    <h2 class="title">Sing Up</h2>
                </div>
                <form action="#" class="form" method="POST" >
                    <div class="form-element">
                        <label for="Fname">First name</label>
                        <input type="text" class="form-control" id="Fname" name="Fname" placeholder="Enter your first name" />
                    </div>
                    <div class="form-element">
                        <label for="Lname">Last name</label>
                        <input type="text" class="form-control" id="Lname" name="Lname" placeholder="Enter your last name"  />
                    </div>
                    <div class="form-element">
                        <label for="email">Email adress</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"  />
                    </div>
                    <div class="form-element">
                        <label for="password1">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter your password"  />
                    </div>
                    <div class="form-element">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Enter your password again"  />
                    </div>
    
                    <div class="container-btn">
                        <button class="button" id="registerButton" value="registerButton" name="submit">Sign Up</button>
                    </div>
                    <?php 
                        if($controllerLoginRegister->registerEmail == false) {
                            echo '<p class="error"> Email already exists!</p>';
                        }else if($controllerLoginRegister->registerName == false){
                            echo '<p class="error"> Invalid name!</p>';
                        }else if($controllerLoginRegister->registerPassword == false){
                            echo '<p class="error"> Passwords do not match!</p>';
                        }else if($controllerLoginRegister->passwordRules == false){
                            echo '<p class="error"> Passwords must be at least 6 in length and must contain at least a non-letter character!</p>';
                        }else if($controllerLoginRegister->fieldsStatus == false){
                            echo '<p class="success"> Please fill out all fields!</p>';
                        }else if($controllerLoginRegister->registerStatus == true){
                            echo '<p class="success"> Register success!</p>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>

</body>

</html>