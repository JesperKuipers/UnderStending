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
	
	public function ThumbnailUrl()
	{
		return GetThumbnailUrl($this->thumbnailId, $this->thumbnailExtension);
	}
	
	public function VideoUrl()
	{
		return GetVideoUrl($this->urlId);
	}
}

?>