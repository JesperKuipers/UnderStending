<?php

function NotifyApprovedVideo($videoId)
{	
	$email = "understending@hotmail.com";
    $message = "Hello world!";
    $from = 'From: understending@hotmail.com';
    $to = 'understending@hotmail.com';
    $subject = 'onderwerp';
    $body = "From: $name\n E-Mail: $email\n Message:\n $message";
	
    return mail($to, $subject, $body, $from);
}

?>