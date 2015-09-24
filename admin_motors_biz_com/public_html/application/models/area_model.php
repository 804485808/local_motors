<?php
class Area_model extends MY_Model {

	
    function __construct()
    {
		parent::__construct();
					   
    }

	/**
	 *  获得地区信息
	 * @return array  返回地区信息
	 */
	public function area_find_all(){
        $arr = $this->findAll("area");
        return $arr;
	}
}