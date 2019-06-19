<?php
$controllerAddContacts = new AddContacts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo - Add Contacts</title>
    <link rel="stylesheet" type="text/css" href="../public/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/addcontact.css" />

    <style>
        .error,
        .success {
            color: red;
            margin-top: 1em;
            text-align: center;
            font-weight: bold;
            font-size: 1.5em;
            margin-left: -5em;
        }
    </style>

</head>

<body>
    <header>
        <div class="left">
            <img src="../public/images/logo.png">
        </div>

        <div class="center">
            <div class="search">
                <form class="search-form">
                    <input type="text" name="search" placeholder="Search for anything...">
                </form>
            </div>
        </div>

        <div class="right">
            <?php
            if ($controllerAddContacts->userPhoto == null)
                echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">';
            else
            //if (file_exists('../public/images/' . $controllerAddContacts->userPhoto))
                echo '<img src="../public/images/' . $controllerAddContacts->userPhoto . '" alt="Avatar" class="avatar">';
            //else
                // echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">';
            ?>
            <div class="username">
                <a href="#" id="username">
                    <?php
                    echo $controllerAddContacts->username;
                    ?></a>
                <div class="arrow-up"></div>
                <div class="dropdown-header">
                    <a href="#editModal"><img src="../public/images/edit.png"> Update Profile</a> <br />
                    <a href="?login" class="logout"><img src="../public/images/logout.png"> Log Out</a>
                </div>
            </div>
        </div>
        <?php
        ?>
        <div id="editModal" class="modalDialog">
                <div class="right">
                        <a href="#close" title="Close" class="close">X</a>
                        <div class="editProfile">
                            <div class="header">
                                <h2 class="over-title">Edit your profile</h2>
                            </div>
                            <form action="#" class="form" method="POST" enctype="multipart/form-data">
                                <div class="Photo">
                                    <label for="photo">Change your photo</label>
                                    <input type="file" id="photoU" name="photoU" accept="image/*">
                                </div>
                                <div class="form-element">
                                    <label for="emailE">Email adress</label>
                                    <input type="email" id="emailE" name="emailE" placeholder="Enter your email" />
                                </div>
                                <div class="form-element">
                                    <label for="passwordE">Password</label>
                                    <input type="password" id="passwordE" name="passwordE" placeholder="Enter your new password" />
                                </div>
                                <div class="form-element">
                                    <label for="password2E">Confirm Password</label>
                                    <input type="password" id="password2E" name="password2E" placeholder="Enter your new password again" />
                                </div>

                                <div class="container-btn">
                                    <button id="editProfileBtn" value="editProfileBtn" type="submit" name="submit">Edit Profile</button>
                                </div>
                                <?php
                                        if($controllerAddContacts->editEmail == false) {
                                            echo '<p class="error"> Email already exists!</p>';
                                        }else if($controllerAddContacts->editPassword == false){
                                            echo '<p class="error"> Passwords do not match!</p>';
                                        }else if($controllerAddContacts->passwordRules == false){
                                            echo '<p class="error"> Passwords must be at least 6 in length and must contain at least a non-letter character!</p>';
                                        } else if($controllerAddContacts->editStatus == true){
                                            echo '<p class="success"> Edit Profile succesfuly!</p>';
                                        }
                                    ?>
                            </form>
                        </div>
                    </div>
            </div>
    </header>

    <div class="row">
        <?php include './views/shared/menu.php'; ?>

        <!-- edit profile modal -->

        <main>
            <div class="title">
                <div class="page-path">
                    <p>Home/<h1>Add Contacts</h1>
                    </p>
                </div>
            </div>

            <div class="addcontact">
                <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="rowform">
                        <div class="columnform">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="Enter first name..." required>
                        </div>
                        <div class="columnform">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lastname" placeholder="Enter last name..." required>
                        </div>
                    </div>

                    <div class="rowform">
                        <div class="columnform">
                            <label for="bday">Birthday</label>
                            <input type="date" id="bday" name="bday" required>
                        </div>
                        <div class="columnform">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter phone number..." required>
                        </div>
                    </div>
                    <div class="rowform">

                        <div class="columnform">
                            <label for="photo">Photo</label>
                            <input type="file" id="pic" name="pic" accept="image/*">
                        </div>

                        <div class="columnform">
                            <label for="email">Email</label>
                            <input type="email" id="emailContact" name="email" placeholder="Enter email..." required>
                        </div>

                    </div>
                    <div class="rowform">
                        <div class="columnform">
                            <label for="adress">Adress</label>
                            <textarea id="adress" name="adress" rows="3" placeholder="Write the adress..." required></textarea>
                        </div>
                        <div class="columnform">
                            <label for="interests">Interests</label>
                            <textarea id="interests" name="interests" rows="3" placeholder="Write the interests..." required></textarea>
                        </div>
                    </div>

                    <div class="rowform">
                        <div class="description">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder="Write a description..." rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="rowform">
                        <button type="submit" id="addButton" value="addButton" name="submit">Add Contact</button>
                    </div>
                    <?php

                    if ($controllerAddContacts->contactEmail == false) {
                        echo '<p class="error"> Email already exists!</p>';
                    } else if ($controllerAddContacts->contactName == false) {
                        echo '<p class="error"> Invalid name!</p>';
                    } else if ($controllerAddContacts->contactStatus == true) {
                        echo '<p class="success"> Contact has been successfully added!</p>';
                    }
                    ?>
                </form>
            </div>
    </div>
    </main>

    </div>

</body>

</html>