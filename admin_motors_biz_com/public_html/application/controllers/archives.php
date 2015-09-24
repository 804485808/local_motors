<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class archives extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Shanghai');
        $this->load->library('form_validation');  //表单验证
        $this->load->library('pagination');
    }

    //添加分类
    function archives_class()
    {
        $data = $this->get_cats();
        $pid = $this->uri->rsegment(3,0);
        if($pid){
            $data['parentid'] = $pid;
        }else{
            $data['parentid'] = '';
        }
        if($_POST){
            $this->load->model('category_new_model','category_new');
            $re = $this->category_new->addCategory();
        }

        $this->load->view('archives/archives_class',$data);
    }
    //修改分类
    function save_cat()
    {
        $catid = $_POST['catid'];
        if($_POST){
            $category = array(
                'catname'=>$_POST['category']['catname'],
                'listorder'=>$_POST['category']['listorder'],
                'level'=>$_POST['category']['level']
            );
            $rs=$this->comm->update("category_new",array("catid"=>$catid),$category);
        }
        $this->msg('archives/archives_class_list','修改成功');
    }

    //分类列表
    function archives_class_list()
    {
        $data = $this->input->post();
        if($data['category']) {
            $this->load->model('category_new_model', 'category_new');
            $this->category_new->updateCategory($data['category']);
        }
        $data=$this->get_cats();


        $page = $this->uri->rsegment(3,0);
        $uri_segment = 4;
        $base_url = site_url("archives".__FUNCTION__."/");
        $condition1=array();
        if(preg_match("/^[a-zA-Z]{1,}-[0-9]{1,}$/isU",$page)){
            $pid = explode("-",$page);
            $pid = intval($pid[1]);
            $page = $this->uri->rsegment(4,0);
            $uri_segment = 5;
            $condition=array('parentid'=>$pid);
            $base_url = site_url("archives".__FUNCTION__."/".$this->uri->rsegment(3,'')."/");
        }else {
            $condition=array('parentid'=>0);
        }

        $page = intval($page);
        $data['page_size']=$page_size=20;

        $top_cat = $this->comm->findAll("category_new",$condition,"","","{$page},{$page_size}");
        $data['top_cat_count'] = count($top_cat);
        foreach ($top_cat as $k=>$v){
            $condition=array('parentid'=>$v['catid']);
            $top_cat[$k]['subcat_count'] = count($this->comm->findAll("category_new",$condition,"","","{$page},{$page_size}"));
        }
        $this->load->service('pub_service','service');
        $data['top_cat'] = $this->service->all_linkurl($top_cat);

        $data['cat_count']=$cat_count=$this->comm->findCount("category_new",$condition);
        $data['total_page']=ceil($cat_count/$page_size);
        $this->load->library('pagination');
        $data['base_url']=$config['base_url'] = $base_url;
        $config['total_rows'] = $cat_count;
        $config['per_page'] = $page_size;
        $config['uri_segment'] = $uri_segment;
        $config['num_links'] = 8;
        $config['suffix'] = $this->config->item('url_suffix');
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';

        $this->pagination->initialize($config);
        $data['pages'] = $pages = $this->pagination->create_links();
        //$this->output->enable_profiler(TRUE);

        $this->load->view('archives/archives_class_list',$data);
    }

    function edit_cat(){
        $catid = $this->uri->rsegment(3,0);
        $catid = intval($catid);
        if($catid){
            $data=$this->get_cats();
            if ($rs=$this->comm->find("category_new",array("catid"=>$catid),"","parentid")){
                $data['parentid']=$rs['parentid'];
            }
            $data['cat'] = $cat=$this->comm->find('category_new',array('catid'=>$catid));
            $this->load->view('archives/archives_cat',$data);
        }else{
            show_error("Not found category leads ");
        }
    }

    //删除分类
    function del_cat(){
        $catid=intval($this->uri->rsegment(3,0));
        $del_id=array();
        if($catid){
            $del_id=array($catid);
        }elseif ($_POST){
            $del_id=$this->input->post('catids',TRUE);
        }
        if ($del_id){
            $c=0;
            foreach ($del_id as $v){
                $findcat = $this->comm->find("category_new",array("catid"=>$v));
                $findParentCat = $this->comm->findCount("category_new",array("parentid"=>$v));
                if(!$findcat){
                    $data['msg']='没有找到此类别';
                    $str=$this->load->view('public/success',$data,TRUE);
                    echo $str;
                    exit;
                }elseif ($findParentCat){
                    $data['msg']='此类含有子类，不能被删除';
                    $str=$this->load->view('public/success',$data,TRUE);
                    echo $str;
                    exit;
                }elseif ($findcat['item']){
                    $data['msg']='此类下含有产品，不能被删除';
                    $str=$this->load->view('public/success',$data,TRUE);
                    echo $str;
                    exit;
                }else{
                    $j = $this->comm->delete("category_new",array("catid"=>$v));
                    $c = $j ? $c+1 : $c;
                }
            }
            $rs=$c==count($del_id)?"类别删除成功！":"类别删除失败，请重试!";
        }else{
            $rs="请选择类别";
        }
        $data['msg']=$rs;
        $this->load->view('public/success',$data);
    }

    function archives_list(){

        $pagefrom = $this->uri->segment(3, 0);

        /**获得分页总数**/
        $this->db->where('status', 3);
        $this->db->from('news');
        $pagecount=$this->db->count_all_results();
        /**获得分页总数**/


        /*分页*/
        $config['per_page'] = 10;
        $config['total_rows'] = $pagecount;
        $config['base_url'] = base_url('index.php/archives/archives_list');
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        /*分页*/

        $this->load->model('news_model','news');
        $limit = $pagefrom.",".$config['per_page'];
        $where = "t1.status = 3";
        $status = 3;



        $list_info = $this->news->getNewsList($where,$limit);

        $data['status'] = $status;
        $data['list']=$list_info;

        $data['page']=$this->pagination->create_links();
        $data['site'] = $this->config->item('site');
        $this->load->view('archives/archives_list',$data);


    }



    function archives_recycle(){

        $pagefrom = $this->uri->segment(3, 0);

        /**获得分页总数**/
        $this->db->where('status', 0);
        $this->db->from('news');
        $pagecount=$this->db->count_all_results();
        /**获得分页总数**/


        /*分页*/
        $config['per_page'] = 10;
        $config['total_rows'] = $pagecount;
        $config['base_url'] = base_url('index.php/archives/archives_list');
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        /*分页*/

        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('news_data', 'news.itemid = news_data.itemid');

        $this->db->where('news.status', 0);
        $this->db->order_by("news.itemid", "desc");
        $this->db->limit($config['per_page'],$pagefrom);

        $res = $this->db->get();


        $list_info = $res->result_array();
        $data['list']=$list_info;

        $list_class=$this->archives_get_class();
        $data['class']=$list_class;					//传递class

        $data['page']=$this->pagination->create_links();


        $this->load->view('archives/archives_recycle',$data);



    }


    /**
     * 咨询修改
     */
    function archives_edit(){
        $this->load->model('news_model','news');
        $this->load->model('category_new_model','category_new');

        $id= $this->uri->segment(3, 0);

        $list_info = $this->news->getNewsCommonLink('t1.*,t2.*',array('wl_news'=>'t1'),array('NewsData'=>'t2'),"t1.itemid='{$id}'");

        $data['list']=$list_info;

        $list_class = $this->category_new->getParentCategory();

        $data['class']=$list_class;


        $onsubmit=array('onsubmit'=>"return checkform('post[title]','content1','post[classid]')");
        $data['onsubmit']=$onsubmit;

        $this->load->view('archives/archives_edit',$data);

    }


    /**
     * 添加咨询
     */
    function archives_add(){
        $this->load->model('news_model','news');
        $this->load->model('category_new_model','category_new');
        //添加news
        if($this->news->addNews()){
            $this->msg('archives/archives_list','操作成功');
        }

        $re = $this->uri->rsegment(3,0);
        if($re){
            $rs = $this->news->getNewsDetail($re);
            $data['title'] = $rs['title'];
            $data['thumb'] = $rs['thumb'];
            $data['userid'] = $rs['userid'];
            $data['author'] = $rs['author'];
            $data['content'] = $rs['content'];
            $data['catid'] = $rs['catid'];
            $data['catname'] = $rs['catname'];
            $data['itemid'] = $rs['itemid'];
            $data['level'] = $rs['level'];
            $data['style'] = $rs['style'];
            $data['tag'] = $rs['tag'];
            $data['copyfrom'] = $rs['copyfrom'];
            $data['fromurl'] = $rs['fromurl'];
        }else{
            $data['author'] = $this->session->userdata['username'];
            $data['userid'] = $this->session->userdata['userid'];
        }

        //获取一级分类
        $list_class = $this->category_new->getParentCategory();
        $data['class']=$list_class;
        $onsubmit=array('onsubmit'=>"return checkform('post[title]','content1','post[classid]')");//'name'=>'form_add','id'=>'form_add'
        $data['onsubmit']=$onsubmit;

        $this->load->model('member_model','member');
        $allMember = $this->member->getCompanyMember();
        $data['allMember'] = json_encode($allMember);


        $this->load->view('archives/archives_add',$data);
        $this->session->unset_userdata('folderurl');

    }

    /**
     * ajax获取子分类
     */
    public function selectCategory(){
        $catid = $this->input->post('catid');
        $this->load->model('category_new_model','category_new');
        $re = $this->category_new->getChildCategory($catid);
        $str = '';
        if($re){
            foreach($re as $v) {
                $str .= "<option value='{$v['catid']}'>".$v['catname']."</option>";
            }
            echo $str;
        }else{
            echo "2";
        }

    }



    function archives_update(){

        $insert_arr=array(
            'title'=>$_POST['post']['title'],
            'catid'=>$_POST['post']['classid'],
            'ip'=>$_SERVER["REMOTE_ADDR"],
            'addtime'=>time(),
            'author'=>$this->session->userdata('username'),
            'thumb'=>$_POST['post']['thumb'],
            'keyword'=>mb_substr($_POST['post']['content'], 0, 300, 'utf-8')
        );

        $this->db->where('itemid',$_POST['post']['itemid']);
        $this->db->update('news',$insert_arr);


        $insert_content_arr=array(
            'content'=>$_POST['post']['content']
        );
        $this->db->where('itemid',$_POST['post']['itemid']);
        $this->db->update('news_data',$insert_content_arr);

        $this->msg('archives/archives_list','修改成功');

    }

    function archives_del(){					//资讯底部的 回收站和恢复数据

        $sear_arr=$this->input->post();
        $status = $this->uri->segment(3, 0);

        foreach($sear_arr['itemid'] as $val){
            $this->db->or_where('itemid', $val);
        }

        if($status=='datadel'){ //丢入回收站
            $this->db->update('news',array('status'=>0));
            $this->msg('archives/archives_list','删除成功');

        }elseif($status=='datafrom'){		//从回收站恢复
            $this->db->update('news',array('status'=>3));
            $this->msg('archives/archives_recycle','恢复成功');
        }elseif($status=='delete'){		//从回收站恢复
            $this->db->delete('news');
            foreach($sear_arr['itemid'] as $val){
                $this->db->or_where('itemid', $val);
            }
            $this->db->delete('news_data');
            $this->msg('archives/archives_recycle','彻底删除成功');
        }
    }


    function archives_del_one(){ 			//删除特定的一条

        $id = $this->uri->segment(3, 0);
        $this->db->where('itemid', $id);
        $this->db->update('news',array('status'=>0));
        $this->msg('archives/archives_list','删除成功');

    }
    // function archives_del(){ 			//删除特定的一条

    // $id = $this->uri->segment(3, 0);
    // $this->db->where('itemid', $id);
    // $this->db->delete('news',array('status'=>0));
    // $this->msg('archives/archives_list','删除成功');

    // }


    function archives_search(){						//资讯查询

        $sear_arr=$this->input->post();
        // echo date("Y/m/d h:i:s",strtotime($sear_arr[fromdate].'999999'));
        // echo ' ';
        // echo date("Y/m/d h:i:s",strtotime($sear_arr[todate].'1406609999'));die;


        $this->load->library('pagination');

        $this->db->select('*');
        $this->db->from('wl_news');
        $this->db->join('news_data', 'news.itemid = news_data.itemid');

        $fields=array(1=>'title');

        if($sear_arr['fields']==0 && $sear_arr['kw']!=null){		//综合模式
            $this->db->or_like('wl_news.title', $sear_arr['kw']);  //标题和作者
            $this->db->or_like('wl_news.author', $sear_arr['kw']);
            $this->db->or_like('wl_news.keyword', $sear_arr['kw']);

        }elseif($sear_arr['kw']!=null){				//查找具体字段
            $this->db->like('wl_news.'.$fields[$sear_arr['fields']], $sear_arr['kw']);
        }

        if($sear_arr['fromdate']!=null){    //发布日期筛选
            $this->db->where('wl_news.addtime >',strtotime($sear_arr[fromdate].'00:00:00'));
        }
        if($sear_arr['todate']!=null){
            $this->db->where('wl_news.addtime <',strtotime($sear_arr[todate].'23:59:59'));
        }


        if($sear_arr['thumb']!=null){				//筛选有图片
            $this->db->where('wl_news.imgurl1 !=','');
        }
        if($sear_arr['username']!=null){				//筛选有图片
            $this->db->like('wl_news.author', $sear_arr[username]);
        }


        $res = $this->db->get();
        $list_archives = $res->result_array();

        $data['list']=$list_archives;
        $this->load->view('archives/archives_list',$data);

    }







    function msg($url,$tip){		  //简易的弹窗方法

        echo "<script language='javascript'>alert('".$tip."');</script>";
        echo "<script language='javascript'>window.location='".site_url($url)."'</script>";

    }


    function archives_get_class(){			//获得类别

        //$this->db->where('parentid', 0);
        $class=$this->db->get_where('category',array('parentid' => 0));
        $list_class = $class->result_array();
        return $list_class;


    }

    /**
     * 获取分类
     * @return mixed
     */
    function get_cats(){
        $this->load->driver('cache',array('adapter' => 'file'));
        //$this->cache->clean();
        if(!$cat1=$this->cache->get('cat1')){
            $cat1 = $this->comm->findAll("category_new",array("parentid"=>0),"level asc");
            //$this->cache->save('cat1', $cat1, 60*60*24*30);
        }
        if(!$cat2=$this->cache->get('cat2')){
            foreach($cat1 as $k => $v){
                $cat2[$v['catid']] = $this->comm->findAll("category_new",array("parentid"=>$v['catid']));
            }
            //$this->cache->save('cat2', $cat2, 60*60*24*30);
        }
        if(!$cat3=$this->cache->get('cat3')){
            foreach($cat2 as $k => $v){
                foreach($v as $x => $s){
                    $cat3[$s['catid']] = $this->comm->findAll("category_new",array("parentid"=>$s['catid']));
                }
                //	$this->cache->save('cat3', $cat3, 60*60*24*30);

            }
        }

        if(!$cat4=$this->cache->get('cat4')){
            foreach($cat3 as $k => $v){
                foreach($v as $x => $s){
                    $cat4[$s['catid']] = $this->comm->findAll("category_new",array("parentid"=>$s['catid']));

                }
            }
            //$this->cache->save('cat4', $cat4, 60*60*24*30);
        }

        $data['cat1'] = $cat1;
        $data['cat2'] = $cat2;
        $data['cat3'] = $cat3;
        $data['cat4'] = $cat4;
        return $data;
    }

    /**
     * 评论
     */
    public function review(){
        $pagefrom = $this->uri->segment(3, 0);

        /**获得分页总数**/
        $this->db->from('news_review');
        $pagecount=$this->db->count_all_results();
        /**获得分页总数**/


        /*分页*/
        $config['per_page'] = 10;
        $config['total_rows'] = $pagecount;
        $config['base_url'] = base_url('index.php/archives/review');
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        /*分页*/

        $this->load->model('news_review_model','news_review');
        if($pagefrom&&is_numeric($pagefrom)) {
            $limit = $pagefrom . "," . $config['per_page'];
        }else{
            $limit = "0,10";
        }

        $itemid = $this->uri->segment(3,0);

        if(strstr($itemid,'su')){
            $itemid = substr($itemid,3);
            $where = "t1.itemid = ".$itemid;
        }else{
            $where = " 1=1 ";
        }


        $list_info = $this->news_review->getNewsReviewList($where,$limit);
        $data['list'] = $list_info;

        $this->load->view('archives/review',$data);

    }

    /**
     * 删除评论
     */
    public function archivesReviewDel(){
        $id = $this->uri->segment(3,0);
        $this->db->delete('wl_news_review',array('id'=>$id));
        $this->msg('archives/review','删除成功');
    }

    /**
     * 改变评论状态
     */
    public function  changeStatus(){
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $status = $status==1?2:1;
        $array = array(
            'status'=>$status
        );
        $where = array(
            'id'=>$id
        );

        $this->load->model('news_review_model','news_review');
        $re = $this->news_review->updateReview($array,$where);
        if($re){
            echo "1";
        }else{
            echo "2";
        }
    }

    /**
     * 评论内容
     */
    public function archivesContent(){
        $id = $this->uri->segment(3,0);
        $this->load->model('news_review_model','news_review');
        $re = $this->news_review->getNewsCommonLink('t1.id,t1.content,t2.username',array('wl_news_review'=>'t1'),array('Member'=>'t2'),"t1.id = '{$id}'",'','',1);
        $data['detail'] = $re;

        $this->load->view('archives/showReviewContent',$data);
    }

    public  function updateReview(){
        $post = $this->input->post('post');
        $array = array(
            'content'=>$post['content']
        );
        $where = array(
            'id'=>$post['id']
        );

        $this->load->model('news_review_model','news_review');
        if($this->news_review->updateReview($array,$where)){
            echo 1;
        }else{
            echo 2;
        }
    }


}

