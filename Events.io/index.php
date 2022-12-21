<?php
include 'connection.php';
include 'header.php';

$mode = '';

if (isset($_POST['mode'])) {
    $mode = $_POST['mode'];
}

if ($mode == 'submitted') {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if ($email != '' && $pass != '') {
        $sql1 = "SELECT * from users where email = '$email' and password = '$pass' ";
        $result1 = mysqli_query($db, $sql1);

        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        if (!$row1) {
            die('Invalid email or password');
        } else {
            $result2 = mysqli_query($db, "SELECT users.id, users.username, users.type_id, user_type.fpage from users left join user_type on users.type_id = user_type.id where users.email ='$email' and users.password='$pass'");

            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

            $rows_number = mysqli_num_rows($result2);

            if ($rows_number > 0) {
                $_SESSION["id"] = $row2["id"];
                $_SESSION["username"] = $row2["username"];
                $_SESSION["type_id"] = $row2["type_id"];
                $_SESSION["fpage"] = $row2["fpage"];

                redirect($_SESSION["fpage"]);
                exit;
            }
        }
    } else {
        redirect("index.php");
    }
}
?>

<div class="bg-blue-dark height-full py-5">
    <div class="centered grid-y grid-x">
    <div class="cell small-12 medium-6 large-4">
        <div class="card m-0">
            <img class="cell small-12 medium-8 large-6" src="./img/banner.png" alt="DanyXD">
        </div>
    </div>
    <div class="cell small-12 medium-6 large-4">
        <div class="card">
            <form action='' method="post" name='loginForm' onsubmit="return check_login(this);">
                <div class="grid-container">
                    <h2>Login</h2>
                    <div class="grid-x grid-padding-x grid-padding-y">
                        <div class="medium-12 cell">
                            <label>
                                <input type="text" name='email' placeholder="Email" class="m-0">
                            </label>
                        </div>
                        <div class="medium-12 cell">
                            <label>
                                <input type="password" name='password' placeholder="Password" class="m-0">
                            </label>
                        </div>
                    </div>
                    <button class="submit button" name='mode' value='submitted'>Log In</button>
                    <button type="button" class="secondary button" data-open="signinModal">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



<div class="reveal" id="signinModal" data-reveal>
    <form action="signin.php" method="post" name='signinForm' onsubmit="return check_signin(this);">
        <div class="grid-container">
            <div class="centered grid-y grid-x">
                <h2>Sing in</h2>
                <div class="medium-8 cell">
                    <label>
                        <input type="text" name="username" placeholder="Username">
                    </label>
                </div>
                <div class="medium-8 cell">
                    <label>
                        <input type="email" name="email" placeholder="Email">
                    </label>
                </div>
                <div class="medium-8 cell">
                    <label>
                        <input type="password" name="password" placeholder="Password">
                    </label>
                </div>
                 
            <button class="submit button">Sign In</button>
            </div>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>