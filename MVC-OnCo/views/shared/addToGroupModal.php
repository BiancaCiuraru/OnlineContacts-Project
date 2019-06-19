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
                echo '<li> 
                        <form method ="POST" action="#" id="addToGroup' . $group->idGroup . '">
                            <span class="spanGroup" name="' . $group->nameGroup . '"> ' . $group->nameGroup . '</span>
                            <button type="submit" name="submit" value="addToGroupBtn" id="addToGroupBtn" class = "buttonAddToGroup">Add to this group</button>
                            <input type="hidden" name="idGroupp" id="idGroupp" value="' . $group->idGroup . '">
                       </form>
                            
                            </li>';
                            // <span class="spanGroup" name="' . $group->nameGroup . '"> ' . $group->nameGroup . '</span>
                            // <a href="index" onclick="document.getElementById(\'addToGroup' . $group->idGroup . 
                            // '\').submit();"  id = "addToGroupBtn" class = "buttonAddToGroup">Add to this group</a>
                            // <form  method ="POST" id="addToGroup' . $group->idGroup . '">
                            //     <input type="hidden" name="idGroupp" value="' . $group->idGroup . '">
                            // </form>
            }
            echo '</ul>';
            echo '</div>';
            if (isset($_POST['idGroupp'])) {
                $result = $controllerIndex->addToGroup($_GET['contactEmail'], $_POST['idGroupp']);
            }
            ?>
        </div>
    </div>
</div>