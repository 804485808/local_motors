<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       $this->load->model('tagindex_model','tagindex');
    }

    public function header()
    {
        $this->load->library('encrypt');
        $username = $this->input->cookie('username', TRUE);
        $hash_1 = $this->input->cookie('hash_1', TRUE);
        $data['username'] = $this->encrypt->decode($username,$hash_1);
        $this->config->set_item("compress_output",TRUE);
        $this->load->helper('inflector');
        $site = $this->config->item("site");
        $data['site'] = $site;
        $data['title'] = "Motors for sale,motor suppliers,buy motors from the world&#39;s most professional online B2B motors marketplace-".$site['site_name'];
        $data['country'] = array("China","India","Japan","Malaysia","Thailand","Turkey","USA","Vietnam");
        //关键词封装
        $re_tagindex = $this->tagindex->getRoundTagindex();
        $data['keywords'] = $re_tagindex;

        return $data;
    }

    public function index()
    {
        $data = $this->header();
        $this->load->view('header',$data);
        $this->load->view('product/product');
        $this->load->view('footer');
    }
}