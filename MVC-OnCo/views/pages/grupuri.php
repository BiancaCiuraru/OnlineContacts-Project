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
    <link rel="stylesheet" type="text/css" href="../public/css/main.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../public/css/register.css?v=<?php echo time(); ?>" />
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
            <?php
            if ($controllerGroups->userPhoto == null)
                echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">';
            else
            // if (file_exists('../public/images/' . $controllerGroups->userPhoto))
                echo '<img src="../public/images/' . $controllerGroups->userPhoto . '" alt="Avatar" class="avatar">';
            // else
                // echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">';
            ?>
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

        <?php include './views/shared/editcontactModal.php'; ?>

    </header>

    <div class="row">
        <?php include './views/shared/menu.php'; ?>

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
                foreach ($controllerGroups->groupList as $group) {
                    echo "<div class='groupsname'><div class='image'><img src='../public/images/logo.png' alt='Contact Photo' /></div>
                        <div class='buttons'><div class='button-group'><a href='?groupName=" . $group->groupName . "#descriptionModal'><img src='../public/images/arrow-right.png' alt='View Details' title='View Details' /></a></div></div>
                        <p>Name: " . $group->nameGroup . "<br> Created at: " . $group->created_date . "</p></div>";
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
                <form id="addGroupsForm" name="addGroupsForm" action="#" method="POST">
                    <div class="form-element">
                        <label for="groupN">Group name</label>
                        <input type="text" class="form-control" id="groupN" name="groupN" value="" placeholder="Enter group name" required />
                    </div>
                    <div class="form-element">
                        <label for="description">Description</label>
                        <textarea type="description" id="description" name="description" placeholder="Enter description" rows="4" required></textarea>
                    </div>

                    <div class="container-btn">
                        <!-- <a href="grupuri#groupsModal" onclick="document.getElementById('#addGroupsForm').submit();" class = "addGroupButton" >Add Group</a> -->
                        <!-- <a href="grupuri#groupsModal" onclick="myFunction();" class = "addGroupButton" >Add Group</a> -->
                        <button id="addGroupBtn" value="addGroupBtn" type="submit" name="submit" class="addGroupButton">Add Group</button>
                    </div>

                    <?php
                    if ($controllerGroups->groupName == false) {
                        echo '<script>
                                    if(alert("Invalid name!")){window.location.reload();}
                                </script>';
                    } else if ($controllerGroups->groupNameStatus == false) {
                        echo '<script>
                                    if(alert("Name already exists!")){window.location.reload();}
                                </script>';
                    } else if ($controllerGroups->addGroupStatus == true) {
                        // echo '<script>
                        //         if(alert("Group has been successfully added!")){window.location.reload();}
                        //     </script>';
                    }
                    ?>

                </form id="formAddGroups">
            </div>
        </div>
    </div>

    <div id="descriptionModal" class="modalDialog">
        <div class="right">
            <a href="grupuri#" title="Close" class="close">X</a>
            <div class="descriptionGroupForm">
                <div class="header">
                    <h2 class="over-title">About this group</h2>
                </div>
                <form action="#" method="POST" id="form2">
                    <?php
                    echo "<div class='lab'>
                           <h3>Group name:<span> " . $controllerGroups->getGroupName($_GET['groupName']) . "</span></h3>
                           <h3>Description: <span>" . $controllerGroups->getDescription($_GET['groupName']) . "</span></h3>
                        </div>";
                    $contactList = $controllerGroups->getContacts($_GET['groupName']);
                    echo "<h3>Contacts: </h3>";
                    foreach ($contactList as $contact) {
                        echo "<div class='lab'>
                                <ul> 
                                    <li><span style='color: black;'>Name: </span>" . $contact->fName . " " . $contact->lName . "</li>
                                    <li><span style='color: black;'>Email: </span>" . $contact->email . "</li>
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