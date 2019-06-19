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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="left">
            <img src="../public/images/logo.png">
        </div>

        <div class="center">
            <div class="search">
                <input type="text" name="search" id="searchInput" onkeyup="myFunction()" placeholder="Search for anything...">
            </div>
        </div>

        <div class="right">
            <?php
            if ($controllerIndex->userPhoto == null)
                echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">';
            else 
                if (file_exists('../public/images/' . $controllerIndex->userPhoto))
                echo '<img src="../public/images/' . $controllerIndex->userPhoto . '" alt="Avatar" class="avatar">';
            else
                echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">';
            ?>
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
        <?php include './views/shared/editprofileModal.php'; ?>

        <!-- add contact to group -->
        <?php include './views/shared/addToGroupModal.php'; ?>

        <!-- view contact details -->
        <?php include './views/shared/detailsContactModal.php'; ?>

        <!-- edit contact modal -->
        <?php include './views/shared/editcontactModal.php'; ?>
        
    </header>

    <div class="row">
        <?php include './views/shared/menu.php'; ?>

        <main>
            <div class="title">
                <div class="page-path">
                    <p>Home/
                        <h1>Contacts</h1>
                    </p>
                </div>
                <?php include './views/shared/dropdowns.php'; ?>

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

                <div style="display: none;" id="iduser"> <?php echo $controllerIndex->iduser; ?></div>

                <div class="listcontact" id="listcontact1">
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
                                <img src="../public/images/' . $contactss->photo . '" alt="Contact Photo" onclick="loadDoc()"/>
                            </div>
                            <div class="text">
                                <p>' . $contactss->firstName . ' ' . $contactss->lastName . ' <br> ' . $contactss->email . '
                                </p>
                            </div>
                            </div>';
                    }
                    ?>
                </div>

                <script src="./public/js/loadContacts.js"></script>
                <script src="./public/js/index.js"></script>
        </main>
    </div>
</body>

</html>