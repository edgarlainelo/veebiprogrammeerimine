<?php
function makeImage($picFile, $imageFileType){
	if($imageFileType == "jpg" or $imageFileType == "jpeg"){
		$myTempImage = imagecreatefromjpeg($picFile);
	}
	if($imageFileType == "png"){
		$myTempImage = imagecreatefromjpeg($picFile);
	}
	if($imageFileType == "gif"){
		$myTempImage = imagecreatefromjpeg($picFile);
	}
	return $myTempImage;		
}

function setPicSize($myTempImage, $picSizeRatio){
	$picW = imagesx($myTempImage);
	$picH = imagesy($myTempImage);
	$picNewW = round($picW / $picSizeRatio, 0);
	$picNewH = round($picH / $picSizeRatio, 0);
	$newImage = imagecreatetruecolor($picNewW, $picNewH);
	imagecopyresampled($newImage, $myTempImage, 0, 0, 0, 0, $picNewW, $picNewH, $picW, $picH);
	return $newImage;
}

function saveImage($myNewImage, $targetFile, $imageFileType){
	if($imageFileType == "jpeg" or $imageFileType == "jpg"){
		if(imagejpeg($myNewImage, $targetFile, 90)){
			$notice = "Vaähendatud pilt edukalt salvestatud!";
		} else {
			$notice = "Vähendatid pildi salvestamine ebaõnnestus!";
		}
		
	}
	if($imageFileType == "png"){
		if(imagepng($myNewImage, $targetFile, 6)){
			$notice = "Vaähendatud pilt edukalt salvestatud!";
		} else {
			$notice = "Vähendatid pildi salvestamine ebaõnnestus!";
		}
	}
	if($imageFileType == "gif"){
		if(imagepng($myNewImage, $targetFile)){
			$notice = "Vaähendatud pilt edukalt salvestatud!";
		} else {
			$notice = "Vähendatid pildi salvestamine ebaõnnestus!";
		}
	}
	return $notice;
}