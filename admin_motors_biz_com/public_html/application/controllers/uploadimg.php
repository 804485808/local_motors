<?php
class Uploadimg extends CI_Controller{
    function index(){
        $this->load->model('comm_model','comm');
        $this->load->helper('directory');
        $this->config->load('uploader_settings', TRUE);
        $this->load->library('session');
        $this->username = $this->session->userdata('username');
        $this->password = $this->session->userdata('password');
        if (!$this->username || !$this->password){
            redirect(site_url("reg_login/login"));
        } elseif (!$rs=$this->comm->findCount("member", array("username"=>$this->username,"password"=>$this->password))){
            redirect(site_url("reg_login/login"));
        }
        $userid = $rs['userid'];
        $type = $this->uri->rsegment(3,0);

        $img_rootpath = $this->config->item('img_rootpath','uploader_settings');
        $upload_path = $img_rootpath.'/upload/tmp/'.$userid;

        if(!file_exists($upload_path)){
            mkdir($upload_path);
        }

        $pic_total = directory_map($upload_path, 1);
        $pic_count = count($pic_total);
        if($pic_count>100){
            echo '{"code":0,"message":"Upload pictures more than 100"}';
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

        if($type == 'sell'){
            echo '{"code":1,"src":"'.$filename.'"}';
        }
        if ($type == 'thumb'){
            $fid = $this->input->post('fid',TRUE);
            $pr = 'parent.document.getElementById';
            $js = '<script type="text/javascript">';
            $js .= 'try{'.$pr.'("d'.$fid.'").src="'.$filename.'";}catch(e){}';
            $js .= $pr.'("'.$fid.'").value="'.$filename.'";';
            $js .= 'window.parent.cDialog();';
            $js .='</script>';
            echo $js;
        }
    }

    function del_img(){
        $path=$this->input->post('path',TRUE);
        $this->config->load('uploader_settings', TRUE);
        $img_rootpath = $this->config->item('img_rootpath','uploader_settings');
        $upload_path = $img_rootpath.$path;
        if (is_file($upload_path)){
            unlink($upload_path);
        }
    }
}