<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller {
	
	/* Constructor */
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('jbimages','language'));
		
		// is_allowed is a helper function which is supposed to return False if upload operation is forbidden
		// [See jbimages/is_alllowed.php] 
		
		if (is_allowed() === FALSE)
		{
			exit;
		}
		
		// User configured settings
		$this->config->load('uploader_settings', TRUE);
		$this->load->library('encrypt');		
		$this->load->model('comm_model','comm');
		$this->load->helper('directory');
		$this->username = $this->input->cookie('username', TRUE);
		$this->password = $this->input->cookie('password', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);
		$hash_2 = $this->input->cookie('hash_2', TRUE);
		$this->username=$this->encrypt->decode($this->username,$hash_1);
		$this->password=$this->encrypt->decode($this->password,$hash_2);
 		if (!$this->username || !$this->password){
			header("Location:".site_url("reg_login/login_in"));
			die();
		} elseif (!$rs=$this->comm->find("member", array("username"=>$this->username,"password"=>$this->password))){
			header("Location:".site_url("reg_login/login_in"));
			die();
		}
		$this->userid = $rs['userid'];
	}
	
	/* Language set */
	
	private function _lang_set($lang)
	{
		// We accept any language set as lang_id in **_dlg.js
		// Therefore an error will occur if language file doesn't exist
		
		$this->config->set_item('language', $lang);
		$this->lang->load('jbstrings', $lang);
	}
	
	/* Default upload routine */
		
	public function upload ($lang='english')
	{
		// Set language
		$this->_lang_set($lang);
		$site = $this->config->item("site");
		
		// Get configuartion data (we fill up 2 arrays - $config and $conf)
		
		$conf['img_path']			= $this->config->item('img_path',		'uploader_settings');
		$conf['allow_resize']		= $this->config->item('allow_resize',	'uploader_settings');
		
		$config['allowed_types']	= $this->config->item('allowed_types',	'uploader_settings');
		$config['max_size']			= $this->config->item('max_size',		'uploader_settings');
		$config['encrypt_name']		= $this->config->item('encrypt_name',	'uploader_settings');
		$config['overwrite']		= $this->config->item('overwrite',		'uploader_settings');
		$config['upload_path']		= $this->config->item('upload_path',	'uploader_settings');
		
		if (!$conf['allow_resize'])
		{
			$config['max_width']	= $this->config->item('max_width',		'uploader_settings');
			$config['max_height']	= $this->config->item('max_height',		'uploader_settings');
		}
		else
		{
			$conf['max_width']		= $this->config->item('max_width',		'uploader_settings');
			$conf['max_height']		= $this->config->item('max_height',		'uploader_settings');
			
			if ($conf['max_width'] == 0 and $conf['max_height'] == 0)
			{
				$conf['allow_resize'] = FALSE;
			}
		}
		
		$config['upload_path'] = $config['upload_path'].$this->userid;
		
		if(!file_exists($config['upload_path'])){
			$this->mkdirs($config['upload_path']);
		}
			
		$pic_total = directory_map($config['upload_path'], 1);
		$pic_count = count($pic_total);
		if($pic_count>1000){
			$result['result']		= "Upload pictures more than 1000";
			$result['resultcode']	= 'failed';
		
			// Output to user
			echo $this->load->view('tiny_mce/ajax_upload_result', $result,TRUE);
			die();
		}
		
		// Load uploader
		$this->load->library('upload', $config);
		if ($this->upload->do_upload()) // Success
		{
			// General result data
			$result = $this->upload->data();
			// Shall we resize an image?
// 			if ($conf['allow_resize'] and $conf['max_width'] > 0 and $conf['max_height'] > 0 and (($result['image_width'] > $conf['max_width']) or ($result['image_height'] > $conf['max_height'])))
// 			{		
// 				// Resizing parameters
// 				$resizeParams = array
// 				(
// 					'source_image'	=> $result['full_path'],
// 					'new_image'		=> $result['full_path'],
// 					'width'			=> $conf['max_width'],
// 					'height'		=> $conf['max_height']
// 				);
				
// 				// Load resize library
// 				$this->load->library('image_lib', $resizeParams);
// 				// Do resize
// 				$this->image_lib->resize();
// 			}
			
			// Add our stuff
			$limit_witdh = 660;
			if ($result['image_width']>$limit_witdh){
				$image = $this->load($result['full_path']);
				$limit_height = $this->resizeToWidth($limit_witdh,$image);
				$result['limit_witdh']	= $limit_witdh;
				$result['limit_height']	= (int)$limit_height;
			}else{
				$result['limit_witdh']	= "";
				$result['limit_height']	= "";
			}
			$result['result']		= "file_uploaded";
			$result['resultcode']	= 'ok';
			$result['file_name']	= $site['image_domain']."/".$conf['img_path'].$this->userid .'/' . $result['file_name'];
			
			$this->load->library('image_lib');
			$config1['source_image'] = $result['full_path'];
			$config1['wm_type'] = 'overlay';
			$config1['wm_overlay_path'] = FCPATH."skin/cover.png";
			$config1['quality'] = 100;
			$config1['wm_opacity'] = 100;
			$config1['wm_vrt_alignment'] = 'bottom';
			$config1['wm_hor_alignment'] = 'center';
			$this->image_lib->initialize($config1);
			$this->image_lib->watermark();
			// Output to user
			$this->load->view('tiny_mce/ajax_upload_result', $result);
		}
		else // Failure
		{
			// Compile data for output
			$result['result']		= $this->upload->display_errors(' ', ' ');
			$result['resultcode']	= 'failed';
			// Output to user
			$this->load->view('tiny_mce/ajax_upload_result', $result);
		}
	}
	
	function resizeToWidth($width,$image) {
		$ratio = $width / imagesx($image);
		$height = imagesy($image) * $ratio;
		return $height;
	}
	
	function load($filename) {
		$image_info = getimagesize($filename);
		$image_type = $image_info[2];
		if( $image_type == IMAGETYPE_JPEG ) {
			$image = imagecreatefromjpeg($filename);
		} elseif( $image_type == IMAGETYPE_GIF ) {
			$image = imagecreatefromgif($filename);
		} elseif( $image_type == IMAGETYPE_PNG ) {
			$image = imagecreatefrompng($filename);
		}
		return $image;
	}
	
	/* Blank Page (default source for iframe) */
	
	public function blank($lang='english')
	{
		$this->_lang_set($lang);
		$this->load->view('tiny_mce/blank');
	}
	
	public function index($lang='english')
	{
		$this->blank($lang);
	}
	
	function mkdirs($dir, $mode = 0777){
		if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
		if (!$this->mkdirs(dirname($dir), $mode)) return FALSE;
		return @mkdir($dir, $mode);
	}
}

/* End of file uploader.php */
/* Location: ./application/controllers/uploader.php */
