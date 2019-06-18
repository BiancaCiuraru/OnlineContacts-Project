<?php
    $controllerIndex = new Index();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo - Home</title>
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
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
            <div class="username">
                <a href="#" id="username">
                    <?php
                        echo $controllerIndex->username;
                    ?>
                </a>
                <div class="arrow-up"></div>
                <div class="dropdown-header">
                    <a href="#editModal"><img src="../public/images/edit.png"> Update Profile</a> <br />
                    <a href="?logout" class="logout"><img src="../public/images/logout.png"> Log Out</a>
                </div>
            </div>
        </div>

        <!-- edit profile modal -->
        <div id="editModal" class="modalDialog">
            <div class="right">
                <a href="#close" title="Close" class="close">X</a>
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
                    </form>
                </div>
            </div>
        </div>

        <!-- add contact to group -->
        <div id="addToGroupModal" class="modalDialog">
            <div class="right">
                <a href="index" title="Close" class="close">X</a>
                <div class="viewDetail">
                    <div class="header">
                        <h2 class="over-title">Add To Groups</h2>
                    </div>
                    <?php
                        echo '<div class="groupsList">';
                        $groupList = $controllerIndex->getGroups($_SESSION['emailLogin']);
                        echo '<ul>';
                        // <button id="addToGroupBtn' . $group->idGroup . '" value="addToGroupBtn" type="submit" name="addToGroupBtn" class = "addToGroupBtn">Add to ' . $group->nameGroup . '</button>
                        foreach ($groupList as $group) {
                            echo'<li> 
                            <span class="spanGroup" name="' . $group->nameGroup . '"> '. $group->nameGroup .'</span>
                            <a href="index" onclick="document.getElementById(\'addToGroup'. $group->idGroup .'\').submit();"  id = "addToGroupBtn" class = "buttonAddToGroup">Add to this group</a>
                            <form  method ="POST" id="addToGroup'. $group->idGroup .'">
                                <input type="hidden" name="idGroupp" value="'. $group->idGroup .'">
                            </form>
                            </li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                        if(isset($_POST['idGroupp'])){
                            $result=$controllerIndex->addToGroup($_GET['contactEmail'], $_POST['idGroupp']);
                        }    
                    ?>
                </div>
            </div>
        </div>

        <div id="viewDetailsModal" class="modalDialog">
            <div class="right">
                <a href="index#" title="Close" class="close">X</a>
                <div class="viewDetail">
                    <div class="header">
                        <h2 class="over-title">Contact Details</h2>
                    </div>
                    <form class="form" id="form2">
                        <?php
                        $contact = $controllerIndex->getContacts($_GET['contactEmail']);

                        echo '<h3>This is ' . $contact->firstName . ' ' . $contact->lastName . '</h3>
                            <div class="lab">
                                <img src="../public/images/' . $contact->photo . '"/>
                                <ul>
                                    <li><span>Birthday</span>: ' . $contact->birthday . '</li>
                                    <li><span>Phone Number</span>: ' . $contact->phone_number . '</li>
                                    <li><span>Email</span>: ' . $contact->email . '</li>
                                    <li><span>Adress</span>: ' . $contact->adress . '</li>
                                    <li><span>Interests</span>: ' . $contact->interests . '</li>
                                    <li><span>Description</span>: ' . $contact->description . '</li>
                                 </ul>
                            </div>';
                        ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- edit contact modal -->
        <div id="editContactModal" class="modalContactDialog">
            <div class="right">
                <a href="index" title="Close" class="close">X</a>
                <div class="editContact">
                    <div class="header">
                        <h2 class="over-title">Edit contact</h2>
                    </div>
                    <form  id = "formEditContact" class="form" method="POST" enctype="multipart/form-data">
                        <div class="photoContact">
                            <label for="photoContact">Change your photo</label>
                            <input type="file" id = "photoContact" name="photoContact" accept="image/*">
                        </div>
                        <div class="form-element">
                            <input class="inputContact" type="nameContact" id="nameContact" name="nameContact" placeholder="Enter the new name" />
                        </div>
                        <div class="form-element">
                            <input class="inputContact" type="adressContact" id="adressContact" name="adressContact" placeholder="Enter the new adress" />
                        </div>
                        <div class="form-element">
                            <input class="inputContact" type="interestsContact" id="interestsContact" name="interestsContact" placeholder="Enter the new interests" />
                        </div>
                        <div class="form-element">
                            <textarea class="inputContact" id="descriptionContact" name="descriptionContact" id="descriptionContact" placeholder="Enter the new description" rows="1"></textarea>
                        </div>

                        <div class="container-btn">
                            <button id="editContactBtn" value="editContactBtn" type="submit" name="editContactBtn">Edit Contact</button>
                            <!-- <a href="index#editContactModal" onclick="document.getElementById('formEditContact').submit();" style="text-decoration:none; color: black; border:1px solid; background:#C0C0C0;" id = "editContactBtn" class = "editContactBtn">Edit Contact</a> -->
                        </div>
                    </form>
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
                        <h1>Contacts</h1>
                    </p>
                </div>
                <div class="addfilter">
                    <a href="#">
                        <img src="../public/images/filled-filter.png" alt="AddFilter">
                    </a>
                    <div class="dropdown-filter">
                        <div class="filter">
                            <form action="#" method="POST">
                                <h2>Select criteria for filtering</h2>
                                <div class="form-element">
                                    <label for="byname">By First Name / Last Name</label>
                                    <input type="text" id="byname" name="byname" onkeyup="showResult(this.value)">
                                </div>
                                <div class="form-element Age">
                                    <div class="byage"><label for="byage">By Age: </label></div>
                                    <div class="criteria_age">
                                        <label for="smaller_than"> Smaller Than <input type="number" id="smaller_than" name="smaller_than" min="0" max="100"> </label>
                                        <label class="bigger" for="bigger_than"> Bigger Than <input type="number" id="bigger_than" name="bigger_than" min="0" max="100"> </label>
                                    </div>
                                </div>
                                <div class="form-element">
                                    <label for="byadress">By Adress</label>
                                    <input type="text" id="byadress" name="byadress">
                                </div>
                                <div class="form-element">
                                    <label for="byinterests">By Interests</label>
                                    <input type="text" id="byinterests" name="byinterests">
                                </div>
                                <div class="form-element">
                                    <label for="bydescr">By Description</label>
                                    <input type="text" id="bydescr" name="bydescr">
                                </div>
                                <input type="submit" value="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">
                        <img src="../public/images/download.png" alt="Export">
                    </a>
                    <div class="dropdown-content">
                        <div class="export">
                            <form method="POST" action="index">
                                <h2>Export contacts in a chosen format</h2>
                                <label for="rdo1">
                                    <input type="radio" id="rdo1" name="vCard">
                                    <span class="rdo"></span>
                                    <span>vCard</span>
                                </label>
                                <br />
                                <label for="rdo2">
                                    <input type="radio" id="rdo2" name="csv">
                                    <span class="rdo"></span>
                                    <span>CSV</span>
                                </label>
                                <br />
                                <label for="rdo3">
                                    <input type="radio" id="rdo3" name="Atom">
                                    <span class="rdo"></span>
                                    <span>Atom</span>
                                </label>
                                <br />
                                <input type="submit" name="export" value="Export">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <ul id="alphabet">
                    <a href="#" class="alp active" onclick="filterSelection('all')">
                        <li>All</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('A')">
                        <li>A</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('B')">
                        <li>B</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('C')">
                        <li>C</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('D')">
                        <li>D</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('E')">
                        <li>E</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('F')">
                        <li>F</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('G')">
                        <li>G</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('H')">
                        <li>H</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('I')">
                        <li>I</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('J')">
                        <li>J</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('K')">
                        <li>K</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('L')">
                        <li>L</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('M')">
                        <li>M</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('N')">
                        <li>N</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('O')">
                        <li>O</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('P')">
                        <li>P</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('Q')">
                        <li>Q</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('R')">
                        <li>R</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('S')">
                        <li>S</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('T')">
                        <li>T</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('U')">
                        <li>U</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('V')">
                        <li>V</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('W')">
                        <li>W</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('X')">
                        <li>X</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('Y')">
                        <li>Y</li>
                    </a>
                    <a href="#" class="alp" onclick="filterSelection('Z')">
                        <li>Z</li>
                    </a>
                </ul>
            </div>

            <div class="listcontact">
                <?php
                foreach ((array)$controllerIndex->contactList as $contactss) {
                    echo '<div class="contactname ' . substr($contactss->firstName, 0, 1) . ' ' . substr($contactss->lastName, 0, 1) . '">
                            <div class="buttons">
                            <div class="button1">
                                <a href="?contactEmail=' . $contactss->email . '#addToGroupModal"> <img src="../public/images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="?contactEmail=' . $contactss->email . '#editContactModal"> <img src="../public/images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="?contactEmail=' . $contactss->email . '#viewDetailsModal"><img src="../public/images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="../public/images/' . $contactss->photo . '" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>' . $contactss->firstName . ' ' . $contactss->lastName . ' <br> ' . $contactss->email . '
                            </p>
                        </div>
                        </div>';
                }
                ?>

            </div>
        </main>
    </div>
    <script>
        filterSelection("all")

        function filterSelection(c) {
            var x, i;
            x = document.getElementsByClassName("contactname");
            if (c == "all") c = "";
            for (i = 0; i < x.length; i++) {
                RemoveClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
            }
        }

        function AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                    element.className += " " + arr2[i];
                }
            }
        }

        function RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                    arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
        }

        var btns = document.getElementById("alphabet").getElementsByClassName("alp");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }

        function openNav() {
            document.getElementById("groups").style.width = "180px";
        }

        function closeNav() {
            document.getElementById("groups").style.width = "0";
        }
    </script>
    <script>
        function showResult(str) {
            if (str.length == 0) {
                document.getElementsByClassName("listcontact").innerHTML = "";
                document.getElementsByClassName("listcontact").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementsByClassName("listcontact").innerHTML = this.responseText;
                    document.getElementsByClassName("listcontact").style.border = "1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "filtrare.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

</body>

</html>