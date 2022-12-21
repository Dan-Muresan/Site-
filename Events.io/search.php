<?php

include 'connection.php';

include 'headerloggin.php';

$eventname = $_POST["eventname"];
$idUser = $_SESSION['id'];
$sql = "SELECT * from posts where title like '%$eventname%'";
$results = mysqli_query($db, $sql);

if (!$results)
    die("Name not found." . mysqli_error($db));
else {
    echo "<table style=\"margin-left:auto;margin-right:auto;width:80%;margin-top:2%\" border=1 cellpadding=2>";
    echo "<tr><td><b>Eventname</b></td><td><b>Follow</b></td></tr>";
    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
    $idPost= $row["id"];
    $sql2 = "select count(*) as followed from follow f inner join posts p on f.post_followed = p.id inner join users u on f.user_following = u.id WHERE P.ID=$idPost and u.id=$idUser ;";
$results2 = mysqli_query($db, $sql2);
       $row2 = mysqli_fetch_array($results2, MYSQLI_ASSOC);
        echo "<tr><td>";
        echo $row["title"];
        echo "</td>";
        echo "<td>";
        if($row2["followed"]==1){
        echo 
         "<div>
                        <form action=unfollow.php method=post>
                        <button class='submit button' name='idPost' value='$idPost'>Unfollow</button>
                        </form>
                    </div>";}
      else{echo 
         "<div>
                        <form action=follow.php method=post>
                        <button class='submit button' name='idPost' value='$idPost'>Follow</button>
                        </form>
                    </div>";}
        echo "</td></tr>";
    }
    echo "</table>";
}
include 'footer.php';