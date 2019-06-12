<?php
// session_start();

include_once './pages/register.model.php';
include_once './index.controller.php';
$model = new LoginRegisterModel;
$controllerIndex = new IndexController;
$user = NULL;
if (isset($_SESSION['emailLogin']) && isset($_SESSION['hashedPassword'])) {
    $user = $model->getLoggedUser($_SESSION['emailLogin'], $_SESSION['hashedPassword']);
} else {
    header('Location: ./pages/register.controller.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnCo - Home</title>
    <link rel="stylesheet" type="text/css" href="./css/main.css?v=<?php echo time(); ?>" />

</head>

<body>
    <header>
        <div class="left">
            <img src="./images/logo.png">
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
                    <a href="#openModal"><img src="./images/edit.png"> Update Profile</a> <br />
                    <a href="./pages/login.register.php" class="logout"><img src="./images/logout.png"> Log Out</a>
                </div>
            </div>
        </div>

        <!-- edit profile modal -->
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
                            <img src="./images/login.jpg" />
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

        <!-- create new group -->
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

        <div id="viewDetailsModal" class="modalDialog">
            <div class="right">
                <a href="Index.php#close" title="Close" class="close">X</a>
                <div class="viewDetail">
                    <div class="header">
                        <h2 class="over-title">Contact Details</h2>
                    </div>
                    <form class="form" id="form2">
                        <?php
                        $contact = $controllerIndex->getContacts($_GET['contactEmail']);

                        echo '<h3>This is ' . $contact->firstName . ' ' . $contact->lastName . '</h3>
                                    <div class="lab">
                                        <img src="images/' . $contact->photo . '"/>
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

    </header>

    <div class="row">
        <nav>
            <a href="./index.controller.php">
                <img src="./images/contacts.png" alt="Contacts" title="Contacts" />
            </a>
            <a href="#groups" onclick="openNav()">
                <img src="./images/group.png" alt="Groups" title="Groups" />
            </a>
            <a href="./pages/add-contacts.controller.php">
                <img src="./images/add-user-2.png" alt="Add user" title="Add Contact" />
            </a>
        </nav>

        <nav id="groups" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="#groupModal">Add Group</a>
            <a href="./pages/grupuri.controller.php">Groups</a>
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
                        <img src="./images/filled-filter.png" alt="AddFilter">
                    </a>
                </div>
                <div class="dropdown">
                    <a href="#">
                        <img src="./images/download.png" alt="Export">
                    </a>
                    <div class="dropdown-content">
                        <div class="export">
                            <h2>Export contacts in a chosen format</h2>
                            <label for="rdo1">
                                <input type="radio" id="rdo1" name="radio">
                                <span class="rdo"></span>
                                <span>vCard</span>
                            </label>
                            <br />
                            <label for="rdo2">
                                <input type="radio" id="rdo2" name="radio">
                                <span class="rdo"></span>
                                <span>CSV</span>
                            </label>
                            <br />
                            <label for="rdo3">
                                <input type="radio" id="rdo3" name="radio">
                                <span class="rdo"></span>
                                <span>Atom</span>
                            </label>
                            <br />
                            <input type="submit" value="Export">
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
                foreach ($controllerIndex->contactList as $contactss) {
                    echo '<div class="contactname ' . substr($contactss->firstName, 0, 1) . ' ' . substr($contactss->lastName, 0, 1) . '">
                                         <div class="buttons">
                                                <div class="button1">
                                                    <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                                                 </div>
                                                 <div class="button2">
                                                     <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                                                </div>
                                                 <div class="button3">
                                                     <a class="idcontact" href="?contactEmail=' . $contactss->email . '#viewDetailsModal"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                                                 </div>
                                             </div>
                                             <div class="image">
                                                 <img src="images/' . $contactss->photo . '" alt="Contact Photo" />
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

</body>

</html>