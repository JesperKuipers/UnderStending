<?php

function RemovePlaylist($playlistId)
{
    RemovePlaylistVideosByPlaylist($playlistId);
    RemovePlaylistFromDatabase($playlistId);
}

?>