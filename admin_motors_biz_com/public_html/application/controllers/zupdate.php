<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Zupdate extends CI_Controller{
	private $files;
	private $sites;
	function __construct(){
		parent::__construct();		
		$this->load->model('comm_model','comm');
		$this->load->library('session');
		$remoteip = $_SERVER['REMOTE_ADDR'];
		//echo $_GET['callback'] . "({'msg':'{$remoteip}' , 'status':'ok'});";
		if($remoteip!=='157.7.202.216'){
			show_404();
			die();
		}
		
		$this->save_path = './backup';
		$this->error = FALSE;
	}

	
	//下载压缩文件
	function getFile($url='',$save_dir=''){
		$filename=basename($url);
		$rs=array("msg"=>"","code"=>1);
		if(trim($url)==''){
			$rs=array("msg"=>"下载路径为空，请重试","code"=>0);
			return $rs;
		}
		if(trim($save_dir)==''){
			$save_dir='./';
		}
		if(0!==strrpos($save_dir,'/')){
			$save_dir.='/';
		}
		//创建保存目录
		if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
			$rs=array("msg"=>"创建下载文件的保存目录失败，请检查权限","code"=>0);
			return $rs;
		}
		//获取远程文件所采用的方法
		
		$ch=curl_init();
		$timeout=5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$content=curl_exec($ch);
		$size = curl_getinfo($ch,CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		curl_close($ch);
		
		if($size <= 0 || $size >= 2*1024*1024){
			$rs=array("msg"=>"下载的文件过小或者过大，可能有病毒，请核实","code"=>0);
			return $rs;
		}		

		$save_path = $save_dir.$filename;
		if(file_exists($save_path)){
			unlink($save_path);
		}
		
		
		$fp2=fopen($save_path,'w');
		fwrite($fp2,$content);
		fclose($fp2);
		
		if(!file_exists($save_path)){
			$rs=array("msg"=>"文件下载失败，请重试","code"=>0);
			return $rs;
		}
		$my_size = filesize($save_path);
		if($my_size != $size){
			$rs=array("msg"=>"下载压缩包大小与原文件有出入，有可能已被损坏，请重试","code"=>0);
			return $rs;
		}
		return array('file_name'=>$filename,'save_path'=>$save_path,"msg"=>"压缩文件下载成功","code"=>1);
	}
	
	
	
	//处理函数
	function deal(){
		$type = $this->uri->segment(3,0);
		if($type==1){
			$typename = "main";
		}elseif($type==2){
			$typename = "company";
		}elseif($type==3){
			$typename = "admin";
		}else {
			echo "网站类型错误";exit;
		}
		$master_version_file = "http://147.255.205.178/update/{$typename}/version.txt";
		$master_verlist_file = "http://147.255.205.178/update/{$typename}/verlist.txt";
		
		$download_path = $this->save_path."/download";
		$unzip_path = $this->save_path."/unzip";
		$bak_dir = $this->save_path."/bak";
			
		$version_file = $this->save_path."/version.txt";
		if(!file_exists($version_file)){
			echo $_GET['callback'] . "({'msg':'版本文件不存在，无法更新' , 'status':'error'});";
			die();
		}else{
			$handle = fopen($version_file,"rb");
			while (!feof($handle)){
				$cver.= strtolower(stream_get_line($handle, 65535, "\r\n"));
			}
			fclose($handle);
		}
		
		$ch=curl_init();
		$timeout=5;
		curl_setopt($ch,CURLOPT_URL,$master_version_file);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$mver=curl_exec($ch);
		curl_close($ch);
		$master_update = "http://147.255.205.178/update/{$typename}/".$mver.".zip";
		
		$ch=curl_init();
		$timeout=5;
		curl_setopt($ch,CURLOPT_URL,$master_verlist_file);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$verlist=curl_exec($ch);
		curl_close($ch);
		$verlist = str_replace(array("\r\n"),"\n",$verlist);
		$arr_verlist = array();
		$arr_verlist = explode("\n",$verlist);
		
		
		if($cver===$mver){
			echo $_GET['callback'] . "({'msg':'当前版本已是最新版本' , 'status':'error'});";
			log_message('error', 'update_error:当前版本已是最新版本.');
			die();
		}
		
		if(!in_array($cver,$arr_verlist)){
			echo $_GET['callback'] . "({'msg':'此版本号存在问题，请检查' , 'status':'error'});";
			log_message('error', 'update_error:此版本号存在问题，请检查.');
			die();
		}else{
			$cver_num = array_search($cver,$arr_verlist);
			$mver_num = array_search($mver,$arr_verlist);
			if(($cver_num - $mver_num)>1){
				echo $_GET['callback'] . "({'msg':'当前版本和最新版本相差多个版本，请手动更新' , 'status':'error'});";
				log_message('error', 'update_error:当前版本和最新版本相差多个版本，请手动更新.');
				die();
			}elseif(($cver_num - $mver_num)<0){
				echo $_GET['callback'] . "({'msg':'最新版本号列表文件出现问题，请查看verlist.txt' , 'status':'error'});";
				log_message('error', 'update_error:最新版本号列表文件出现问题，请查看verlist.txt.');
				die();
			}
		}
		
		
		$download_rs = $this->getFile($master_update,$download_path);
		if(!$download_rs['code']){
			echo $_GET['callback'] . "({'msg':'{$download_rs['msg']}' , 'status':'error'});";
			log_message('error', "update_error:{$download_rs['msg']}");
			die();
		}
		
		$md5_master = md5_file($master_update);
		$md5_client = md5_file($download_rs['save_path']);
		
		if($md5_master !== $md5_client){
			echo $_GET['callback'] . "({'msg':'下载的文件和原文件不一致，有可能被改动过' , 'status':'error'});";
			log_message('error', 'update_error:下载的文件和原文件不一致，有可能被改动过.');
			die();
		}
		
		$this->delFile($unzip_path);
		$this->load->library('Pclzip',array("zipfile"=>$download_rs['save_path']),"zip");
		
		$unzip_path = $unzip_path."/".$mver; 
		if($this->zip->extract(PCLZIP_OPT_PATH, $unzip_path) == 0){
			echo $_GET['callback'] . "({'msg':'解压失败,Error {$this->zip->errorInfo(true)}' , 'status':'error'});";
			log_message('error', "update_error:解压失败,Error {$this->zip->errorInfo(true)}");
			die();
		}
		
		$this->load->helper('directory');
		$files = directory_map($unzip_path);
		
		if(!file_exists($bak_dir)){
			mkdir($bak_dir);
		}
		
		if(file_exists($bak_dir."/".$cver)){
			echo $_GET['callback'] . "({'msg':'该版本的备份已经存在，请手动更新' , 'status':'error'});";
			log_message('error', 'update_error:该版本的备份已经存在，请手动更新');
			die();
		}
		$back_rs = $this->backup($files,$bak_dir."/".$cver,$cver);
		if(!$back_rs['code']){
			echo $_GET['callback'] . "({'msg':'{$back_rs['msg']}' , 'status':'error'});";
			log_message('error', "update_error:{$back_rs['msg']}");
			die();
		}
		
		
		//PCLZIP_OPT_REPLACE_NEWER 不管压缩文件更新日期是否比原有的新，都覆盖!
		if($this->zip->extract(PCLZIP_OPT_PATH, "./",PCLZIP_OPT_REPLACE_NEWER) == 0){
			echo $_GET['callback'] . "({'msg':'覆盖失败,Error {$this->zip->errorInfo(true)}' , 'status':'error'});";
			log_message('error', "update_error:覆盖失败,Error {$this->zip->errorInfo(true)}");
			die();
		}
		
		$handle = fopen($version_file,"w");
		if(fwrite($handle, $mver) === FALSE) {
			echo $_GET['callback'] . "({'msg':'更新版本文件失败' , 'status':'error'});";
			log_message('error', 'update_error:更新版本文件失败');
			die();
		}
		fclose($handle);
		
		echo $_GET['callback'] . "({'msg':'更新成功' , 'version':'{$mver}' , 'status':'ok'});";
		log_message('error', 'update_ok:更新成功');
	}
	
	
	function backup($files = array(),$bak_dir,$version){
		if(!isset($bak_dir)){
			$bak_dir = $this->save_path."/bak/".$version;
		}
		
		if(!file_exists($bak_dir)){
			mkdir($bak_dir);
		}
		
		foreach($files as $m => $f){
			if(is_array($f)){
				$tmpcat=$bak_dir."/".$m;
				$this->backup($f,$tmpcat,$version);
			}else{
				$base_path = str_replace($this->save_path."/bak/".$version."/", "./", $bak_dir);
				
				if(file_exists($base_path."/".$f)){
					if(!copy($base_path."/".$f,$bak_dir."/".$f)){
						$this->error = TRUE;
					}
				}else{
					if(!file_exists($base_path)){
						rmdir($bak_dir);
					}
				}
				
			}
		}
		if($this->error){
			return array("msg"=>'备份失败,请检查',"code"=>0);
		}else{
			return array("msg"=>'备份成功',"code"=>1);
		}
		
	}
	
		
	
	
	//删除目录下的所有文件
	function delFile($path = ""){		
		if(!file_exists($path)){
			return FALSE;
		}
		$handle = opendir($path);
		while($file = readdir($handle)){
			if($file != "." && $file != ".."){
				if(is_dir($path."/".$file)){
					$this->delFile($path."/".$file);
				}else if(is_file($path."/".$file)){
					unlink($path."/".$file);
				}
			}
		}
		closedir($handle);
		if(rmdir($path)) {
			return true;
		} else {
			return false;
		}
	}
	
	

}