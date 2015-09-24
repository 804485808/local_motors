<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imgcode extends CI_Controller{
	public function index(){	
		header("content-type:image/gif");
		$this->load->library('session');
		$width=60;
		$height=30;
		$img=imagecreatetruecolor($width,$height);
		$white=imagecolorallocate($img,255,255,255);
		$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		$str="123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$code="";
		for ($i=0;$i<5;$i++){
			$code.=$str[rand(0,strlen($str)-1)];
		}
		$this->session->set_userdata(array('myCode'=>strtolower($code)));
		imagefilledrectangle($img,0,0,60,30,$color);
		for ($i=0;$i<100;$i++){
			imagesetpixel($img,rand(0,60),rand(0,30),imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)));
		}
		for($i=0;$i<10;$i++){
			imageline($img,rand(0,60),rand(0,30),rand(0,60),rand(0,30),imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)));
		}
		imagestring($img,5,10,5,$code,$white);
		return imagegif($img);
		//imagedestroy($img); 
	}
}