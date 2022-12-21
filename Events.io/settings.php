<?php

include 'connection.php';
include 'headerloggin.php';

$userID = $_SESSION['id'];
$sql = "SELECT * from users where id = $userID";
$results = mysqli_query($db, $sql);
$row = mysqli_fetch_array($results, MYSQLI_ASSOC);

echo
"<div class='centered grid-x' style=\"margin-top:5%\">
    <div class='cell small-12 medium-6 large-4'>
        <div class='card'>
            <form action='' method='post' name='signinForm' onsubmit='return check_signin(this);'>
                <div class='grid-container'>
                    <div class='centered grid-x grid-padding-x'>
                    <h2>Edit account details</h2>
                        <div class='medium-8 cell'>
                            <label>username
                                <input type='text' name='username' value='" . $row['username'] . "'>
                            </label>
                        </div>
                        <div class='medium-8 cell'>
                            <label>email
                                <input type='email' name='email' value='" . $row['email'] . "'>
                            </label>
                        </div>
                        <div class='medium-8 cell'>
                            <label>password
                                <input type='password' name='password' value='" . $row['password'] . "'>
                            </label>
                        </div>
                    </div>
                    <button class='submit button' name='save' value='submitted'>Save</button><br>";
                    if ($_SESSION["type_id"] != 1) {
                        echo "<button type='button' class='alert button' data-open='accountDeleteModal' name='delete' style='float: right'>Delete account</button>";
                    }
            echo "</div>
            </form>
        </div>
    </div>
</div>";

echo
"<div class='tiny reveal' id='accountDeleteModal' data-reveal>
    <form action='accountDelete.php' method='post'>
        <div class='grid-container'>
            <p>Are you sure you want to delete this account?</p>
            <button class='alert button' name='userID' value=" . $userID . " style='float: left'>Delete account</button>
            <button type='button' class='button' data-close style='float: right'>Cancel</button>
        </div>
    </form>
</div>";

$save = '';

if (isset($_POST['save'])) {
    $save = $_POST['save'];
}

if ($save == 'submitted') {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sqlSave = "UPDATE users set username='$username', email='$email',  password='$password' where id= $userID";
    $resultsSave = mysqli_query($db, $sqlSave);
    if (!$resultsSave)
        die('Sign in failed');
    else {
        $_SESSION["username"] = $username;
        redirect("settings.php");
    }
}

include 'footer.php';