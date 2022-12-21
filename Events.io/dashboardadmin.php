<?php

include 'connection.php';

if ($_SESSION["type_id"] != 1) {
    redirect('index.php');
}

include 'headerloggin.php';
echo '<div class="centered">
    <button type="button" class="button" data-open="postModal">Create an Event!</button>
    <div class="reveal" id="postModal" data-reveal>
        <form action="postCreate.php" name="createPost" onsubmit="return checkCreatePost(this)" method="post">
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="medium-4 cell">
                        <input type="text" name="title" placeholder="Title (required)">
                    </div>
                    <div class="medium-12 cell">
                        <label> Date (required)
                            <input type="datetime-local" name="date">
                        </label>
                    </div>
                    <div class="medium-12 cell">
                        <input type="text" name="location" placeholder="Location (required)">
                    </div>
                    <div class="medium-12 cell">
                        <textarea name="description" placeholder="Description (required)"></textarea>
                    </div>
                </div>
                <button class="submit button">Create</button>
            </div>
        </form>
    </div>
</div> ';

echo "<h2 style=\"margin-left:15%\"> Events</h2>";
$sql_AllPosts = "SELECT p.* from posts p";
$resultviewAllPosts = mysqli_query($db, $sql_AllPosts);

if (!$resultviewAllPosts)
    die('Action failed');
else {
    echo "<div class='grid-container'>";
    echo "<div class='grid-x grid-margin-x small-up-1 medium-up-2'>";
    while ($rowAllPosts = mysqli_fetch_array($resultviewAllPosts, MYSQLI_ASSOC)) {
        $idPost = $rowAllPosts["id"];
        echo
        "<div class='cell'>
            <div class='card'>
                <div class='card-section'>
                    <h2>" . $rowAllPosts["title"] . "</h2>
                    <button type='button' class='tiny alert button' data-open='deletePostModal" . $idPost . "'>Delete</button>
                    <button type='button' class='tiny button' data-open='editPostModal" . $idPost . "'>edit</button>
                    <h5>Date: " . $rowAllPosts["date"] . "</h5>
                    <h5>Location: " . $rowAllPosts["location"] . "</h5>
                    <p>" . $rowAllPosts["description"] . "</p>
                </div>";
        echo "</div>
        </div>";

        echo
        "<div class='reveal' id='editPostModal" . $idPost . "' data-reveal>
            <form action='postModify.php' method='post'>
                <div class='grid-container'>
                    <div class='grid-x grid-padding-x'>
                        <div class='medium-4 cell'>
                            <textarea name='title' required>" . $rowAllPosts["title"] . "</textarea>
                        </div>
                        <div class='medium-12 cell'>
                            <input type='datetime-local' name='date' value=" . $rowAllPosts["date"] . ">
                        </div>
                        <div class='medium-12 cell'>
                            <textarea name='location' required>" . $rowAllPosts["location"] . "</textarea>
                        </div>
                        <div class='medium-12 cell'>
                            <textarea name='description' required>" . $rowAllPosts["description"] . "</textarea>
                        </div>
                    </div>
                    <button class='submit button' name='idPost' value='$idPost'>Save</button>
                </div>
            </form>
        </div>";


        echo
        "<div class='tiny reveal' id='deletePostModal" . $idPost . "' data-reveal>
            <form action='postDelete.php' method='post'>
                <div class='grid-container'>
                    <p>Are you sure you want to delete this post: \"" . $rowAllPosts['title'] . "\"?</p>
                    <button class='alert button' name='idPost' value=" . $idPost . " style='float: left'>Delete Event</button>
                    <button type='button' class='button' data-close style='float: right'>Cancel</button>
                </div>
            </form>
        </div>";
         echo
        "<div class='tiny reveal' id='editPostModal" . $idPost . "' data-reveal>
            <form action='postModify.php' method='post'>
                <div class='grid-container'>
                    <div class='grid-x grid-padding-x'>
                        <div class='medium-4 cell'>
                            <textarea name='title' required>" . $rowAllPosts["title"] . "</textarea>
                        </div>
                        <div class='medium-12 cell'>
                            <input type='datetime-local' name='date' value=" . $rowAllPosts["date"] . ">
                        </div>
                        <div class='medium-12 cell'>
                            <textarea name='location' required>" . $rowAllPosts["location"] . "</textarea>
                        </div>
                        <div class='medium-12 cell'>
                            <textarea name='description' required>" . $rowAllPosts["description"] . "</textarea>
                        </div>
                    </div>
                    <button class='submit button' name='idPost' value='$idPost'>Save</button>
                </div>
            </form>
        </div>";
    }
    echo "</div>";
    echo "</div>";
}


include 'footer.php';