<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class news extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('comm_model','comm');
        $this->load->model('tagindex_model','tagindex');
        $this->load->model('sell_model','sell');
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

        //关键词封装
        $re_tagindex = $this->tagindex->getRoundTagindex();
        $data['keywords'] = $re_tagindex;

        return $data;
    }

    public function index(){

        $data = $this->header();
        $url = $this->uri->rsegment(1,0);
        $data['url'] = $url;
        //获取新闻分类
        $this->load->model('category_new_model','category_new');
        $category_new = $this->category_new->getChildCategory('1');

        //获取新闻分类信息
        $newsDetail = Array();
        $this->load->model('news_model','news');

        foreach($category_new as $k =>$v){
            if($k>5) {break;}
            $newsDetail[$k]['catid'] = $v['catid'];
            $newsDetail[$k]['catname'] = $v['catname'];
            $newsDetail[$k]['catid'] = $v['catid'];

            $newsDetail[$k][$k] = $this->news->getNewsDetail($v['catid'],'0,11');
        }

        //新闻Technology(技术)
        $technology_new = $this->category_new->getChildCategory('0');
        unset($technology_new[0]);

        //获取Technology(技术)分类信息
        $technologyDetail = Array();
        foreach($technology_new as $k =>$v){
            $technologyDetail[$k]['catid'] = $v['catid'];
            $technologyDetail[$k]['catname'] = $v['catname'];
            $technologyDetail[$k]['catid'] = $v['catid'];
            $news= $this->news->getNewsDetail($v['catid'],'0,11');
            foreach($news as $key=>$v)
            {
                $news_one = strip_tags($v['content']);
                $news[$key]['content'] = str_replace("&nbsp;", " ", $news_one);
            }
            $technologyDetail[$k][$k] = $news;
        }
        //热门阅读
        $newsHot = $this->news->getNewsHot('0,9');
        //推荐阅读
        $newsRecommend = $this->news->getNewsRecommend('1','0,20');

        $img_url ="http://img.com";
        $data['img_url'] =$img_url;
        $data['newsHot'] =$newsHot;
        $data['newsDetail'] = $newsDetail;
        $data['newsRecommend'] = $newsRecommend;
        $data['technologyDetail'] = $technologyDetail;

        header('Content-Language:en');

        $data['title'] = "Latest and Comprehensive Technology Articles, Exhibitions, News on Company and Motor Industry, Business Celebrities, Hot and Popular Information / Motors-biz.com";
        $data['description']="Show a wide range of motor information on the comprehensive technology involving principle, basics, construction, etc. Continuously update the news on company and industry, senior business celebrities as well as exhibitions. Benefit you for hot and popular information on Motors-biz.com";


        $this->load->view('header',$data);
        $this->load->view('news/news');
        $this->load->view('footer');
    }
    //信息评论
    public function newsReview()
    {
        $itemid = $this->uri->rsegment(3,0);
        $date = array();
        $date['itemid'] = intval($itemid);
        $date['content'] =$_POST['content'];
        $date['time'] = time();
        $this->load->model('news_review_model','news_review');
        $this->news_review->addReview($date);
        echo $_POST['content'];
    }
    //信息详情
    public function newsDetail(){
        $data = $this->header();
        $url = $this->uri->rsegment(1,0);
        $data['url'] = $url;
        //获取参数
        $itemid = $this->uri->rsegment(3,0);
        $itemid = intval($itemid);
        $page = $this->uri->rsegment(4,0);
        $uri_segment = 4;
        $page = intval($page);
        $data['page_size']=$page_size=5;
        //查询信息列表
        $newsDetail = Array();
        $this->load->model('news_model','news');
        $newsDetail = $this->news->getDetail($itemid);
        $newsDetail['data'] = $this->newsData($newsDetail['addtime']);
        $newsDetail['content'] = str_replace("&nbsp;", " ", $newsDetail['content']);
        $newsDetail['content'] = preg_replace("/style=.+?['|\"]/i",'',$newsDetail['content']);//去除样式

        //信息评论
        $this->load->model('news_review_model','news_review');
        $limit = "{$page},{$page_size}";
        $newsReview = $this->news_review->getNewsReview($itemid,$limit);
        foreach($newsReview as $k=>$v) {
            $newsReview[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
        }
        $newsDetail['newsReview'] = $newsReview;

        $newsDetail['count']=$sell_count= $this->news_review->getNewsReviewCount($itemid);

        $data['total_count']=$sell_count;
        $base_url = site_url("news/newsDetail/".$itemid);
        $data['total_page']=ceil($sell_count/$page_size);
        $this->load->library('pagination');
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

        //相关阅读
        $newsRelated = $this->news->getNewsDetail($newsDetail['catid'],'0,10');

        //热门阅读
        $newsHot = $this->news->getNewsHot('0,15');

        //推荐阅读
        $newsRecommend = $this->news->getNewsRecommend('1','0,10');

        //获取最新商品
        $hot_pros = $this->sell->getHotProducts('0,15');

        $data['senior_new'] = $this->comm->findAll("company","company!=''","fromtime desc","userid,username,company","0,9");

        $data['title'] = "Motor Information List, Recommended products, Hot news on Motors-biz.com";
        $data['description']="Supply you with an intelligible motor information list with technology, news on company and industry, business celebrities. Conveniently learn about recommended products and hot news.";


        $img_url ="http://img.com";
        $data['img_url'] =$img_url;
        $data['hot_pros'] = $hot_pros;
        $data['newsDetail'] = $newsDetail;
        $data['newsHot'] = $newsHot;
        $data['newsRecommend'] = $newsRecommend;
        $data['newsRelated'] = $newsRelated;
        header('Content-Language:en');
        //浏览量
        $this->quantity($itemid,$newsDetail['hits']);
        $this->load->view('header',$data);
        $this->load->view('news/newsDetail');
        $this->load->view('footer');

    }

    public function newsList(){

        $this->load->library('encrypt');
        $username = $this->input->cookie('username', TRUE);
        $hash_1 = $this->input->cookie('hash_1', TRUE);
        $data['username'] = $this->encrypt->decode($username,$hash_1);
        $this->config->set_item("compress_output",TRUE);
        $this->load->helper('inflector');
        $site = $this->config->item("site");
        $data['site'] = $site;
        $data = $this->lists();

        $data['title'] = "Motor Information List, Recommended products, Hot news on Motors-biz.com";
        $data['description']="Supply you with an intelligible motor information list with technology, news on company and industry, business celebrities. Conveniently learn about recommended products and hot news.";

        $catid = $this->uri->rsegment(3,0);
        if($catid=28){
            $data['title'] = "Exhibition，Graphic Information，Exhibition Dynamics on motors-biz.com";
            $data['description']="The latest exhibition information, authority exhibition information, exhibition around the world, accurate exhibition dates, exhibitors, etc. are provided on motors-biz.com";

        }
        $data['url'] = "newsList";
        $this->load->view('header',$data);
        $this->load->view('news/newsLast');
        $this->load->view('footer');
    }


    /**
     * 列表
     * @param string $condition
     * @param $fun_name
     * @param $username
     * @return mixed
     */
    function lists(){

        $this->load->service('pub_service','service');

        $catid = $this->uri->rsegment(3,0);
        $catid = intval($catid);

        $data['site'] = $site = $this->config->item('site');
        $page = $this->uri->rsegment(4,0);
        $uri_segment = 4;

        $page = intval($page);
        $data['page_size']=$page_size=10;


        $this->load->model('news_model','news');
        $this->load->model('category_new_model','category_new');
        $re = $this->category_new->getCategoryNewCommon('catname',"catid = '{$catid}'",'','',1);
        $data['catname'] = $re['catname'];

        $data['newsTop'] = $this->news->getNewsTop('0,10');
        $data['allCount']=$all_count=$this->news->getNewsCount($catid);

        if($all_count>$page_size){
            $this->load->library('pagination');
            $thislinkurl=$this->uri->rsegment(3,'');
            $base_url = base_url("/news/newsList/".$thislinkurl);
            $config['base_url'] = $base_url;
            $config['total_rows'] = $all_count ? $all_count : 0;
            $config['per_page'] = $page_size;
            $config['uri_segment'] = 4;
            $config['num_links'] = 5;
            $config['suffix'] = $this->config->item('url_suffix');
            $config['first_link']='first';
            $config['last_link']='last';
            $config['anchor_class'] = "class='pro_page'";
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $data['pages'] = $pages = $this->pagination->create_links();
        }else{
            $data['pages'] = '';
        }


        $limit = "{$page},{$page_size}";

        $re = $this->news->getCategoryNewsList($catid,$limit);
        $data['newsList'] = $re;

        $data['total_page']=ceil($all_count/$page_size);



        return $data;
    }

    //浏览量
    public function quantity($itemid,$hits)
    {
        $update_arr = array(
            'hits' => $hits+1
        );
        return $this->news->updata($itemid, $update_arr);
    }

    //日期格式
    public function newsData($time)
    {
        $data[D]   =  date( "d",$time);
        $data[M]   =  date( "M",$time);
        $data[Y]   =  date( "Y",$time);
        return $data;
    }
}
