<?php
function  RemovePlaylist($playlistID) {
    RemovePlaylistVideosByPlaylist($playlistID);
    RemovePlaylistFromDB($playlistID);
}
