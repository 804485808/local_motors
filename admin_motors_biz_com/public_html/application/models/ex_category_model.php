<?php
class Ex_category_model extends MY_Model {

	
    function __construct()
    {
		parent::__construct();
					   
    }

	
	/**
	 *  根据catid获得分类信息
	 * @param int $catid
	 * @return boolean array
	 */
	public function get_cates($catid){
		$this->db->select('catname,linkurl,arrparentid,parentid')->from('category')->where('catid',$catid);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}
	
	
	/**
	 * 获得某产品的属性及其值
	 * @param int $itemid
	 * @param int $oid
	 * @return boolean  array
	 */
	public function get_option_value($itemid,$oid){
		$this->db->select("category_option.oid,name,category_value.value")->from('category_value')->where(array('category_value.oid'=>$oid,'category_value.itemid'=>$itemid));
		$this->db->join('category_option','category_value.oid = category_option.oid','left');
		//print_r($this->db->last_query());
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}
		
	/**
	 * 获得category 表里某catid下 子类的部分信息
	 * @param int $pid
	 * @param string $order
	 * @return boolean  |   array
	 */
	public function get_son_cates($pid,$order='letter'){
		$this->db->order_by($order,"asc");
		$this->db->select('catid,catname,linkurl,letter,parentid,arrchildid')->from('category')->where('parentid',$pid);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}else {
			return FALSE;
		}
	}
	
}