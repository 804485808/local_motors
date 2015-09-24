<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Setting extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->config->load('uploader_settings', TRUE);
		$site_file = $this->config->item('site_file','uploader_settings');
		define("ROOT_PATH", "D:/wamp/www/{$site_file}/application/config/");
		define("MY_PATH", "D:/wamp/www/{$site_file}/application/config/");
	}

	function base_set(){
		$data['site']=$site = $this->config->item('site');
		$data['img_rootpath'] = $this->config->item('img_rootpath','uploader_settings');
		$data['site_file'] = $this->config->item('site_file','uploader_settings');
		$data['admin_site_file'] = $this->config->item('admin_site_file','uploader_settings');
		$data['max_size'] = $this->config->item('max_size','uploader_settings');
		$data['max_width'] = $this->config->item('max_width','uploader_settings');
		$data['max_height'] = $this->config->item('max_height','uploader_settings');
		$data['url_suffix']=$this->config->item("url_suffix");	
		$data['language']=$this->config->item("language");
		$this->load->view('my_menu/setting/base_set',$data);
	}
	
	function mail(){
		$this->load->config("email");
		$data['email']=$email = $this->config->item('email');
		$data['charset']=array("iso-8859-1","utf-8","gb2312","gbk","gb18030");
		$this->load->view('my_menu/setting/mail',$data);
	}
	
	function save_setting(){
		$act=$this->input->post("act",TRUE);
		if ($act=="set_site"){
			$setting=$this->input->post("site",TRUE);	
			$site="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\r\n";
			$site.="\$config['site']['site_name'] = '".$setting['site_name']."';\r\n";
			$site.="\$config['site']['main_domain'] = '".$setting['main_domain']."';\r\n";
			$site.="\$config['site']['sell_domain'] = '".$setting['sell_domain']."';\r\n";
			$site.="\$config['site']['company_domain'] = '".$setting['company_domain']."';\r\n";
			$site.="\$config['site']['sphinx_host'] = '".$setting['sphinx_host']."';\r\n";
			$site.="\$config['site']['image_domain'] = '".$setting['image_domain']."';\r\n";
			$site.="\$config['site']['linkman'] = '".$setting['linkman']."';\r\n";
			$site.="\$config['site']['tel'] = '".$setting['tel']."';\r\n";
			$site.="\$config['site']['email'] = '".$setting['email']."';\r\n";
			$site.="\$config['site']['qq'] = '".$setting['qq']."';\r\n";
			$site.="\$config['site']['icpno'] = '".$setting['icpno']."';\r\n";
			file_put_contents(ROOT_PATH.'site.php', $site);	
			file_put_contents(MY_PATH.'site.php', $site);
			if ($site==file_get_contents(MY_PATH.'site.php') && $site==file_get_contents(ROOT_PATH.'site.php')){
				$msg="设置成功";
			}else{
				$msg="设置失败，请重试";
			}
		}elseif ($act=="set_email"){
			$setting=$this->input->post("email",TRUE);
			$email="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\r\n";
			$email.="\$config['email']['protocol'] = '".$setting['protocol']."';\r\n";
			$email.="\$config['email']['smtp_host'] = '".$setting['smtp_host']."';\r\n";
			$email.="\$config['email']['smtp_port'] = '".$setting['smtp_port']."';\r\n";
			$email.="\$config['email']['mailtype'] = '".$setting['mailtype']."';\r\n";
			$email.="\$config['email']['newline'] = '".$setting['newline']."';\r\n";
			$email.="\$config['email']['crlf'] = '".$setting['newline']."';\r\n";
			$email.="\$config['email']['charset'] = '".$setting['charset']."';\r\n";
			$email.="\$config['email']['smtp_timeout'] = '".$setting['smtp_timeout']."';\r\n";
			$email.="\$config['email']['wordwrap'] = ".$setting['wordwrap'].";\r\n";
			$email.="\$config['email']['smtp_user'] = '".$setting['smtp_user']."';\r\n";
			$email.="\$config['email']['smtp_pass'] = '".$setting['smtp_pass']."';\r\n";
			file_put_contents(ROOT_PATH.'email.php', $email);
			file_put_contents(MY_PATH.'email.php', $email);
			if ($email==file_get_contents(MY_PATH.'email.php') && $email==file_get_contents(ROOT_PATH.'email.php')){
				$msg="设置成功";
			}else{
				$msg="设置失败，请重试";
			}
		}elseif ($act=="set_others"){
			$setting=$this->input->post("config",TRUE);
			
			$url_suffix=$setting['url_suffix'];
			$patten_1="config\['url_suffix'\][A-Za-z0-9\.\_\-= 	']*\;";
			$to_1="config['url_suffix'] = '".$url_suffix."';";
			
			$language=$setting['language'];
			$patten_2="config\['language'\][A-Za-z0-9\.\_\-= 	']*\;";			
			$to_2="config['language'] = '".$language."';";
			
			$str=file_get_contents(ROOT_PATH.'config.php');
			
			$str=preg_replace("/$patten_1/i", $to_1, $str);
			$str=preg_replace("/$patten_2/i", $to_2, $str);
			file_put_contents(ROOT_PATH.'config.php', $str);
			$msg="设置成功";
			//if ($i){
			//	$msg="设置成功";
		//	}else{
		//		$msg="设置失败，请重试";
		//	}
			
		}elseif ($act=="set_image"){						
			$image=$this->input->post("image",TRUE);

			$img_rootpath=$image['img_rootpath'];
			$patten_1="config\['img_rootpath'\]['A-Za-z0-9= 	\\\.\_:\-\/]*\;";
			$to_1="config['img_rootpath'] = '".$img_rootpath."';";
			
			$max_size=$image['max_size'];
			$patten_2="config\['max_size'\][A-Za-z0-9\.\_\-= 	']*\;";
			$to_2="config['max_size'] = '".$max_size."';";
			
			$max_width=$image['max_width'];
			$patten_3="config\['max_width'\][A-Za-z0-9\.\_\-= 	']*\;";
			$to_3="config['max_width'] = '".$max_width."';";
			
			$max_height=$image['max_height'];
			$patten_4="config\['max_height'\][A-Za-z0-9\.\_\-= 	']*\;";
			$to_4="config['max_height'] = '".$max_height."';";
			
			$str=file_get_contents(ROOT_PATH.'uploader_settings.php');
			
			$str=preg_replace("/$patten_1/i", $to_1, $str);
			$str=preg_replace("/$patten_2/i", $to_2, $str);
			$str=preg_replace("/$patten_3/i", $to_3, $str);
			$str=preg_replace("/$patten_4/i", $to_4, $str);
			file_put_contents(ROOT_PATH.'uploader_settings.php', $str);
			$msg="设置成功";
		}	
		
		$data['msg']=$msg;
		$url = $this->load->view('public/success',$data);
	}
}