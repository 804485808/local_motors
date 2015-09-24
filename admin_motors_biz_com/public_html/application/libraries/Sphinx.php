<?php
class Sphinx {

    public  $CI;
    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('Sphinxclient','','sphinx1');
    }

    /**
     * Sphinx 公共方法
     * @param $query 搜索条件
     * @param $index 索引
     * @param $limit 查询条数
     * @param int $match 匹配模式
     * @param int $sort  排序模式
     */
    public function setSphinx($query,$index,$limit,$match=SPH_MATCH_ANY,$sort=SPH_SORT_RELEVANCE){
        $this->CI->sphinx1->SetServer ('127.0.0.1', 9312);
        $this->CI->sphinx1->SetConnectTimeout(1);
        $this->CI->sphinx1->SetArrayResult(true);
        $this->CI->sphinx1->ResetFilters();
        //$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->CI->sphinx1->SetMatchMode($match);
        $this->CI->sphinx1->SetSortMode($sort);
        $this->CI->sphinx1->SetLimits(0,$limit);
        $res = $this->CI->sphinx1->Query($query, $index);
        return $res;
    }

    /**
     * 查询品牌
     * @param $query
     */
    public function getBrand($query){

        return $this->setSphinx($query,"brand",'10');
    }

    /**
     * 查询会员
     * @param $query
     * @return mixed
     */
    public function getMember($query){
        return $this->setSphinx($query,"member",'10');
    }


}