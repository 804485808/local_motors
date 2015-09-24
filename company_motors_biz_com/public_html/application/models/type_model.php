<?php
class Type_model extends MY_Model{

    function __construct(){
        parent::__construct();
    }

    public $mainTable = 'wl_type';

    /**
     * 关联表
     * @var array
     */
    protected $_link = array(
        'Sell'=>array(
            'table'=>'wl_sell',
            'selfKey'=>'tid',
            'otherKey'=>'mycatid'
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
    public function getTypeCommon($files='*',$where='',$order='',$limit='',$type=0){
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
    public function getTypeCommonLink($files='*',$manTable,$link,$where='',$order='',$limit='',$type=0){

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
     * 查询Type
     * @param $userid
     * @return array
     */
    public function getMemberType($userid){
        return $this->getTypeCommon('*',"userid='{$userid}'","listorder desc");
    }

    /**
     * 获取自定义下的商品
     * @param $userid
     * @return array
     */
    public function getTypeSell($userid){
        $re = $this->getTypeCommonLink('t1.tname,t1.tid,t2.subtitle,t2.title,t2.thumb,t2.username,t2.linkurl,t2.linkurl,t2.itemid,t2.pptword',array('wl_type'=>'t1'),array('Sell'=>'t2'),"t1.userid={$userid} and t2.status=3","t2.hits desc");
        $arr = array();
        foreach($re as $k=>$v){
            $arr[$v['tname']][] = $v;
        }
        return $arr;
    }

    /**
     * 分页
     * @param $userid
     * @param $limit
     * @return array
     */
    public function getTypeSellPage($where,$limit){
        $re = $this->getTypeCommonLink('t1.tname,t2.subtitle,t2.title,t2.thumb,t2.username,t2.linkurl,t2.linkurl,t2.itemid,t2.pptword',array('wl_type'=>'t1'),array('Sell'=>'t2'),$where,"t2.hits desc",$limit);
        return $re;
    }

    /**
     * 统计所有商品
     * @param $userid
     * @return array
     */
    public function getCountTypeSell($userid){
        $re = $this->getTypeCommonLink('count(*) as num',array('wl_type'=>'t1'),array('Sell'=>'t2'),"t1.userid='{$userid}' and t2.status=3","",'',1);
        return $re;
    }

    public function getTypeSellOtpion($userid){
        $sql = "select t1.*,t2.itemid,t2.pptword from wl_type as t1 LEFT JOIN wl_sell as t2 on t1.tid=t2.mycatid where t1.userid";
    }
}