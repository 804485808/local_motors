<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_option_model extends MY_Model{

    function __construct(){
        parent::__construct();
    }


    /**
     * 关联表
     * @var array
     */
    protected $_link = array(
        'CategoryValue'=>array(
            'table'=>'wl_category_value',
            'selfKey'=>'oid',
            'otherKey'=>'oid'
        ),
        'Category'=>array(
            'table'=>'wl_category',
            'selfKey'=>'catid',
            'otherKey'=>'catid'
        )
    );

    /**
     * 查询sell公共方法
     * @param string $files  查询字段
     * @param string $where  条件
     * @param string $limit  limit
     * @param string $order  排序
     * @param int    $type   1：返回一条一维数据 0:默认返回二维数组
     * @return array 查询结果
     */
    public function getOptionCommon($files='*',$where='',$order='',$limit='',$type=0){
        $sql = "SELECT ".$files;
        $sql .= " FROM wl_category_option";
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
            return $query->result_array();
        }else{
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
    public function getOptionCommonLink($files='*',$manTable,$link,$where='',$order='',$limit='',$type=0){
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
     * 查询分类下面的Option
     * @param $catid 分类id
     * @return array
     */
    public function getCategoryOption($catid,$limit){
        return $this->getOptionCommon('oid,name',"catid='{$catid}'",'',$limit);
    }


	
	function category_option_find_all($conditions = null, $sort = null, $fields = null,$limit = null,$category_conditions = array("condition"=>"","sort"=>"","fields"=>"","limit"=>"")){
		$result = $this->findAll("category_option",$conditions,$sort,$fields,$limit);
		if($result){
			foreach($result as $k=>$v){
				if(!empty($category_conditions['condition'])){
						if(is_array($category_conditions['condition'])){
							$fcondition = array('oid'=>$v['oid']) + $category_conditions['condition'];
						}else{
							$fcondition = "oid = '{$v['oid']}' AND {$category_conditions['condition']}";
						}
				}else{
					$fcondition = array('oid'=>$v['oid']);
				}
				$result[$k]['category_value'] = $this->findAll("category_value",$fcondition,$category_conditions['sort'],$category_conditions['fields'],$category_conditions['limit']);
			}
		}else{
			return FALSE;
		}
		
		
		return $result;
	}

	
	function find($conditions = null, $sort = null, $fields = null,$category_conditions = array("condition"=>"","sort"=>"","fields"=>"","limit"=>"")){
		if( $record = $this->findAll($conditions, $sort, $fields, 1,$category_conditions) ){
			return array_pop($record);
		}else{
			return FALSE;
		}
	}


	
}
