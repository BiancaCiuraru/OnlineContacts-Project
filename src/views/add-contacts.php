<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="../css/addcontact.css" />

    <style>
        .error, .success{
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
            <img src="../images/logo.png">
        </div>

        <div class="center">
            <div class="search">
                <form class="search-form">
                    <input type="text" name="search" placeholder="Search for anything...">
                </form>
            </div>
        </div>

        <div class="right">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
            <div class="username">
                <a href="#" id="username">Username</a>
                <div class="arrow-up"></div>
                <div class="dropdown-header">
                    <a href="#openModal"><img src="../images/edit.png"> Update Profile</a> <br />
                    <a href="./login.html" class="logout"><img src="../images/logout.png"> Log Out</a>
                </div>
            </div>
        </div>
        <div id="openModal" class="modalDialog">
            <div class="right">
                <a href="#close" title="Close" class="close">X</a>
                <div class="editProfileForm">
                    <div class="header">
                        <h2 class="over-title">Edit your profile</h2>
                    </div>
                    <form class="form">
                        <div class="form-element">
                            <label for="photo">Change your photo</label>
                            <!-- <input type="image" id="photo" name="photo" class="form-control" src="#" alt="Photo"> -->
                            <img src="../images/login.jpg" />
                        </div>
                        <div class="form-element">
                            <label for="email">Email adress</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your new email"
                                required />
                        </div>
                        <div class="form-element">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password"
                                placeholder="Enter your new password" required />
                        </div>
                        <div class="form-element">
                            <label for="password2">Confirm Password</label>
                            <input type="password" class="form-control" id="password2"
                                placeholder="Enter your new password again" required />
                        </div>

                        <div class="container-btn">
                            <button type="button">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="row">
        <nav>
            <a href="../controllers/Index.controller.php">
                <img src="../images/contacts.png" alt="Contacts" title="Contacts" />
            </a>
            <a href="../controllers/grupuri.controller.php">
                <img src="../images/group.png" alt="Groups" title="Groups" />
            </a>
            <a href="../controllers/add-contacts.controller.php">
                <img src="../images/add-user-2.png" alt="Add user" title="Add Contact" />
            </a>
        </nav>
        <main>
            <div class="title">
                <div class="page-path">
                    <p>Home/<h1>Add Contacts</h1></p>
                </div>
            </div>

            <div class="addcontact">
                <form method = "POST" action = "../controllers/add-contacts.controller.php" enctype="multipart/form-data">
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
                            <input type="file" id = "pic" name="pic" accept="image/*">
                        </div>

                        <div class="columnform">
                            <label for="email">Email</label>
                            <input type="email" id="emailContact" name="email" placeholder="Enter email..." required>
                        </div>

                    </div>
                    <div class="rowform">
                        <div class="columnform">
                            <label for="adress">Adress</label>
                            <textarea id="adress" name="adress" rows="3" placeholder="Write the adress..."
                                required></textarea>
                        </div>
                        <div class="columnform">
                            <label for="interests">Interests</label>
                            <textarea id="interests" name="interests" rows="3" placeholder="Write the interests..."
                                required></textarea>
                        </div>
                    </div>

                    <div class="rowform">
                        <div class="description">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder="Write a description..." rows="5"
                                required></textarea>
                        </div>
                    </div>
                    <div class="rowform">
                        <button type = "submit" id="addButton" value = "addButton" name="submit">Add Contact</button>
                    </div>
                    <?php
                        
                        if($controllerAddContacts->contactEmail == false) {
                            echo '<p class="error"> Email already exists!</p>';
                        }else if($controllerAddContacts->contactName == false){
                            echo '<p class="error"> Invalid name!</p>';
                        }else if($controllerAddContacts->contactStatus == true){
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