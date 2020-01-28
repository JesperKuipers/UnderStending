<?php

function NotifyApprovedVideo($videoId)
{
	//Haal de goedgekeurde video op
	$video = GetVideoById($videoId);
	if ($video)
	{
		//Haal gebruiker op die de video heeft geupload
		$user = GetUserById($video->uploader);
		if ($user)
		{
			//zet de email waardes
			$to = $user->email;
			$subject = "Goedgekeurde video";
			$message = "
				<h1>UnderStending</h1>
				<h2>$subject</h2>
				<p>
					Dag ".$user->name.", één van je geuploade video's is goedgekeurd:<br/>
					<a href=\"localhost/UnderStending/video.php?v=".$video->videoId."\">".$video->title."</a>
				</p>
			";
			//Zet de headers voor de mail
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: understending@hotmail.com";
			//verzend de email
			return mail($to, $subject, $message, $headers);
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

?>