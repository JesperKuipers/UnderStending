<?php

//Extend GetVideoResult voor variabelen binnen class
class GetCurrentVideoResult extends GetVideoResult
{
	public function __construct($getVideoResult)
	{
		//Wijs waardes toe aan class o.b.v getvideoResult
		$this->videoId = $getVideoResult->videoId;
		$this->title = $getVideoResult->title;
		$this->description = $getVideoResult->description;
		$this->videoUrl = $getVideoResult->videoUrl;
		$this->thumbnailUrl = $getVideoResult->thumbnailUrl;
		$this->approved = $getVideoResult->approved;
		$this->rating = $getVideoResult->rating;
		$this->uploader = $getVideoResult->uploader;
		$this->uploaderName = $getVideoResult->uploaderName;
	}
	
	public $timestamp;
}

?>