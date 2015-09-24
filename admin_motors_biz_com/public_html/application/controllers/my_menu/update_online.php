<?php if(!defined('BASEPATH')) exit('NO direct script access allowed');
class Update_online extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$content = file_get_contents("http://www.66fastener.com/version.txt");
		$find_version = explode(",", $content);
		$version = $find_version[0];
		$release = $find_version[1];
		
		$tmp_content = file_get_contents("./version.txt");
		$tmp_version = explode(",", $tmp_content);
		$this_version = $tmp_version[0];
		$this_release = $tmp_version[1];
		if ($this_version < $version){
			$action = trim($_GET['action']);
			$update_file = "./update_file/".$version.'/'.$release;
			switch ($action){
				case 'update':
					//(版本号和时间对等)
					$PHP_URL = @get_cfg_var("allow_url_fopen");
					if(!$PHP_URL) {
						$this->msg('当前服务器不支持URL打开文件，请修改php.ini中allow_url_fopen = on');
					}else {
						$this->msg('在线更新已经启动，开始下载更新...', '?action=download&release='.$release);
					}
				break;
				case 'download':
					//检查安全可行性
					$url = "http://www.66fastener.com/update/?release={$release}&version={$version}";
					$status = @file_get_contents($url);
					if($status) {
						if(substr($status, 0, 8) == 'UpdateON') {
							$status = substr($status, 8);
						} else {
							$msg = $status;
						}
					} else {
						$this->msg('无法连接服务器，请重试或稍后更新');
					}
					//dump($status);
					//下载文件,建立文件夹和文件
					if(!file_exists($update_file)){
						$this->mkdirs($update_file,0777);
					}
					if(!file_exists($update_file."/index.html")){
						copy("./update_file/index.html", $update_file."/index.html");
					}
					if (@copy($status,$update_file.'/'.$release.'.zip')){
						if(!file_exists($update_file.'/source/')){
							mkdir($update_file.'/source/',0777);
						}
						if(!file_exists($update_file.'/backup/')){
							mkdir($update_file.'/backup/',0777);
						}
						//$this->msg('下载文件,建立文件夹和文件成功...');
					}
					if(!file_exists($update_file.'/source/'."/index.html")){
						copy("./update_file/index.html", $update_file."/source/index.html");
					}
					if(!file_exists($update_file.'/backup/'."/index.html")){
						copy("./update_file/index.html", $update_file."/backup/index.html");
					}
					$this->msg('更新下载成功，开始解压缩..', '?action=unzip&release='.$release);
				break;
			
				case 'unzip':
					//解压文件
					$this->load->model('zip_model','zip');
					$this->zip->extract_zip($update_file.'/'.$release.'.zip', $update_file.'/source/');
					if(is_dir($update_file.'/source/application')) {
						$this->msg('更新解压缩成功，开始更新文件..', '?action=copy&release='.$release);
					} else {
						$this->msg('更新解压缩失败，请重试..');
					}
				break;
				case 'copy':
					//覆盖文件
					//$update_file = "./update_file/".$version.'/'.$release;
					if (is_dir($update_file.'/source/application')){
						$files = $this->file_list($update_file.'/source/application');
						foreach($files as $v) {
							$file_a = str_replace($update_file.'/source/', './', $v);
							$file_b = str_replace('source/application/', 'backup/', $v);
							if(is_file($file_a)) {
								$file_b_dir = explode("/", $file_b);
								array_pop($file_b_dir);
								$file_b_dir = implode("/", $file_b_dir);
								if ($this->mkdirs($file_b_dir)){
									copy($file_a,$file_b);
									copy("./version.txt", $update_file."/backup/version.txt");
								}else {
									$this->msg('无法备份文件至'.$file_b_dir.'，请重试..');
								}
								
							}
							if (!@copy($v, $file_a)) {
								$this->msg('无法覆盖'.$file_a.'<br/>请设置此文件及上级目录属性为可写，然后刷新此页');
							}
						}	
					}else {
						$this->msg('文件更新失败，请重试..');
					}
					if (is_file($update_file."/backup/version.txt")){
						$this->msg("文件更新成功，开始运行更新...",'?action=finish&release='.$release);
					}
				break;
				
				case 'finish':
					if (@copy($update_file.'/source/version.txt','./version.txt')){
						$this->msg("在线更新成功,当前版本 V{$version}",main_url(site_url('my_menu/main/index2')));
						unlink($update_file.'/'.$release.'.zip');
					}
				break;
				default:
					if ($this_version > $version){
						$this->msg("当前最新版本 V{$version},不需要运行此更新",main_url(site_url('my_menu/main/index2')));
					}
				break;	
			}
			//覆盖之后生成check_update.txt 内容为1,则更新成功(未定)
		}else {
			$this->msg("当前最新版本 V{$version},不需要运行此更新",main_url(site_url('my_menu/main/index2')));
		}
		$this->output->enable_profiler(TRUE);
	}

	function mkdirs($dir, $mode = 0777){
		if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
		if (!$this->mkdirs(dirname($dir), $mode)) return FALSE;
		return @mkdir($dir, $mode);
	}
	
	function msg($msg = "请求失败,请重试!", $forward = 'goback', $time = '1') {
		if(!$msg && $forward && $forward != 'goback') {
			header($forward);exit;
		}else {
			$data['msg'] = $msg;
			$data['forward'] = $forward;
			$data['time'] = $time;
			$this->load->view('public/msg',$data);
		}
	}
	//读取目录下的文件列表
	function file_list($dir,$fs = array()) {
		$files = glob($dir.'/*');
		if(!is_array($files)) return $fs;
		foreach($files as $file) {
			if(is_dir($file)) {
				$fs = $this->file_list($file, $fs);
			} else {
				$fs[] = $file;
			}
		}
		return $fs;
	}
	
}