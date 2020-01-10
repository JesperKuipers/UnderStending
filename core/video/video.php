<?php

class Video
{
	public $videoId;
	public $uploader;
	public $title;
	public $releaseDate;
	public $description;
	public $approved;
	public $urlId;
	public $thumbnailId;
	public $thumbnailExtension;
	
	public ThumbnailUrl()
	{
		return GetThumbnailUrl($thumbnailId, $thumbnailExtension);
	}
	
	public VideoUrl()
	{
		return GetVideoUrl($urlId);
	}
}

?>