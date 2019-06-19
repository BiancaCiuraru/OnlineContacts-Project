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
                    <input type="file" id="photoU" name="photoU" accept="image/*">
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
                <?php
                        if($controllerIndex->editEmail == false) {
                            echo '<p class="error"> Email already exists!</p>';
                        }else if($controllerIndex->editPassword == false){
                            echo '<p class="error"> Passwords do not match!</p>';
                        }else if($controllerIndex->passwordRules == false){
                            echo '<p class="error"> Passwords must be at least 6 in length and must contain at least a non-letter character!</p>';
                        } else if($controllerIndex->editStatus == true){
                            echo '<p class="success"> Edit Profile succesfuly!</p>';
                        }
                    ?>
            </form>
        </div>
    </div>
</div>

<style>
        .error, .success{
            color: red; 
            margin-top: 1em; 
            text-align: center; 
            font-weight: bold; 
            font-size: 1.5em;
        }
</style>