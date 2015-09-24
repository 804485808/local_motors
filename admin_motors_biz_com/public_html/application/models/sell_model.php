<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sell_model extends MY_Model{
	function __construct()
	{
		parent::__construct();
	}


    public $mainTable = 'wl_sell';

    /**
     * 关联表
     * @var array
     */
    protected $_link = array(
        'Area'=>array(
            'table'=>'wl_area',
            'selfKey'=>'areaid',
            'otherKey'=>'areaid'
        ),
        'Category'=>array(
            'table'=>'wl_category',
            'selfKey'=>'catid',
            'otherKey'=>'catid'
        )
    );

    /**
     * 创建 主表匹配数组
     * @return array|bool
     */
    public function creatData($data){
        return $this->createDateCommon($data,$this->mainTable);
    }

    /**
     * 查询sell公共方法
     * @param string $files  查询字段
     * @param string $where  条件
     * @param string $limit  limit
     * @param string $order  排序
     * @param int    $type   1：返回一条一维数据 0:默认返回二维数组
     * @return array 查询结果
     */
    public function getSellCommon($files='*',$where='',$order='',$limit='',$type=0){
        $sql = "SELECT ".$files;
        $sql .= " FROM ".$this->mainTable;
        if($where){
            $sql .= " WHERE ".$where;
        }

        if($order){
            $sql .= " ORDER BY ".$order;
        }

        if($limit){
            $sql .= " LIMIT ".$limit;
        }

        $query = $this->db->query($sql);

        if ($query->num_rows > 0) {
            if (!$type) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return array();
        }

    }


    /**
     * 连表查询 公共方法
     * @param string $files    查询字段
     * @param array $manTable  主表 array('表名'=>'别名')
     * @param array $link      关联表 array('$_link'=>'别名')
     * @param string $where    查询条件
     * @param string $order    排序
     * @param string $limit    limit
     * @param int $type        1：返回一条一维数据 0:默认返回二维数组
     * @return array
     */
    public function getSellCommonLink($files='*',$manTable,$link,$where='',$order='',$limit='',$type=0){

        $manTableName = key($manTable);
        $manTableAlse = $manTable[$manTableName];
        $sql = "SELECT ".$files;
        $sql .= " FROM ".$manTableName." AS ".$manTableAlse;

        if($link){
            while($key = key($link)){
                $sql .= " LEFT JOIN ".$this->_link[$key]['table']." AS ".$link[$key]." ON ".$link[$key].".".$this->_link[$key]['otherKey']." = ".$manTableAlse.".".$this->_link[$key]['selfKey'];
                next($link);
            }
        }

        if($where){
            $sql .= " WHERE ".$where;
        }

        if($order){
            $sql .= " ORDER BY ".$order;
        }

        if($limit){
            $sql .= " LIMIT ".$limit;
        }

        $query = $this->db->query($sql);

        if($query->num_rows>0){
            if(!$type){
                return $query->result_array();
            }else{
                return $query->row_array();
            }
        }else{
            return array();
        }

    }





    /**
	 * 查看一条供应记录
	 * @param $itemid  int sell表id
	 * @return  array  | FALSE
	 */
	 public function get_one_sell($itemid){
		$this->db->select("sell.*,userid,mode,areaname,content,business,regyear,icp")->from('sell')->where('sell.itemid',$itemid);
		$this->db->join('company','sell.username = company.username','left');
		$this->db->join('area','company.areaid = area.areaid','left');
		$this->db->join('sell_data','sell.itemid = sell_data.itemid','left');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	} 
	

	
	/**
	 * 获得满足条件的供应商的type信息
	 * @param int $userid
	 * @param string $order
	 * @param int $limit
	 * @param int $offset
	 * @return boolean | array
	 */
	public function get_sell_types($userid,$order,$limit,$offset){
		$this->db->order_by($order,"desc");
		$this->db->select("tid,tname,listorder")->where('userid',$userid);
		$query=$this->db->get('type',$limit,$offset);
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}
	
	
	/**
	 * 获得满足条件的产品--随机查询
	 * @param int $itemid
	 * @param int $catid
	 * @param int $limit
	 * @return boolean  | array
	 */
	public function get_sells_cate($itemid,$catid,$limit){		
		$sql="SELECT t1.itemid,t1.title,t1.thumb,t1.linkurl";
		$sql.=" FROM `wl_sell` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(itemid) FROM `wl_sell`)-(SELECT MIN(itemid) FROM `wl_sell`))+(SELECT MIN(itemid) FROM `wl_sell`)) AS itemid) AS t2";
		$sql.=" WHERE t1.itemid >= t2.itemid and t1.catid = {$catid} and t1.itemid <> {$itemid}";
		$sql.=" ORDER BY t1.itemid LIMIT {$limit}";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}
	
	
	/**
	 * 获得前几个热门产品
	 * @param string $order
	 * @param int $limit
	 * @return boolean  | array
	 */
	public function get_hot_products($order,$limit){
		$this->db->order_by($order,"desc")->select("itemid,title,unit,minprice,currency,minamount,hits,thumb,linkurl");
		$query=$this->db->get('sell',$limit);
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}
	
	
	/**
	 * 获得某个条件下的信息列表
	 * @param int $catid
	 * @param int $limit
	 * @param string $table
	 * @param string $order
	 * @return boolean  | array
	 */
	public function get_sell_newest($catid = null,$order = null,$limit = null){
		if(!empty($catid)){
			$newestlist = $this->findAll("sell",array("catid"=>$catid),$order,'catid,itemid,title,edittime,adddate,linkurl,company',$limit);
			return $newestlist;
		}else {
			$newestlist = $this->findAll("sell",'',$order,'catid,itemid,title,edittime,adddate,linkurl,company',$limit);
			return $newestlist;
		}
	
	}
	
	
	/**
	 * 查看供销商其他的产品
	 * @param int $itemid
	 * @return array | boolean
	 */
	public function get_other_products($itemid)
	{
		$findsell = $this->find("sell",array("itemid"=>$itemid));
		if($findsell){
			$comlist = $this->findAll("sell",array("username"=>$findsell['username']),'hits desc','','0,6');
			return $comlist;
		}else {
			return FALSE;
		}
	
	}
	

	/**
	 * 查看相关产品
	 * @param array $itemid
	 * @return array | boolean
	 */
	public function get_recommend_pro($itemid)
	{
		$getids = implode(",",$itemid);
		$prolist = $this->findAll("sell","itemid in({$getids})");
		if($prolist){
			$sell_data = $this->findAll("sell_data","itemid in({$getids})");
			foreach($sell_data as $k => $v){
				$prolist[$k]['sell_content'] = $v['content'];
			}
			return $prolist;
		}else{
			return FALSE;
		}
		
	}
    /**
     * 查看相关产品
     * @param array $itemid
     * @return array | boolean
     */

    public function sell_find($itemid)
    {
        $sell = $this->linker()->find("sell",array('itemid'=>$itemid));
        return $sell;
    }

    /**
     * 添加商品
     * @param $post
     * @return bool
     */
    public function addSell($post){
        $sell =  $this->creatData($post);

        $sell['ip'] = $this->input->ip_address();
        $sell['edittime'] = time();
        $sell['editdate'] = date('Y-m-d');
        $sell['addtime'] = time($post['adddate']);
        $sell['linkurl']=preg_replace("/[^a-zA-z0-9]+/","-",$post['title']);
        if($this->db->insert($this->mainTable,$sell)){
            $itemid = mysql_insert_id();
            $array = array(
                'itemid'=>$itemid,
                'content'=>$post['content']
            );

            //添加属性
            $option = $post['option'];
            foreach($option as $k=>$v){
                $this->db->select('id');
                $this->db->where(array('oid'=>$k,'value'=>$v,'catid'=>$post['catid']));
                $query = $this->db->get('wl_category_default_option');

                $query1 = $this->db->get_where('wl_category_default_option',array('value'=>$v));

                if($query->num_rows()>0){
                    $re = $query->row_array();

                    $this->db->set('num','num+1',false);
                    $this->db->where('id',$re['id']);
                    $this->db->update('wl_category_default_option');

                    $optionValue = array(
                        'value'=>$v,
                        'oid'=>$k,
                        'catid'=>$post['catid'],
                        'itemid'=>$itemid,
                        'did'=>$re['id']
                    );

                    $this->db->insert('wl_category_value',$optionValue);

                }elseif($query1->num_rows()>0){
                    $re = $query->row_array();

                    $optionArray=array(
                        'value'=>$v,
                        'oid'=>$k,
                        'catid'=>$post['catid'],
                        'num'=>'1',
                        'id'=>$re['id']
                    );

                    $re = $this->addDefaultOption($optionArray);
                    if($re){
                        $optionValue = array(
                            'value'=>$v,
                            'oid'=>$k,
                            'catid'=>$post['catid'],
                            'itemid'=>$itemid,
                            'did'=>$re
                        );

                        $this->db->insert('wl_category_value',$optionValue);

                    }

                }else{                           //新增default_option

                    $optionArray=array(
                        'value'=>$v,
                        'oid'=>$k,
                        'catid'=>$post['catid'],
                        'num'=>'1'
                    );

                    $re = $this->addDefaultOption($optionArray);

                    if($re){
                        $optionValue = array(
                            'value'=>$v,
                            'oid'=>$k,
                            'catid'=>$post['catid'],
                            'itemid'=>$itemid,
                            'did'=>$re
                        );

                        $this->db->insert('wl_category_value',$optionValue);

                    }

                }
            }

            //插入pptword
            $query = $this->db->get_where('wl_category_value',array('itemid'=>$itemid));
            $re = $query->result_array();
            $pptword = '';
            foreach($re as $v){
                $pptword .= $v['id'].",";
            }
            $pptword = substr($pptword,0,-1);

            $this->db->update('wl_sell',array('pptword'=>$pptword),array('itemid'=>$itemid));

            if($this->db->insert('wl_sell_data',$array)){
                $this->db->set("item","item+1",FALSE)->where("catid",$sell['catid'])->update("category");
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 添加 default_option
     * @param $arr
     * @return bool
     */
    public function addDefaultOption($arr){
        if(!$arr['id']) {

            $sql = "select max(id) as mid from wl_category_default_option";
            $query = $this->db->query($sql);
            $re = $query->row_array();

            $arr['id'] = $re['mid'] + 1;
        }
        if($this->db->insert('wl_category_default_option',$arr)){
          return $arr['id'];
        }else{
            return false;
        }

    }
    }