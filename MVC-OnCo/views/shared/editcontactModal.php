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
                            <input type="file" id="photoContact" name="photoContact" accept="image/*">
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