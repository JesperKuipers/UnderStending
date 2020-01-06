<?php include "includes/topinclude.php" ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST["rating"];
    $userID = $_SESSION['userID'];
    $videoID = videoID();
    print "vID: " . videoID();
    print "rating: " . $rating;

    $query = "INSERT INTO rating (videoID, userID, rating) VALUES (?, ?, ?);";

    if ($stmt = mysqli_prepare($conn, $query)) {
        if ($videoID === false) {
            echo "Dont break the videoID please!";
        } else {
            $videoID = videoID();
            mysqli_stmt_bind_param($stmt, "iii", $videoID, $userID, $rating);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Rating execute went bad <i>sad raccoon noices</i>";
            } else {
                echo "executed!";
            }
        }
    } else {
        echo "Rating prepare went bad <i>sad raccoon noices</i>";
    }
}
?>
    <form action="" method="post">
        <input type="text" name="rating">
        <input type="submit">
    </form>

<?php include "includes/bottominclude.php" ?>