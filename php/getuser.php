<?php
$q = intval($_GET['q']);

$link = mysqli_connect("localhost", "app2", "1234", "teme");

if (!$link) {
    echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL . "</br>";
    echo "Valoarea error: " . mysqli_connect_errno() . PHP_EOL . "</br>";
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL . "</br>";
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM vlad_utilizatori WHERE id = " . $id . "";

$result = mysqli_query($link, $sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="form-group">
            <label for="nameInputEdit">Nume</label>
            <input type="email" class="form-control" id="nameInputEdit" value="' . $row["user_name"] . '">
        </div>';
        echo '<div class="form-group">
            <label for="inputEmail1Edit">Email</label>
            <input type="email" class="form-control" id="inputEmail1Edit" aria-describedby="emailHelp" value="' . $row["email"] . '">
        </div>';
        echo '<div class="form-group">
            <label for="inputRolEdit">Rol</label>
            <input type="email" class="form-control" id="inputRolEdit" aria-describedby="rolHelp" value="' . $row["rol"] . '">
            <small id="rolHelp" class="form-text text-muted">Rolul pe care îl va avea utilizatorul (ADMIN=1 sau USER=0).</small>
        </div>';
        echo '<div class="form-group">
            <label for="inputPassword1Edit">Parolă inițială</label>
            <input type="password" class="form-control" id="inputPassword1Edit">
            <small id="emailHelp" class="form-text text-muted">Parola pe care o introduceți trebuie să fie
                din minim 6 caractere, să conțină minim o literă mare și minim o cifră</small>
        </div>';
        echo '<div class="form-group">
            <label for="inputPasswordRetypeEdit">Parolă nouă</label>
            <input type="password" class="form-control" id="inputPasswordRetypeEdit">
            <small id="emailHelp" class="form-text text-muted">Dacă doriți să schimbați parola</small>
        </div>';
        echo '</div>';
        echo '<div id="errorOnEdit" class="alert alert-danger" style="display:none"></div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
        echo '<button type="button" class="btn btn-primary" onclick="sendEditUser()">Save changes</button>';
        echo '</div>';
    }
} else {
    echo "Ceva nu a mers bine";
}
mysqli_close($con);
