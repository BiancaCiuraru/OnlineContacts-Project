<?php 
    $controllerGroups = new Grupuri();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo - Groups</title>
    <link rel="stylesheet" type="text/css" href="../public/css/main.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/register.css" />

    

</head>

<body>
    <header>
        <div class="left">
            <img src="../public/images/logo.png">
        </div>

        <div class="center">
            <div class="search">
                <input type="text" name="search" placeholder="Search for anything...">
            </div>
        </div>

        <div class="right">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
            <div class="username">
                <a href="#" id="username">
                    <?php
                        echo $controllerGroups->username;
                    ?>
                </a>
                <div class="arrow-up"></div>
                <div class="dropdown-header">
                    <a href="#editModal"><img src="../public/images/edit.png"> Update Profile</a> <br />
                    <a href="?logout" class="logout"><img src="../public/images/logout.png"> Log Out</a>
                </div>
            </div>
        </div>
        <div id="editModal" class="modalDialog">
            <div class="right">
                <a href="grupuri#" title="Close" class="close">X</a>
                <div class="editProfile">
                    <div class="header">
                        <h2 class="over-title">Edit your profile</h2>
                    </div>
                    <form action="#" class="form" method="POST">
                        <div class="Photo">
                            <label for="photo">Change your photo</label>
                            <input type="file" id="photo" name="photo" accept="image/*">
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
                </div>
            </div>
        </div>

    </header>

    <div class="row">
        <nav>
            <a href="index">
                <img src="../public/images/contacts.png" alt="Contacts" title="Contacts" />
            </a>
            <a href="grupuri">
                <img src="../public/images/group.png" alt="Groups" title="Groups" />
            </a>
            <a href="addcontacts">
                <img src="../public/images/add-user-2.png" alt="Add user" title="Add Contact" />
            </a>
             
        </nav>
        <main>
            <div class="title">
                <div class="page-path">
                    <p>Home/
                        <h1>Groups/<a href="#groupsModal" style="text-decoration: none; color:black;">Add Group</a></h1>
                        
                    </p>
                </div>
            </div>

            <div class="listcontact">
                <?php
                    foreach ($controllerGroups->groupList as $group){
                        echo "<div class='groupsname'><div class='image'><img src='../public/images/logo.png' alt='Contact Photo' /></div>
                        <div class='buttons'><div class='button-group'><a href='?groupName=". $group->groupName ."#descriptionModal'><img src='../public/images/arrow-right.png' alt='View Details' title='View Details' /></a></div></div>
                        <p>Name: " . $group->nameGroup ."<br> Created at: ". $group->created_date ."</p></div>";
                    // echo "<p style ='color: red;'>ceva</p>";
                    }
                ?>
            </div>
        </main>
    </div>

    <!-- create new group -->
    <div id="groupsModal" class="groupDialog">
        <div class="right">
            <a href="grupuri" title="Close" class="close">X</a>
            <div class="addGroupForm">
                <div class="header">
                    <h2 class="over-title">Add group</h2>
                </div>
                <form id = "addGroupsForm" name="addGroupsForm" action = "./controllers/grupuri.php" method="POST">
                    <div class="form-element">
                        <label for="groupN">Group name</label>
                        <input type="text" class="form-control" id="groupN" name = "groupN" value="" placeholder="Enter group name" required />
                    </div>
                    <div class="form-element">
                        <label for="description">Description</label>
                        <textarea type="description" id="description" name = "description" placeholder="Enter description" rows="4" required></textarea>
                    </div>
                    
                    <div class="container-btn">
                        <!-- <a href="grupuri#groupsModal" onclick="document.getElementById('#addGroupsForm').submit();" class = "addGroupButton" >Add Group</a> -->
                        <!-- <a href="grupuri#groupsModal" onclick="myFunction();" class = "addGroupButton" >Add Group</a> -->
                        <button id="addGroupBtn" value="addGroupBtn" type="submit" name="submit" class = "addGroupButton">Add Group</button>
                    </div>

                    <?php
                        if($controllerGroups->groupName == false){
                            echo '<script>
                                    if(alert("Invalid name!")){window.location.reload();}
                                </script>';
                        }else if($controllerGroups->groupNameStatus == false){
                            echo '<script>
                                    if(alert("Name already exists!")){window.location.reload();}
                                </script>';
                        }else if($controllerGroups->addGroupStatus == true){
                            // echo '<script>
                            //         if(alert("Group has been successfully added!")){window.location.reload();}
                            //     </script>';
                        }
                    ?>
                    
                </form id ="formAddGroups">
            </div>
        </div>
    </div>

    <div id="descriptionModal" class="descriptionDialog">
        <div class="right">
            <a href="grupuri#" title="Close" class="close">X</a>
            <div class="descriptionGroupForm">
                <div class="header">
                    <h2 class="over-title">About this group</h2>
                </div>
                <form action="#" method="POST" id = "form2">
                    <?php
                        echo "<div class='lab'>
                            <p><h3>Group name:</h3></p>
                                <p>" . $controllerGroups->getGroupName($_GET['groupName']) . "</p>
                        </div>
                        <div class='lab'>
                            <p><h3>Description:</h3></p>
                            <p>" . $controllerGroups->getDescription($_GET['groupName']) . "</p>
                        </div>";
                        $contactList = $controllerGroups->getContacts($_GET['groupName']);
                        echo "<p><h3>Contacts:</h3></p>";
                        foreach ($contactList as $contact){
                            echo "<div class='lab'>
                                <ul> <li><span style='color: black;'>Name</span>: ". $contact->fName . " " .$contact->lName . "</li>
                                <li><span style='color: black;'>Email</span>: ". $contact->email . "</li>
                                </ul>
                            </div>";
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>