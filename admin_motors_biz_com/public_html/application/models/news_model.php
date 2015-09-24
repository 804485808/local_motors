<?php
class News_model extends MY_Model{

    function __construct()
    {
        parent::__construct();
    }

    public  $mainTable = 'wl_news';

    /**
     * 关联表
     * @var array
     */
    protected $_link = array(
        'CategoryNew' => array(
            'table' => 'wl_category_new',
            'selfKey' => 'catid',
            'otherKey' => 'catid'
        ),
        'NewsData'=>array(
            'table'=>'wl_news_data',
            'selfKey'=>'itemid',
            'otherKey'=>'itemid'
        ),
        'Member' => array(
            'table' => 'wl_member',
            'selfKey' => 'userid',
            'otherKey' => 'userid'
        ),
        'NewsReview' =>array(
            'table' => 'wl_news_review',
            'selfKey'=>'itemid',
            'otherKey'=>'itemid'
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
     * 查询news公共方法
     * @param string $files 查询字段
     * @param string $where 条件
     * @param string $limit limit
     * @param string $order 排序
     * @param int $type 1：返回一条一维数据 0:默认返回二维数组
     * @return array 查询结果
     */
    public function getNewsCommon($files = '*', $where = '', $order = '', $limit = '', $type = 0)
    {
        $sql = "SELECT " . $files;
        $sql .= " FROM ".$this->mainTable;
        if ($where) {
            $sql .= " WHERE " . $where;
        }

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        if ($limit) {
            $sql .= " LIMIT " . $limit;
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
     * @param string $files 查询字段
     * @param array $manTable 主表 array('表名'=>'别名')
     * @param array $link 关联表 array('$_link'=>'别名')
     * @param string $where 查询条件
     * @param string $order 排序
     * @param string $limit limit
     * @param int $type 1：返回一条一维数据 0:默认返回二维数组
     * @return array
     */
    public function getNewsCommonLink($files = '*', $manTable, $link, $where = '', $order = '', $limit = '', $type = 0)
    {
        $manTableName = key($manTable);
        $manTableAlse = $manTable[$manTableName];
        $sql = "SELECT " . $files;
        $sql .= " FROM " . $manTableName . " AS " . $manTableAlse;

        if ($link) {
            while ($key = key($link)) {
                $sql .= " LEFT JOIN " . $this->_link[$key]['table'] . " AS " . $link[$key] . " ON " . $link[$key] . "." . $this->_link[$key]['otherKey'] . " = " . $manTableAlse . "." . $this->_link[$key]['selfKey'];
                next($link);
            }
        }

        if ($where) {
            $sql .= " WHERE " . $where;
        }

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        if ($limit) {
            $sql .= " LIMIT " . $limit;
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
     * 查询news列表
     * @param $limit 分页
     * @return array
     */
    public function getNewsList($where,$limit){
        $re = $this->getNewsCommonLink('t1.*,t2.catname,t3.content,count(t4.itemid) as num',array('wl_news'=>'t1'),array('CategoryNew'=>'t2','NewsData'=>'t3','NewsReview'=>'t4'),$where.' group by t1.itemid','itemid desc',$limit);
        return $re;
    }

    /**
     * 添加修改news
     * @return bool
     */
    public function addNews(){
        $sear_arr=$this->input->post();

        if($sear_arr['post']){

            $mainData = $this->creatData($sear_arr['post']);
            //添加
            if(!$mainData['itemid']) {
                $mainData['addtime'] = time();
                $mainData['status'] = 3;
                $mainData['keyword'] = mb_substr($_POST['post']['content'], 0, 300, 'utf-8');
                $mainData['ip'] = $_SERVER["REMOTE_ADDR"];

                if ($this->db->insert('news', $mainData)) {

                    $fromid = mysql_insert_id();
                    $insert_content_arr = array(
                        'itemid' => $fromid,
                        'content' => $_POST['post']['content']
                    );
                    if ($this->db->insert('news_data', $insert_content_arr)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }

                //修改
            }else{
                $itemid = $mainData['itemid'];
                unset($mainData['itemid']);

                if($this->db->update('news',$mainData,array('itemid'=>$itemid))){

                    $fromid = mysql_insert_id();
                    $insert_content_arr = array(
                        'content' => $_POST['post']['content']
                    );

                    if ($this->db->update('news_data', $insert_content_arr,array('itemid'=>$itemid))) {
                        return true;
                    } else {
                        return false;
                    }

                }else{
                    return false;
                }
            }

        }
    }

    /**
     * 获取咨询详细信息
     * @param $itemid
     * @return array
     */
    public function getNewsDetail($itemid){
        return $this->getNewsCommonLink('t1.itemid,t1.catid,t1.title,t1.author,t1.userid,t1.thumb,t2.content,t3.catname',array('wl_news'=>'t1'),array('NewsData'=>'t2','CategoryNew'=>'t3'),"t1.itemid='{$itemid}'",'','',1);
    }



}