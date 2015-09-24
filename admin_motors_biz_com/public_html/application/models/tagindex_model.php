<?php
class Tagindex_model extends MY_Model {

	
    function __construct()
    {
		parent::__construct();
					   
    }

	
    /**
     * 根据条件获得前几个关键词
     * @param int $limit
     * @param string $order
     * @return boolean   |   array
     */
	public function get_hot_tagindex($limit=10,$order='addtime'){
		$this->db->order_by($order,"desc");
		$this->db->select("tag,linkurl");
		$query=$this->db->get('tagindex',$limit,0);
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}

	
}