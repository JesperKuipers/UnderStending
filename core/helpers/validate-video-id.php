<?php
function videoID() {
    $videoID = filter_input(INPUT_GET, 'v', FILTER_VALIDATE_INT);
    if (!$videoID) {
        return false;
    } else {
        return $videoID;
    }
}
