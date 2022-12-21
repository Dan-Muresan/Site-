<?php

include 'connection.php';

if ($_SESSION["type_id"] != 1) {
    redirect('index.php');
}

include 'headerloggin.php';

$username = $email ='';
$start = 0;
$limit = 10;
$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
}

$sqlv = "SELECT * from users limit $start, $limit";
$resultview = mysqli_query($db, $sqlv);

if (!$resultview)
    die('Action failed');
else {
    echo "<table style=\"text-align:center;margin-left:auto;margin-right:auto;width:80%;margin-top:2%\" border=1 cellpadding=2>";
    echo "<tr><td><b>Username</b></td><td><b>Email address</b></td><td><b>Functions</b></td></tr>";
    
    while ($row = mysqli_fetch_array($resultview, MYSQLI_ASSOC)) {
        echo "<tr><td>";
        echo $row["username"];
        echo "</td><td>";
        echo $row["email"];
        echo "</td>";
            echo "<td><button type='button' class='small alert button' data-open='accountDeleteModal" . $row["id"] . "' name='delete' value='submitted'>Delete account</button>";
           echo"&nbsp";
            echo "<button type='button' class='small button' data-open='accountEditModal" . $row["id"] . "' name='edit' value='submitted'>Edit account</button></td>";
    
        echo "</tr>";

        echo
        "<div class='tiny reveal' id='accountDeleteModal" . $row["id"] . "' data-reveal>
            <form action='accountDelete.php' method='post'>
                <div class='grid-container'>
                    <p>Are you sure you want to delete this account: " . $row["username"] . "?</p>
                    <button class='alert button' name='userID' value=" . $row["id"] . " style='float: left'>Delete account</button>
                    <button type='button' class='button' data-close style='float: right'>Cancel</button>
                </div>
            </form>
        </div>";
         echo
        "<div class='tiny reveal' id='accountEditModal" . $row["id"] . "' data-reveal>
            <form action='accountEdit.php' method='post'>
                <div class='grid-container'>
                    <p>Are you sure you want to edit this account: " . $row["username"] . "?</p>
                    <button class='alert button' name='userID' value=" . $row["id"] . " style='float: left'>Edit account</button>
                    <button type='button' class='button' data-close style='float: right'>Cancel</button>
                </div>
            </form>
        </div>";
    }
    echo "</table>";

    $rows = mysqli_num_rows(mysqli_query($db, "SELECT * from users"));
    $total = ceil($rows / $limit);
    echo
    "<nav aria-label='Pagination'>
        <ul class='pagination text-center'>";
    if ($id > 1)
        echo "<li><a href='?id=" . ($id - 1) . "' class='button'>PREVIOUS</a></li>";
    for ($i = 1; $i <= $total; $i++)
        if ($i == $id)
            echo "<li class='current'>" . $i . "</li>";
        else
            echo "<li><a href='?id=" . $i . "'>" . $i . "</a></li>";

    if ($id != $total)
        echo "<li><a href='?id=" . ($id + 1) . "' class='button'>NEXT</a></li>";
    echo "</ul>
    </nav>";
}




include 'footer.php';