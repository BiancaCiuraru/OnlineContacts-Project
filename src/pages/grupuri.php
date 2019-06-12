<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo - Home</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
</head>

<body>
    <header>
        <div class="left">
            <img src="../images/logo.png">
        </div>

        <div class="center">
            <div class="search">
                <input type="text" name="search" placeholder="Search for anything...">
            </div>
        </div>

        <div class="right">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
            <div class="username">
                <a href="#" id="username">Username</a>
                <div class="arrow-up"></div>
                <div class="dropdown-header">
                    <a href="#openModal"><img src="../images/edit.png"> Update Profile</a> <br />
                    <a href="./pages/login.register.php" class="logout"><img src="../images/logout.png"> Log Out</a>
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
                            <input type="email" class="form-control" id="email" placeholder="Enter your new email" required />
                        </div>
                        <div class="form-element">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your new password" required />
                        </div>
                        <div class="form-element">
                            <label for="password2">Confirm Password</label>
                            <input type="password" class="form-control" id="password2" placeholder="Enter your new password again" required />
                        </div>

                        <div class="container-btn">
                            <button type="button" id="editProfileBtn">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="groupModal" class="groupDialog">
            <div class="right">
                <a href="#close" title="Close" class="close">X</a>
                <div class="addGroupForm">
                    <div class="header">
                        <h2 class="over-title">Add group</h2>
                    </div>
                    <form class="form">
                        <div class="form-element">
                            <label for="email">Group name</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter group name" required />
                        </div>
                        <div class="form-element">
                            <label for="description">Description</label>
                            <textarea type="description" id="description" placeholder="Enter description" rows="4" required></textarea>
                        </div>
                        <div class="container-btn">
                            <button type="button">Add group</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </header>

    <div class="row">
        <nav>
            <a href="../Index.controller.php">
                <img src="../images/contacts.png" alt="Contacts" title="Contacts" />
            </a>
            <a href="./grupuri.controller.php">
                <img src="../images/group.png" alt="Groups" title="Groups" />
            </a>
            <a href="./add-contacts.controller.php">
                <img src="../images/add-user-2.png" alt="Add user" title="Add Contact" />
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
                        echo "<div class='contactname'><div class='image'><img src='../images/logo.png' alt='Contact Photo' /></div>
                        <div class='buttons'><div class='button-group'><a href='?groupName=". $group->groupName ."#descriptionModal'><img src='../images/arrow-right.png' alt='View Details' title='View Details' /></a></div></div>
                        <p>Name: " . $group->nameGroup ."<br> Created at: ". $group->created_date ."</p></div>";
                    }
                ?>
            </div>
        </main>
    </div>

    <!-- create new group -->
    <div id="groupsModal" class="groupDialog">
        <div class="right">
            <a href="#close" title="Close" class="close">X</a>
            <div class="addGroupForm">
                <div class="header">
                    <h2 class="over-title">Add group</h2>
                </div>
                <form class="form" action = "grupuri.controller.php" method = "POST" id = "form1">
                    <div class="form-element">
                        <label for="groupN">Group name</label>
                        <input type="text" class="form-control" id="groupN" name = "groupN" value="" placeholder="Enter group name" required />
                    </div>
                    <div class="form-element">
                        <label for="description">Description</label>
                        <textarea type="description" id="description" name = "description" placeholder="Enter description" rows="4" required></textarea>
                    </div>
                    <div class="container-btn">
                        <a href="#" onclick="document.getElementById('form1').submit(); " class = "addGroupButton">Add Group</a>
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
                            echo '<script>
                                    if(alert("Group has been successfully added!")){window.location.reload();}
                                </script>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <div id="descriptionModal" class="descriptionDialog">
        <div class="right">
            <a href="grupuri.controller.php#close" title="Close" class="close">X</a>
            <div class="descriptionGroupForm">
                <div class="header">
                    <h2 class="over-title">About this group</h2>
                </div>
                <form class="form" id = "form2">
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
                                <ul> <li>Name: ". $contact->fName . " " .$contact->lName . "</li>
                                <li>Email: ". $contact->email . "</li>
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