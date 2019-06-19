<div id="viewDetailsModal" class="modalDialog">
    <div class="right">
        <a href="index#" title="Close" class="close">X</a>
        <div class="viewDetail">
            <div class="header">
                <h2 class="over-title">Contact Details</h2>
            </div>
            <form class="form" id="formD">
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
<!-- 
<script scr="./public/js/loadContacts.js"> </script> -->