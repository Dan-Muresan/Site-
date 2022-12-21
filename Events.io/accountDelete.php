<?php

include 'connection.php';

include 'headerloggin.php';

$userID = $_POST['userID'];


      
                $sqlaux1 = "DELETE from follow where user_following = $userID";
                $resultsaux1 = mysqli_query($db, $sqlaux1);
                if (!$resultsaux1)
                    die('Action failed');
                else {
                    $sql = "DELETE from users where id = $userID";
                    $results = mysqli_query($db, $sql);
                    if (!$results)
                        die('Action failed');
                    else {
                        if ($_SESSION["type_id"] == 1)
                            redirect('view.php');
                        else
                            redirect("logout.php");
                    }
                }
            
        
    

include 'footer.php';