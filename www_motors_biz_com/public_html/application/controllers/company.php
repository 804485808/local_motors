<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('comm_model','comm');
		$this->load->helper('inflector');

	}


	//com_home
	public function index(){
		$site = $this->config->item("site");
		$data['site'] = $site;

		$thisurl = current_url();
		if(preg_match("/http:\/\/(.*)\./isU",$thisurl,$arr)){
			$username = $arr[1];
		}else{
			show_404();
			die();
		}

		$userid=$this->comm->find("company",array("username"=>$username),"","userid");
		if(!$userid){
			show_404();
			die();
		}
		$userid=$userid['userid'];
		$data['username'] = $username;

		$kwtable=$this->db->dbprefix("tagindex");
		$sql="SELECT t1.id,t1.tag,t1.linkurl";
		$sql.=" FROM `{$kwtable}` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `{$kwtable}`)-(SELECT MIN(id) FROM `{$kwtable}`))+(SELECT MIN(id) FROM `{$kwtable}`)) AS id) AS t2";
		$sql.=" WHERE t1.id >= t2.id LIMIT 0,5";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data['keywords'] = $query->result_array();
		}else {
			$data['keywords'] = $this->comm->findAll("tagindex","","","","0,5");
		}

		$company_data = $this->comm->find("company",array("userid"=>$userid));
		$area=$this->comm->find("area",array("areaid"=>$company_data['areaid']),"","areaname");
		$company_data['areaname']=$area['areaname'];
		$data['company_data'] = $company_data;

		$btype=explode(",",$company_data['business']);
		$two_btype=array_shift($btype).",".array_shift($btype);
		$data['title'] = $company_data['company']." - ".$two_btype;

		$com_type=$this->comm->findAll("type",array("userid"=>$userid));
		$data['com_type'] = $com_type;

		$data['main_sell']=$this->comm->findAll("sell",array("elite"=>1,"username"=>$company_data['username']),"","itemid,title,linkurl,thumb,minamount,unit,username","0,6");
		$data['main_sell']=array_chunk($data['main_sell'],3);
		if($com_type){
			$rand_id=array_rand($com_type,1);
			$rand_id=0;
			$data['rand_type'] = $com_type[$rand_id]['tname'];
			$data['rand_sell']=$this->comm->findAll("sell",array("mycatid"=>$com_type[$rand_id]['tid'],"username"=>$company_data['username']),"","","0,4");
		}
		$this->load->view('header',$data);
		$this->load->view('company/com_home');
		$this->load->view('footer');
	}

	function sell_list(){
		//for test
		//$username='sxftcl14';

		$thisurl = current_url();
		if(preg_match("/http:\/\/(.*)\./isU",$thisurl,$arr)){
			$username = $arr[1];
		}else{
			show_404();
			die();
		}

		$company_data = $this->comm->find("company",array("username"=>$username));
		if(!$company_data){
			show_404();
			die();
		}
		$data['username'] = $username;
		$site = $this->config->item("site");
		$data['site'] = $site;

		$kwtable=$this->db->dbprefix("tagindex");
		$sql="SELECT t1.id,t1.tag,t1.linkurl";
		$sql.=" FROM `{$kwtable}` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `{$kwtable}`)-(SELECT MIN(id) FROM `{$kwtable}`))+(SELECT MIN(id) FROM `{$kwtable}`)) AS id) AS t2";
		$sql.=" WHERE t1.id >= t2.id LIMIT 0,5";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data['keywords'] = $query->result_array();
		}else {
			$data['keywords'] = $this->comm->findAll("tagindex","","","","0,5");
		}

		$userid=$company_data['userid'];

		$company_data = $this->comm->find("company",array("userid"=>$userid));
		$area=$this->comm->find("area",array("areaid"=>$company_data['areaid']),"","areaname");
		$company_data['areaname']=$area['areaname'];
		$data['company_data'] = $company_data;

		$com_type=$this->comm->findAll("type",array("userid"=>$userid));

		$btype=array();
		foreach($com_type as $x=>$c){
			if($x <= 2){
				$btype[]=$c['tname'];
			}

			$com_type[$x]['count']=$this->comm->findCount("sell",array("mycatid"=>$c['tid'],"username"=>$username));
		}
		$data['com_type'] = $com_type;
		$btype=join(",",$btype);

		$page = $this->uri->rsegment(3,0);
		$page_size=10;
		$uri_segment = 2;
		$base_url = company_url(site_url("company/".__FUNCTION__."/"),$username);
		$condition=array("username"=>$username,"status"=>3);
		$data['title']=$btype." from ".$company_data['company']." On ".$site['site_name']." | Page ".ceil($page/$page_size+1);
		if (preg_match("/^[a-zA-Z]{1,}_[0-9]{1,}$/isU",$page)) {
			$tid = explode("_",$page);
			$tid = intval($tid[1]);
			$uri_segment = 3;
			$base_url = company_url(site_url("company/".__FUNCTION__."/".$page),$username);
			$page = $this->uri->rsegment(4,0);
			$condition=array("username"=>$username,"mycatid"=>$tid,"status"=>3);
			$data['mytype'] = $mytype=$this->comm->find("type",array("tid"=>$tid,"userid"=>$userid));
			if(!$mytype){
				show_404();
				die();
			}
			$data['title']=$mytype['tname']." from ".$company_data['company']." On ".$site['site_name']." | Page ".ceil($page/$page_size+1);
		}
		$page = intval($page);

		if(ceil($page/$page_size+1) > 1){
			$data['link'] = "<link rel='canonical' href='".site_url("company/sell_list/{$username}")."'/>";
		}

		$sell_list=$this->comm->findAll("sell",$condition,"","itemid,title,unit,minprice,keyword,hits,currency,minamount,thumb,username,linkurl","{$page},{$page_size}");

		$data['sell_list']=$sell_list;
		$data['sell_count'] = $sell_count=$this->comm->findCount("sell",$condition);

		$data['total_page']=ceil($sell_count/$page_size);
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $sell_count;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = $uri_segment;
		$config['num_links'] = 8;
		$config['suffix'] = $this->config->item('url_suffix');
		$config['anchor_class'] = "rel='nofollow'";
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$data['pages'] = $pages = $this->pagination->create_links();


		$data['hot_sell']=$this->comm->findAll("sell",array("username"=>$company_data['username']),"hits desc","itemid,title,currency,minprice,hits,linkurl,thumb,minamount,unit","0,4");

		/*$rand_id=array_rand($com_type,1);
		$rand_id=0;
		$data['rand_type'] = $com_type[$rand_id]['tname'];
		$data['rand_sell']=$this->comm->findAll("sell",array("mycatid"=>$com_type[$rand_id]['tid'],"username"=>$company_data['username']),"","","0,4");*/

		$this->load->view('header',$data);
		$this->load->view('company/com_sell_list');
		$this->load->view('footer');
	}



	//company info
	public function info(){
		$site = $this->config->item("site");
		$data['site'] = $site;

		$thisurl = current_url();
		if(preg_match("/http:\/\/(.*)\./isU",$thisurl,$arr)){
			$username = $arr[1];
		}else{
			show_404();
			die();
		}

		$userid=$this->comm->find("company",array("username"=>$username),"","userid");
		if(!$userid){
			show_404();
			die();
		}
		$userid=$userid['userid'];
		$data['username'] = $username;

		$kwtable=$this->db->dbprefix("tagindex");
		$sql="SELECT t1.id,t1.tag,t1.linkurl";
		$sql.=" FROM `{$kwtable}` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `{$kwtable}`)-(SELECT MIN(id) FROM `{$kwtable}`))+(SELECT MIN(id) FROM `{$kwtable}`)) AS id) AS t2";
		$sql.=" WHERE t1.id >= t2.id LIMIT 0,5";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data['keywords'] = $query->result_array();
		}else {
			$data['keywords'] = $this->comm->findAll("tagindex","","","","0,5");
		}

		$company_data = $this->comm->find("company",array("userid"=>$userid));
		$area=$this->comm->find("area",array("areaid"=>$company_data['areaid']),"","areaname");
		$company_data['areaname']=$area['areaname'];
		$com_content=$this->comm->find("company_data",array("userid"=>$userid));
		$company_data['content'] = $com_content['content'];
		$data['company_data'] = $company_data;
		//dump($company_data);

		$btype=explode(",",$company_data['business']);
		$two_btype=array_shift($btype).",".array_shift($btype);
		$data['title'] = "Company Information - ".$company_data['company']." - ".$two_btype;

		$com_type=$this->comm->findAll("type",array("userid"=>$userid));
		$data['com_type'] = $com_type;

		$this->load->view('header',$data);
		$this->load->view('company/com_info');
		$this->load->view('footer');
	}


	//company contact
	public function contact(){
		$site = $this->config->item("site");
		$data['site'] = $site;

		$thisurl = current_url();
		if(preg_match("/http:\/\/(.*)\./isU",$thisurl,$arr)){
			$username = $arr[1];
		}else{
			show_404();
			die();
		}
		$userid=$this->comm->find("company",array("username"=>$username),"","userid");
		if(!$userid){
			show_404();
			die();
		}
		$userid=$userid['userid'];
		$data['username'] = $username;

		$kwtable=$this->db->dbprefix("tagindex");
		$sql="SELECT t1.id,t1.tag,t1.linkurl";
		$sql.=" FROM `{$kwtable}` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `{$kwtable}`)-(SELECT MIN(id) FROM `{$kwtable}`))+(SELECT MIN(id) FROM `{$kwtable}`)) AS id) AS t2";
		$sql.=" WHERE t1.id >= t2.id LIMIT 0,5";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data['keywords'] = $query->result_array();
		}else {
			$data['keywords'] = $this->comm->findAll("tagindex","","","","0,5");
		}

		$company_data = $this->comm->find("company",array("userid"=>$userid));
		$area=$this->comm->find("area",array("areaid"=>$company_data['areaid']),"","areaname");
		$company_data['areaname']=$area['areaname'];
		$data['company_data'] = $company_data;
		//dump($company_data);

		$contact=$this->comm->find("member",array("userid"=>$userid),"","truename,department,career");
		$data['contact'] = $contact;

		$data['title'] = "Company Contact For ".$company_data['company']." On ".$site['site_name'];

		$com_type=$this->comm->findAll("type",array("userid"=>$userid));
		$data['com_type'] = $com_type;

		$this->load->view('header',$data);
		$this->load->view('company/com_contact');
		$this->load->view('footer');
	}

    //供应商
    public function suppliers(){
        $site = $this->config->item("site");
        $data['site'] = $site;
        $url_name = $this->uri->rsegment(3,0);
        $url = $this->uri->rsegment(1,0);
        $data['url'] = $url;
        $tid = explode("_", $url_name);
        if(empty($url_name))
        {
            $tid[0] = "Category";
        }
        //分页
        if(empty($tid[2]))
        {
            $page_size = $tid[2] =30;
        }
        else
        {
            $page_size = $tid[2];
        }
        $page = $this->uri->rsegment(4,0);
        $data['page'] = $page = intval($page);

        $this->load->model('category_model','category');
        $this->load->model("sell_model","sell");
        $this->load->model("company_model","company");
        $this->load->model("area_model","area");
        $this->load->library('Sphinx','sphinx');
        $category_type = $category_hot_type = $this->category->getCategoryCommon('catid,catname,linkurl,arrchildid',"parentid = 0",'hits desc,letter asc','0,20');

        foreach($category_type as $key=>$value)
        {
            $category_num = $this->category->getCategoryCommon('catid,catname,linkurl,company_num',"catid =".$value['catid'],'','',1);
            $category_type[$key]['num'] = $category_num['company_num'];
        }
        $ages = array();
        foreach ($category_type as $user) {
            $ages[] = $user['num'];
        }
        array_multisort($ages, SORT_DESC, $category_type);

        $res = $this->sphinx->getCompany('');
        foreach($res['matches'] as $k => $v)
        {
            $markets_type[$k] = $v['attrs'];
        }
        $business_type = $this->sphinx_company('mode');
        $volume_type = $this->sphinx_company('volume');
        $country_type = $this->sphinx_company('areaid');

        $area = $this->comm->findAll("area",'',"","areaname,areaid");
        foreach($area as $k=>$v)
        {
            $areas[$v['areaid']] = $v['areaname'];
        }
        foreach($country_type as $k => $v)
        {
            $country_type[$k]['name'] = $areas[$v['areaid']];
        }
        //markets_type
        $markets = array();
        $markets_one = array();
        foreach($markets_type as $k => $v)
        {
            $markets[] = explode(';',$v['markets']);
        }
        foreach($markets as $k => $v)
        {
            foreach($v as $k => $v)
            {
                if(!empty($v)) {
                    $markets_one[] = trim($v);
                }
            }
        }
        $markets_type = array_count_values($markets_one);

        if($tid[0] == "Category")
        {
            if(empty($tid[1]))
            {
                $cat_list = $category_type[0]['arrchildid'];
                $new_list = explode(',',$cat_list);
            }
            else
            {
                $cat_list =  $this->category->getCategoryCommon('arrchildid',"catid = ".$tid[1],'hits desc,letter asc','',1);
                $cat_list =  $cat_list['arrchildid'];
                $new_list = explode(',',$cat_list);
            }
            $res = $this->sphinx->getCategorySup($page,$page_size,$new_list);
            foreach($res['matches'] as $k => $v) {
                $category_sup[$k] = $v['attrs'];
            }

            if($res['total_found'] < 1000) {
                $sell_count = $res['total_found'];
            }
            else
            {
                $sell_count = 1000;
            }

            foreach($category_sup as $k =>$v)
            {
                $category_list[$k] = $this->company->getCompanyCommon('mode,business,markets,volume,export,company,username',"username = '".$v['username']."'",'','','',1);
                $category_list[$k]['sell'] = $this->sell->getSellCommon('linkurl,itemid,thumb,username,title',"username = '".$v['username']."'",'','','0,3');
            }
            $list = $category_list;

            //最新产品
            $list_sell = $this->list_sell($cat_list);
        }
        elseif($tid[0] == "Business")
        {
            $tid[1] = str_replace("%20", " ", $tid[1]);
            $sell = $this->sell("mode = '".$tid[1]."'",$page,$page_size);
            $list = $sell['list'];
            $sell_count = $sell['sell_count'];
            //最新产品
            $list_sell = $this->list_sell($sell['cat_name']);
        }
        elseif($tid[0] == "Markets")
        {
            $tid[1] = str_replace("%20", " ", $tid[1]);
            $sell = $this->sell("markets like '".$tid[1]."%'",$page,$page_size);
            $list = $sell['list'];
            $sell_count = $sell['sell_count'];
            //最新产品
            $list_sell = $this->list_sell($sell['cat_name']);
        }
        elseif($tid[0] == "Volume")
        {
            $tid[1] = str_replace("%20", " ", $tid[1]);
            $tid[1] = str_replace("%C2%A0", "&nbsp;", $tid[1]);
            $sell = $this->sell("volume = '".$tid[1]."'",$page,$page_size);
            $list = $sell['list'];
            $sell_count = $sell['sell_count'];
            //最新产品
            $list_sell = $this->list_sell($sell['cat_name']);
        }
        elseif($tid[0] == "Country")
        {
            $tid[1] = str_replace("%20", " ", $tid[1]);
            $sell = $this->sell("areaid = '".$tid[1]."'",$page,$page_size);
            $list = $sell['list'];
            $sell_count = $sell['sell_count'];
            //最新产品
            $list_sell = $this->list_sell($sell['cat_name']);
        }

        $data['new_sell'] = $list_sell['new_sell'];
        $data['hot_pros'] = $list_sell['hot_pros'];
        //分页
        $data['total_count']=$sell_count;
        $base_url = site_url("company/".__FUNCTION__."/".$url_name);
        $data['total_page']=ceil($sell_count/$page_size);
        $this->load->library('pagination');
        $data['base_url'] = "/company/".__FUNCTION__."/".$tid[0]."_".$tid[1];
        $data['tid'] =$tid[2];
        $config['base_url'] = $base_url;
        $config['total_rows'] = $sell_count ? $sell_count : 0;
        $config['per_page'] = $page_size;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
        $config['suffix'] = $this->config->item('url_suffix');
        $config['first_link']='first';
        $config['last_link']='last';
        $config['anchor_class'] = "class='pro_page' rel='nofollow'";
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $data['pages'] = $pages = $this->pagination->create_links();

        $data['category_type'] = $category_type;
        $data['category_hot_type'] = $category_hot_type;
        $data['business_type'] = $business_type;
        $data['markets_type'] = $markets_type;
        $data['volume_type'] = $volume_type;
        $data['country_type'] = $country_type;
        $data['list'] = $list;
        $this->load->view('header1',$data);
        $this->load->view('company/suppliers');
        $this->load->view('footer');
    }

    //产品(最新，热门)
    public function list_sell($cat_list)
    {
        if(empty($cat_list))
        {
            return;
        }
        $new_sell = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
            ,"status = 3 and catid in({$cat_list})",'','addtime desc',"0,8");
        $data['new_sell'] = $new_sell;
        $hot_pros = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
            ,"status = 3 and catid in({$cat_list})",'','hits DESC',"0,5");
        $data['hot_pros'] = $hot_pros;
        return $data;
    }

    //属性产品
    public function sell($where,$page,$page_size)
    {
        $company_sup = $this->company->getCompanyCommon('username,userid',$where,'','hits desc',"$page,$page_size");
        $company_num = $this->company->getCompanyCommon('username,userid',$where);
        $data['sell_count'] = count($company_num);

        foreach($company_sup as $k =>$v)
        {
            $company_list[$k] = $this->company->getCompanyCommon('userid,mode,business,markets,volume,export,company,username',"username = '".$v['username']."'",'','','',1);
            $company_list[$k]['sell'] = $this->sell->getSellCommon('userid,catid,linkurl,itemid,thumb,username,title',"username = '".$v['username']."'",'','','0,3');
            $cat_name[] = $v['userid'];
        }
        $cat_name = implode(',',$cat_name);
        $list = $company_list;
        $data['list'] = $list;
        $data['cat_name'] = $cat_name;
        return $data;
    }
    public function sphinx_company($attr)
    {
        $res = $this->sphinx->getCompany($attr);
        foreach($res['matches'] as $k => $v)
        {
            $company_type[$k] = $v['attrs'];
        }
        return $company_type;
    }

    public function suppliers_num($limit)
    {
        $this->load->model('category_model','category');
        $this->load->library('Sphinx','sphinx');
        $this->load->library('Sphinx','sphinx');
        $category_type = $this->category->getCategoryCommon('catid,catname,linkurl,arrchildid',"parentid = 0",'hits desc,letter asc',$limit);
        foreach($category_type as $key=>$value)
        {
            $catid = explode(',',$value['arrchildid']);
            $res = $this->sphinx->match_catid($catid);
            echo "<pre>";
            print_r($res);
            exit;
            $category_type[$key]['num'] = $res['total_found'];
        }
        foreach($category_type as $key=>$value)
        {
            $this->db->where('catid', $value['catid']);
            $this->db->update('wl_category', array('company_num' => $value['num']));
        }
    }

    /**
     * 供应商数量
     */
    public function suppliers_res(){
        $i = $this->uri->rsegment(3,0);
        $page = $i*10;
        $pageSize = 10;
        $limit = "".$page.",".$pageSize."";
        $this->suppliers_num($limit);
        $i++;

        $url = site_url("company/suppliers_res/{$i}");
        echo "
            <script language='JavaScript'>
                window.location='".$url."'
            </script>
            ";
    }

    public function search(){
        $site = $this->config->item("site");
        $data['site'] = $site;
        $url = $this->uri->rsegment(1,0);
        $data['url'] = $url;
        $url_name = $this->uri->rsegment(3,0);
        $tid = explode("_", $url_name);
        if(empty($url_name))
        {
            $tid[0] = "Category";
        }
        //分页
        if(empty($tid[3]))
        {
            $page_size=10;
        }
        else
        {
            $page_size=$tid[3];
        }
        $page = $this->uri->rsegment(4,0);
        $data['page'] = $page = intval($page);

        if(!empty($tid[1]))
        {
            $tid[1] = str_replace("%20", " ", $tid[1]);
            $data['conent'] =  $tid[1];
            $conent = $tid[1];
        }
        else
        {
            $conent = "ac m";
        }
        $this->load->model('category_model','category');
        $this->load->model("sell_model","sell");
        $this->load->model("company_model","company");
        $this->load->model("area_model","area");
        $this->load->library('Sphinx','sphinx');

        //分类
        $res = $this->sphinx->sell_attr($conent,'catid');

        foreach($res['matches'] as $k => $v)
        {
            $catlist[] = $v['attrs']['catid'];
        }
        $company_list = array();
        foreach($catlist as $k=>$v)
        {
            $arr_list = array($v);
            $res = $this->sphinx->search_catid($conent,$arr_list);
            $category_res[$k]['catid'] = $v;
            $category_res[$k]['num'] = $res['total_found'];
            foreach($res['matches'] as $key=>$value)
            {
                $arr = $this->company->getCompanyCommon('userid,mode,business,markets,volume,export,company,username',"username = '".$value['attrs']['username']."'",'','',"$page,$page_size",1);
                $arr['catid'] = $value['attrs']['catid'];
                array_push($company_list,$arr);
            }
        }
        foreach($category_res as $k=>$v)
        {
            $category_type[$k]=  $this->category->getCategoryCommon('catname,parentid',"catid = ".$v['catid'],'','',1);
            $category_type[$k]['catid'] = $v['catid'];
            $category_type[$k]['num'] = $v['num'];
        }
        $arr_are = array();
        foreach ($category_type as $v) {
            $arr_are[] = $v['num'];
        }
        array_multisort($arr_are, SORT_DESC, $category_type);

        //Markets
        $res = $this->sphinx->sell_attr($conent,'username');

        foreach($res['matches'] as $k => $v)
        {
            $userlist[] = $v['attrs']['username'];
        }
        $markets_type = array();
        $business_type = array();
        $volume_type = array();
        $country_type = array();
        $area = $this->comm->findAll("area",'',"","areaname,areaid");
        foreach($area as $k=>$v)
        {
            $areas[$v['areaid']] = $v['areaname'];
        }
        foreach($userlist as $k => $v)
        {
            $attr_type = $this->company->getCompanyCommon('userid,mode,business,markets,volume,export,company,username,areaid',"username = '".$v."'",'','','',1);
            $markets_type[$k] = $attr_type['markets'];
            $business_type[$k] = $attr_type['mode'];
            $volume_type[$k] = $attr_type['volume'];
            $country_type[$k] = $attr_type['areaid'];
        }
        $volume_type = array_count_values($volume_type);
        $business_type = array_count_values($business_type);
        foreach($country_type as $k => $v)
        {
            $country_type[$k] = $areas[$v];
        }
        $country_type = array_count_values($country_type);
        foreach($markets_type as $k => $v)
        {
            $markets[] = explode(';',$v);
        }
        foreach($markets as $k => $v)
        {
            foreach($v as $k => $v)
            {
                if(!empty($v)) {
                    $markets_one[] = trim($v);
                }
            }
        }
        $markets_type = array_count_values($markets_one);

       if($tid[0] == "Markets")
        {
            $tid[2] = str_replace("%20", " ", $tid[2]);
            foreach($userlist as $k =>$v)
            {
                $userlist[$k] = "'".$v."'";
            }
            $userlist = implode(',',$userlist);
            $sell = $this->search_sell($conent,"username in ({$userlist}) and markets like '%".$tid[2]."%'",$page,$page_size);
            $list = $sell['list'];
        } else{
            if (!empty($tid[2])) {
                foreach ($company_list as $key => $v) {
                    $catid = array($tid[2]);
                    $user = array($v['userid']);
                    $res = $this->sphinx->search_sell($conent, $catid, $user);
                    $sell = array();
                    foreach ($res['matches'] as $k => $v) {
                        $sell[] = $this->sell->getSellCommon('userid,catid,linkurl,itemid,thumb,username,title',"itemid = '". $v['attrs']['sellid']."'",'','','',1);
                    }
                    $company_list[$key]['sell'] = $sell;
                }
            } else {
                foreach ($company_list as $key => $v) {
                    $catid = array($v['catid']);
                    $user = array($v['userid']);
                    $res = $this->sphinx->search_sell($conent, $catid, $user);
                    $sell = array();
                    foreach ($res['matches'] as $k => $v) {
                        $sell[] = $this->sell->getSellCommon('userid,catid,linkurl,itemid,thumb,username,title',"itemid = '". $v['attrs']['sellid']."'",'','','',1);
                    }
                    $company_list[$key]['sell'] = $sell;
                }
            }
            $list = $company_list;
        }

        $new_sell = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
            ,"title like '%".$conent."%'",'','addtime desc',"0,8");
        $hot_pros = $this->sell->getSellCommon('unit,minamount,minprice,currency,itemid,areaid,title,thumb,linkurl,username'
            ,"title like '%".$conent."%'",'','addtime desc',"0,5");
        //分页
        $sell_count = 10;
        $data['total_count']=$sell_count;
        $base_url = site_url("search/".__FUNCTION__."/".$url_name);
        $data['total_page']=ceil($sell_count/$page_size);
        $this->load->library('pagination');
        $data['base_url'] = $base_url;
        $config['base_url'] = $base_url;
        $config['total_rows'] = $sell_count ? $sell_count : 0;
        $config['per_page'] = $page_size;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
        $config['suffix'] = $this->config->item('url_suffix');
        $config['first_link']='first';
        $config['last_link']='last';
        $config['anchor_class'] = "class='pro_page'";
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        $data['pages'] = $pages = $this->pagination->create_links();

        $data['list'] =$list;
        $data['new_sell'] = $new_sell;
        $data['hot_pros'] = $hot_pros;
        $data['category_type'] = $category_type;
        $data['business_type'] = $business_type;
        $data['markets_type'] = $markets_type;
        $data['volume_type'] = $volume_type;
        $data['country_type'] = $country_type;
        $this->load->view('header1',$data);
        $this->load->view('company/search');
        $this->load->view('footer');
    }

    //属性产品
    public function search_sell($conent,$where,$page,$page_size)
    {
        $company_sup = $this->company->getCompanyCommon('username,userid',$where,'','hits desc',"$page,$page_size");
        $company_num = $this->company->getCompanyCommon('username,userid',$where);
        $data['sell_count'] = count($company_num);

        foreach($company_sup as $k =>$v)
        {
            $company_list[$k] = $this->company->getCompanyCommon('userid,mode,business,markets,volume,export,company,username',"username = '".$v['username']."'",'','','',1);
            $company_list[$k]['sell'] = $this->sell->getSellCommon('userid,catid,linkurl,itemid,thumb,username,title',"title like '%".$conent."%' and username = '".$v['username']."'",'','','0,3');
            $cat_name[] = $v['userid'];
        }
        $list = $company_list;
        $data['list'] = $list;
        $data['cat_name'] = $cat_name;
        return $data;
    }
}