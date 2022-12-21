<?php

include 'connection.php';

include 'headerloggin.php';
?>

<?php
$userID = $_SESSION['id'];

echo "<h2 style=\"margin-left:15%\">Events you follow</h2>";
$sql_FollowedPosts = "SELECT p.* from posts p join follow f on p.id = f.post_followed join users u on f.user_following = u.id where u.id = $userID group by p.id order by p.date";
$resultviewFollowed = mysqli_query($db, $sql_FollowedPosts);
if (!$resultviewFollowed)
    die('Action failed');
else {
    echo
    "<div class='grid-container'>
        <div class='grid-x grid-margin-x small-up-1 medium-up-2'>";
    while ($rowFollowed = mysqli_fetch_array($resultviewFollowed, MYSQLI_ASSOC)) {
        $idPostFollowed = $rowFollowed["id"];
        echo
        "<div class='cell'>
            <div class='card'>
                <div class='card-section'>
                    <h2>" . $rowFollowed["title"] . "</h2>
            
                    <h5>Date: " . $rowFollowed["date"] . "</h5>
                    <h5>Location: " . $rowFollowed["location"] . "</h5>
                    <p>" . $rowFollowed["description"] . "</p>
                    <div>
                        <form action=unfollow.php method=post>
                        <button class='submit button' name='idPost' value='$idPostFollowed'>Unfollow</button>
                        </form>
                    </div>
                </div>";
       
            }
            echo "</div>";
        }
        echo "</div>
        </div>";
    
    echo "</div>
    </div>";

echo "<h2 style=\"margin-left:15%\">Other events</h2>";
$sql_UnfPosts = "SELECT p.* from posts p
                where p.id not in (SELECT p.id from posts p join follow f on p.id = f.post_followed
                join users u on f.user_following = u.id where u.id = $userID group by p.id)
                 group by p.id order by p.date";
$resultviewUnf = mysqli_query($db, $sql_UnfPosts);
if (!$resultviewUnf)
    die('Action failed');
else {
    echo
    "<div class='grid-container'>
        <div class='grid-x grid-margin-x small-up-1 medium-up-2'>";
    while ($rowUnf = mysqli_fetch_array($resultviewUnf, MYSQLI_ASSOC)) {
       $idPostUnfollowed = $rowUnf["id"];
        echo
        "<div class='cell'>
            <div class='card'>
                <div class='card-section'>
                    <h2>" . $rowUnf["title"] . "</h2>
                    <h5>Date: " . $rowUnf["date"] . "</h5>
                    <h5>Location: " . $rowUnf["location"] . "</h5>
                    <p>" . $rowUnf["description"] . "</p>
                    <div>
                        <form action=follow.php method=post>
                        <button class='submit button' name='idPost' value='$idPostUnfollowed'>Follow</button>
                        </form>
                    </div>
                </div>";
       
        echo "</div>
        </div>";
    }
    echo "</div>
    </div>";
}

include 'footer.php';