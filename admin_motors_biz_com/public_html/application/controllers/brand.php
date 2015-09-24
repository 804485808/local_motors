<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class brand extends MY_Controller{

	function __construct(){
		parent::__construct();
        $this->load->library('pagination');
        $this->load->model('brand_model','brand');
	}

    //品牌添加
    function brand_add()
    {
        $brand_arr=$this->input->post();
        if($brand_arr['post'])
        {
            $insert_arr=array(
                'name'=>$_POST['post']['title'],
                'thumb'=>$_POST['post']['thumb'],
                'addtime'=>strtotime(date('Y-m-d H:i:s')),
            );
            $this->brand->insert($insert_arr);
            $this->msg('brand/brand_list','添加成功');
        }
        $this->load->view('brand/brand_add');
    }

    //品牌查询
    function brand_search(){						//品牌查询

        $sear_arr=$this->input->post();

        $this->db->select('*');
        $this->db->from('brand');
        $fields=array(0=>'name');

        if($sear_arr['kw']!=null){				//查找具体字段
            $this->db->like($fields[$sear_arr['fields']], $sear_arr['kw']);
        }

        if($sear_arr['fromdate']!=null){    //发布日期筛选
            $this->db->where('addtime >',strtotime($sear_arr[fromdate].'00:00:00'));
        }
        if($sear_arr['todate']!=null){
            $this->db->where('addtime <',strtotime($sear_arr[todate].'23:59:59'));
        }

        $res = $this->db->get();
        $list_archives = $res->result_array();

        $data['list']=$list_archives;
        $this->load->view('brand/brand_list',$data);

    }

    //品牌列表
    function brand_list()
    {
        $pagefrom = $this->uri->segment(3, 0);

        /**获得分页总数**/
        $this->db->from('brand');
        $pagecount=$this->db->count_all_results();
        /**获得分页总数**/

        /*分页*/
        $config['per_page'] = 10;
        $config['total_rows'] = $pagecount;
        $config['base_url'] = base_url('index.php/brand/brand_list');
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        /*分页*/

        $data['list'] = $this->brand->getBrandCommon("*","","addtime desc","{$pagefrom},{$config['per_page']}",""); //获取数据信息

        $data['page']=$this->pagination->create_links();
        $data['site'] = $this->config->item('site');
        $this->load->view('brand/brand_list',$data);
    }

    //品牌删除数据
    function brand_del(){

        $sear_arr=$this->input->post();
        $this->brand->delect($sear_arr['brandId']);
        $this->msg('brand/brand_list','删除成功');

    }

    //删除特定的一条
    function brand_del_one(){

        $id = $this->uri->segment(3, 0);
        $sear_arr[0] = $id;
        $this->brand->delect($sear_arr);
        $this->msg('brand/brand_list','删除成功');

    }

    //编辑数据
    function brand_edit(){
        $id= $this->uri->segment(3, 0);
        $data['list'] = $this->brand->getBrandCommon("*","brandId={$id}","","1",""); //获取数据信息
        $this->load->view('brand/brand_add',$data);
    }

    //修改数据
    function brand_update(){

        $update_arr=array(
            'name'=>$_POST['post']['title'],
            'thumb'=>$_POST['post']['thumb'],
        );
        $this->brand->updata($_POST['brandId'],$update_arr);
        $this->msg('brand/brand_list','修改成功');

    }

    //简易的弹窗方法
    function msg($url,$tip){

        echo "<script language='javascript'>alert('".$tip."');</script>";
        echo "<script language='javascript'>window.location='".site_url($url)."'</script>";

    }
}

