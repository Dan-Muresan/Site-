<?php

include 'connection.php';

include 'headerloggin.php';


if (isset ($_POST['rol'])){
	$userID = $_POST['use_id'];
	$username = $_POST['username'];
$password= $_POST['password'];
$email= $_POST['mail'];
$rol= $_POST['rol'];
$sql2=mysqli_query($db,"UPDATE users set username= '$username',email='$email',password='$password',type_id='$rol' where id = '$userID'");
redirect("view.php");
}else {
	$userID = $_POST['userID'];
$sql=mysqli_query($db,"SELECT * FROM users where id='$userID'");
 $row = $sql->fetch_assoc();
 echo "<form method=\"post\" action=\"accountEdit.php\" style=\"width:45%; margin-left:auto; margin-right:auto;\">
    <h3>Edit</h3>
    <input type='hidden' name='use_id'value ='" . $userID . "'>
    <label>Nume:</label>
    <input type=\"text\" name=\"username\" value=" . $row['username'] . ">
    <label>Email:</label>
    <input type=\"email\" name=\"mail\" value=" . $row['email'] . ">
    <label>Parola:</label>
    <input type=\"text\" name=\"password\" value=" . $row['password'] . ">
   <label>Rol:</label>
    <input type=\"number\" max='2' name=\"rol\" value=" . $row['type_id'] . ">
    <input type=\"hidden\" value=\"edit\"><button class=\"button\" type=\"submit\">Edit</button>
</form>";
}