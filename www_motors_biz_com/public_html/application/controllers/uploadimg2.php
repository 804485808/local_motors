<?php
class Uploadimg extends CI_Controller{
	function index(){
		$this->load->library('encrypt');		
		$this->load->model('comm_model','comm');
		$this->load->helper('directory');
		$this->config->load('uploader_settings', TRUE);
		// 使用post获取 为了兼容swfupload
		$this->username = $this->input->post('username', TRUE);
		$this->password = $this->input->post('password', TRUE);
		$hash_1 = $this->input->post('hash_1', TRUE);
		$hash_2 = $this->input->post('hash_2', TRUE);
		$this->username=$this->encrypt->decode($this->username,$hash_1);
		$this->password=$this->encrypt->decode($this->password,$hash_2);
 		if (!$this->username || !$this->password){
			header("Location:".site_url("reg_login/login_in"));
			die();
		} elseif (!$rs=$this->comm->find("member", array("username"=>$this->username,"password"=>$this->password))){
			header("Location:".site_url("reg_login/login_in"));
			die();
		}  
		$userid = $rs['userid'];
		$type = $this->uri->rsegment(3,0);
		if($type == 'sell'){
			$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
			$upload_path = $img_rootpath.'/upload/product_img/'.$userid;
			
			if(!file_exists($upload_path)){
				$this->mkdirs($upload_path);
			}

			$pic_upload_path = $img_rootpath.'/upload/product_img/'.$userid;
			if(!file_exists($pic_upload_path)){
				$this->mkdirs($pic_upload_path);
			}
			$pic_total_1 = directory_map($pic_upload_path, 1);
			$pic_count_1 = count($pic_total_1);
			if($pic_count_1>100){
				$err = array("code"=>0,"message"=>"Upload pictures more than 100");
				$err = json_encode($err);
				echo $err;
				die();
			}
			
			$config['upload_path'] = $upload_path;
			$config['max_size'] = $this->config->item('max_size','uploader_settings');
			$config['allowed_types'] = $this->config->item('allowed_types',	'uploader_settings');
			$config['encrypt_name']	= $this->config->item('encrypt_name','uploader_settings');
			$this->load->library('upload', $config);
			
			
			$this->upload->do_upload('cover_upload');
			
			$imgdata = $this->upload->data();
			
			$filename = str_replace($img_rootpath,"",$imgdata['full_path']);
			
			echo '{"code":1,"src":"'.$filename.'"}';
			
		}
	}
	
	function mkdirs($dir, $mode = 0777){
		if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
		if (!$this->mkdirs(dirname($dir), $mode)) return FALSE;
		return @mkdir($dir, $mode);
	}
}