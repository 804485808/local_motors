<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_biz extends CI_Controller {
	private $username;
	private $password;
	function __construct(){
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->load->model('comm_model','comm');
		$this->username = $this->input->cookie('username', TRUE);
		$this->password = $this->input->cookie('password', TRUE);
		$hash_1 = $this->input->cookie('hash_1', TRUE);	
		$hash_2 = $this->input->cookie('hash_2', TRUE);
		$this->username=$this->encrypt->decode($this->username,$hash_1);
		$this->password=$this->encrypt->decode($this->password,$hash_2);
 		if (!$this->username || !$this->password){
 			redirect(site_url("reg_login/login_in"));
		} elseif (!$rs=$this->comm->find('member',array("username"=>$this->username,"password"=>$this->password),'','userid,vmail,email')){
			redirect(site_url("reg_login/login_in"));
		}elseif (!$rs['vmail']){
			$data['email'] = $rs['email'];
			$str = $this->load->view('user/vmail_notice',$data,TRUE);
			echo $str;
			die();
		}
		
	}

	//信息
	public function show_info(){
		if($this->uri->rsegment(3,"") == 'need'){
			$data['msg'] = 'You need to fill detailed information and then you can post products';
		}else{
			$data['msg'] = '';
		}
		$site = $this->config->item('site');
		$data['site'] = $site;
		$data['title'] = "Information Of ".$this->username." On ".$site['site_name'];			
		//Firstname
		
		$this->load->config("linker");
		$linker = $this->config->item("linker");
		$this->config->set_item("linker",$linker);
		
		$result = $this->comm->linker()->find('member',array('username'=>$this->username),'','userid,areaid,passport,mobile,qq,ali,department,career,email,truename');
		
		$userid = $result['userid'];
		$truename = $result['truename'];		
		$truename = explode(" ", $truename);
		$data['gender'] = trim($truename[0]);
		if ($truename[0]){
			$data['first'] = $truename[1];
			$data['last'] = $truename[2];
			$data['firstname'] = $truename[0].' '.$truename[2];
		}else {
			$data['first'] = '';
			$data['last'] = '';
			$data['firstname'] = $this->username;
		}
			
		//Person Info
		$data['areaid'] = $areaid = $result['areaid'];
		$data['location_all'] = $this->comm->findAll('area','','areaid asc','areaid,areaname');
		$data['passport'] = $result['passport'];
		$data['email'] = $result['email'];
			
		$mobile = $result['mobile'];
		$mobile = explode("-", $mobile);
		if ($mobile[0]){
			$data['mobile_1'] = $mobile[0];
			$data['mobile_2'] = isset($mobile[1])?$mobile[1]:'';
		}else {
			$data['mobile_1'] = '';
			$data['mobile_2'] = '';
		}
		$data['qq'] = $result['qq'];
			
 		//dump($data['qq']);exit;
		$data['ali'] = $result['ali'];
		$data['department'] = $result['department'];
		$data['career'] = $result['career'];
			
		//Company Info
		$data['areaid_1'] = $areaid_1 = $result['mcompany']['areaid'];
		$data['location_all_1'] = $this->comm->findAll('area','','areaid asc','areaid,areaname');
		$data['company'] = $result['mcompany']['company'];
		$data['address'] = $result['mcompany']['address'];
		$telephone = $result['mcompany']['telephone'];
		$telephone = explode("-", $telephone);
		if ($telephone[0]){
			$data['telephone_1'] = $telephone[0];
			$data['telephone_2'] = $telephone[1];
			$data['telephone_3'] = $telephone[2];
		}else {
			$data['telephone_1'] = '';
			$data['telephone_2'] = '';
			$data['telephone_3'] = '';
		}
		$data['mail'] = $result['mcompany']['mail'];
		
		$data['thumb'] = trim($result['mcompany']['thumb']);
		$data['homepage'] = $result['mcompany']['homepage'];

		$data['content'] = $result['company_data']['content'];
		$data['username'] = $this->username;
		
		$this->load->view('user/header',$data);
		$this->load->view('user/show_info');
		$this->load->view('user/footer');		
	}
	
	//保存个人信息
	//wl_member.gender: 0->Mr.	1->Ms.
	public function saveinfo(){
		$this->config->load('uploader_settings', TRUE);
		$img_rootpath = $this->config->item('img_rootpath','uploader_settings');
		$img_path = $this->config->item('img_path','uploader_settings');
		$result = $this->comm->find('member',array('username'=>$this->username),'','userid,areaid,passport,mobile,qq,ali,department,career,email,truename,company');
		$userid = $result['userid'];
		$m_truename = $result['truename'];
		
		if ($_POST){
			$this->form_validation->set_rules('first', 'Frist name', 'trim|required|max_length[10]|xss_clean');
			$this->form_validation->set_rules('last', 'Last name', 'trim|required|max_length[30]|xss_clean');
			//$this->form_validation->set_rules('passport', 'Passport', 'trim|required|max_length[150]|xss_clean');
			$this->form_validation->set_rules('phone_1', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone_2', 'Phone', 'trim|required]|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[6]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|valid_email|xss_clean');
			$this->form_validation->set_rules('mail', 'Email', 'trim|required|max_length[50]|valid_email|xss_clean');
			$this->form_validation->set_rules('telephone_1', 'Telephone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('telephone_2', 'Telephone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('telephone_3', 'Telephone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company', 'Company Name', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('','');
			if ($this->form_validation->run() == FALSE){
				$message = validation_errors();
				$json = array("code"=>0,"message"=>$message);
				echo json_encode($json); 
				die();
			}else{

				$sql = array();
				$sql['gender'] = $user['gender']=strip_tags(trim($this->input->post('gender',TRUE)));
				$call=$user['gender']?"Ms. ":"Mr. ";
				$phone_1 = strip_tags(trim($this->input->post('phone_1',TRUE)));
				$phone_1 = $phone_1?$phone_1:"086";
	
				$sql_truename = $call.strip_tags(trim($this->input->post('first',TRUE)))." ".strip_tags(trim($this->input->post('last',TRUE)));
				
				$sql['truename'] = $sql_truename;
				$this->comm->findAll('area','','listorder desc','areaid,areaname');
				$sql['areaid'] = strip_tags(trim($this->input->post('location_1',TRUE)));
				$sql['passport'] = $this->username;
				//$sql['email'] = $email = strip_tags(trim($this->input->post('email',TRUE)));
				$sql['mobile'] = $phone_1.'-'.strip_tags(trim($this->input->post('phone_2',TRUE)));
				$sql['qq'] = strip_tags(trim($this->input->post('qq',TRUE)));
				$sql['ali'] = strip_tags(trim($this->input->post('ali',TRUE)));
				$sql['department'] = strip_tags(trim($this->input->post('department',TRUE)));
				$sql['career'] = strip_tags(trim($this->input->post('career',TRUE)));
				$company = trim($this->input->post('company',TRUE));
				$sql['company'] = $company;
				$sql['edittime'] = time();
				//company
				$telephone_1 = strip_tags(trim($this->input->post('telephone_1',TRUE)));
				$telephone_1 = $telephone_1?$telephone_1:"086";
				$telephone_2 = strip_tags(trim($this->input->post('telephone_2',TRUE)));
				$telephone_3 = strip_tags(trim($this->input->post('telephone_3',TRUE)));
				
				
				if($result['company']){
					$sql['company'] = $result['company'];
					$sql['mcompany']['company'] = $result['company'];
				}else{
					$sql['mcompany']['company'] = $company;
					$rs_2 = $this->comm->find('member',array("company"=>$company,"vmail"=>1));
					if($rs_2){
						$message = 'Company has exsit';
						$json = array("code"=>0,"message"=>$message);
						echo json_encode($json);
						die();
					}
				}
				
				
				$this->comm->findAll('area','','listorder desc','areaid,areaname');
				$sql['mcompany']['areaid'] = strip_tags(trim($this->input->post('location_2',TRUE)));
				$sql['mcompany']['address'] = strip_tags(trim($this->input->post('address',TRUE)));
				$sql['mcompany']['telephone'] = $telephone_1.'-'.$telephone_2.'-'.$telephone_3;
				//$sql['mcompany']['mail'] = $m_mail = strip_tags(trim($this->input->post('mail',TRUE)));
				
				$sql['mcompany']['thumb'] = $thumb = strip_tags(trim($this->input->post('path',TRUE)));
				$sql['company_data']['content'] = $content= strip_tags(trim($this->input->post('content',TRUE)));
				$sql['mcompany']['introduce'] = mb_substr($content, 0,250,'utf-8');
				//$rs_1 = $this->comm->findCount('company',"mail = '{$m_mail}' AND userid <> {$userid}");
				$this->load->config("linker");
				$linker = $this->config->item("linker");
				$this->config->set_item("linker",$linker);
				$res = $this->comm->linker()->update('member',array('userid'=>$userid),$sql);
				if ($res){
					if($thumb){
						$thumbpath = $img_rootpath.$img_path.$userid;
						$thumbext = substr($thumb,strrpos($thumb,"."));
						$newthumb = $img_path.$userid ."/".$this->username.$thumbext;
						
						if(!file_exists($thumbpath)){
							mkdir($thumbpath);
						}
						
						if(file_exists($img_rootpath.$thumb)){
							if(!file_exists($img_rootpath.$newthumb)){
								$rname = rename($img_rootpath.$thumb,$img_rootpath.$newthumb);
							}else{
								$newthumb = $img_path.$userid."/".$this->username."_".mt_rand(1,1000).$thumbext;
								$rname = rename($img_rootpath.$thumb,$img_rootpath.$newthumb);

							}
						}
						if($rname){
							$this->comm->update("company",array("userid"=>$userid),array("thumb"=>$newthumb));
						}
					}
					$result_count = $this->comm->findCount('sell',array('username'=>$this->username));
					if ($result_count){
						$this->comm->update('sell',array('username'=>$this->username),array('truename'=>$sql_truename));
					}
					$result_count_1 = $this->comm->findCount('friend',array('username'=>$this->username,'truename'=>$m_truename));	//检测用户是否改了好友备注名truename
					if ($result_count_1){
						$this->comm->update('friend',array('username'=>$this->username),array('truename'=>$sql_truename));
					}
					$message = 'Save successfully!';
					$json = array("code"=>1,"message"=>$message);
					echo json_encode($json); 
					die();
				}else {
					$message = 'Save failure,please try again!';
					$json = array("code"=>0,"message"=>$message);
					echo json_encode($json); 
					die();
				}
			}
		}
		
	}

	public function check_oldpwd(){
		if ($this->username){
		//检测原密码
			$this_oldpwd = $this->comm->find('member',array('username'=>$this->username),'userid desc','password');
			if ($this->input->post('oldpwd',TRUE)){
				$ajax_oldpwd = md5(trim(strip_tags($this->input->post('oldpwd',TRUE))));
				if ($ajax_oldpwd !='' && $this_oldpwd['password'] != $ajax_oldpwd){
					$output = 0;
				}else {
					$output = 1;
				}
				$this->output->set_output($output);
			}
		}
	}
	public function account(){
		$site = $this->config->item('site');
		$data['title'] = "Account Of ".$this->username." On ".$site['site_name'];
			$truename = $this->comm->find('member',array('username'=>$this->username),'userid desc','truename');
			$truename = explode(" ", $truename['truename']);
			array_pop($truename);
			$data['firstname'] = trim(implode(" ", $truename));
			if ($_POST){
				$this->form_validation->set_rules('oldpwd', 'Password', 'trim|required|min_length[6]|xss_clean');
				$this->form_validation->set_rules('newpwd', 'New Password', 'trim|required|min_length[6]|xss_clean');
				$this->form_validation->set_rules('repwd', 'Current Password', 'trim|required|min_length[6]|xss_clean');
				if ($this->form_validation->run()==FALSE){
					
				}else{
					$oldpwd = md5(strip_tags(trim($this->input->post('oldpwd',TRUE))));
					$old_num = $this->comm->findCount('member',array('password'=>$oldpwd,'username'=>$this->username));
					if ($old_num){
						$newpwd = md5(strip_tags(trim($this->input->post('newpwd',TRUE))));
						$repwd = md5(strip_tags(trim($this->input->post('repwd',TRUE))));
						if ($newpwd == $repwd){
							$result_1 = $this->comm->update('member',array('username'=>$this->username),array('password' => $repwd));
							$data['msg'] = "Save successfully!";
						}else {
							$data['msg'] = "Save failure!";
						}
					}else {
						$data['msg'] = "Save failure!";
					}
				}
			}
		$data['username'] = $this->username;
		$this->load->view('user/header',$data);
		$this->load->view('user/account');
		$this->load->view('user/footer');
	}
	
	//wl_validate.status:-1=>rejected,0=>being reviewed,1=>approved
	//wl_member.vcompany:-1=>rejected,0=>unapproved,1=>approved
	function vcompany(){
		$data['username'] = $username=$this->username;
		$temp=$this->comm->find("member",array("username"=>$username),"","company,vcompany");
		$data['company']=$temp['company']?$temp['company']:'';
		$data['site'] = $site = $this->config->item('site');
		$data['title'] = "Authentication Of ".$username." On ".$site['site_name'];
		$validate=$this->comm->find("validate",array("type"=>"company","username"=>$username),"","title,status");
		if ($temp['vcompany']==1 && $validate){
			$validate['status']='approved';
		}elseif ($temp['vcompany']==-1 && $validate){
			$validate['status']='rejected';
		}else{
			if ($validate){
				if ($validate['status']==0){
					$validate['status']='being reviewed';
				}							
			}else{
				$validate=array('title'=>$data['company'],'status'=>'unapproved');
			}
		}
		$data['validate']=$validate;
		$this->load->view('user/header',$data);
		$this->load->view('user/vcompany');
		$this->load->view('user/footer');
	}
	
	function save_vcompany(){
		$temp=$this->comm->find("member",array("username"=>$this->username),"","vcompany");
		$temp_1=$this->comm->find("validate",array("type"=>'company',"username"=>$this->username),"","status");
		if ($temp['vcompany']==1){
			$json = array("code"=>0,'message'=>"You have been passed the company authentication");
			echo json_encode($json);
			exit;
		}elseif($temp_1){
			if($temp['vcompany']==0 && $temp_1['status']==0){
				$json = array("code"=>0,'message'=>"You have submitted the company certificates");
				echo json_encode($json);
				exit;
			}
		}
		$title=$this->input->post('title',TRUE);
		$thumb=$this->input->post('path',TRUE) ? "/".$this->input->post('path',TRUE) : "";
		$thumb1=$this->input->post('path_1',TRUE) ? "/".$this->input->post('path_1',TRUE) : "";
		$thumb2=$this->input->post('path_2',TRUE) ? "/".$this->input->post('path_2',TRUE) : "";
		$validate=array(
				'title'=>$title,
				'type'=>'company',
				'thumb'=>$thumb,
				'thumb1'=>$thumb1,
				'thumb2'=>$thumb2,
				'username'=>$this->username,
				'addtime'=>time(),
				'edittime'=>time(),
				'ip'=>$this->input->ip_address()
		);
		$itemid=$this->comm->create("validate",$validate);
		if ($itemid){
			$this->comm->update("member",array("username"=>$this->username),array("vcompany"=>0));
			$this->comm->delete("validate","type = 'company' and username = '{$this->username}' and itemid <> {$itemid}");
			$json = array("code"=>1,'message'=>"Submit certificates successfully");
			echo json_encode($json);
		}else{
			$json = array("code"=>0,'message'=>"Submit certificates failed,please try again");
			echo json_encode($json);
		}
	}
}