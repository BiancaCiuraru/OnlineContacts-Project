<?php
    session_start();
    
    include_once './pages/register.model.php';
    $user = NULL;
    if(isset($_SESSION['emailLogin']) && isset($_SESSION['hashedPassword'])) {
        $user = $getLoggedUser($_SESSION['emailLogin'], $_SESSION['hashedPassword']);
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
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
    </head>

    <body>
        <header>
            <div class="left">
                <img src="images/logo.png">
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
                        <a href="#openModal"><img src="images/edit.png"> Update Profile</a> <br />
                        <a href="./pages/login.register.php" class="logout"><img src="images/logout.png"> Log Out</a>
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
        </header>

        <div class="row">
            <nav>
                <a href="Index.html">
                    <img src="images/contacts.png" alt="Contacts" title="Contacts" />
                </a>
                <a href="./pages/grupuri.controller.php">
                    <img src="images/group.png" alt="Groups" title="Groups" />
                </a>
                <a href="./pages/add-contacts.controller.php">
                    <img src="images/add-user-2.png" alt="Add user" title="Add Contact" />
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
                            <img src="images/filled-filter.png" alt="AddFilter">
                        </a>
                    </div>
                    <div class="dropdown">
                        <a href="#">
                            <img src="images/download.png" alt="Export">
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
                    <ul class="alphabet">
                        <li>All</li>
                        <li>A</li>
                        <li>B</li>
                        <li>C</li>
                        <li>D</li>
                        <li>E</li>
                        <li>F</li>
                        <li>G</li>
                        <li>H</li>
                        <li>I</li>
                        <li>J</li>
                        <li>K</li>
                        <li>L</li>
                        <li>M</li>
                        <li>N</li>
                        <li>O</li>
                        <li>P</li>
                        <li>Q</li>
                        <li>R</li>
                        <li>S</li>
                        <li>T</li>
                        <li>U</li>
                        <li>V</li>
                        <li>W</li>
                        <li>X</li>
                        <li>Y</li>
                        <li>Z</li>
                    </ul>
                </div>

                <div class="listcontact">
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Ana Tiganescu (ADMIN) <br> ana.tiganescu@yahoo.ro
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>
                    <div class="contactname">
                        <div class="buttons">
                            <div class="button1">
                                <a href="#"> <img src="images/group.png" alt="add To Group" title="Add To Group" /></a>
                            </div>
                            <div class="button2">
                                <a href="#"> <img src="images/edit-contact.png" alt="Edit Contact" title="Edit Contact" /> </a>
                            </div>
                            <div class="button3">
                                <a href="#"><img src="images/arrow-right.png" alt="View Details" title="View Details" /></a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="images/logo.png" alt="Contact Photo" />
                        </div>
                        <div class="text">
                            <p>Bianca Ciuraru (ADMIN) <br> biancaciuraru@yahoo.com
                            </p>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </body>

    </html>