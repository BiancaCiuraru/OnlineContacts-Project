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
                    <input type="text" id="byname" name="byname">
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
                <p class="filter_search" value="Search" id="Search" onclick="loadDoc()">Search</p>
                <h2 id="ErrorSearch" style="display:none"></h2>
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