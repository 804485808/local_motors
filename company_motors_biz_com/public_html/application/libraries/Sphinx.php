<?php
class Sphinx {

    public  $CI;
    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('Sphinxclient','','sphinx1');

        $this->CI->sphinx1->SetServer ('127.0.0.1', 9312);
        $this->CI->sphinx1->SetConnectTimeout(1);
        $this->CI->sphinx1->SetArrayResult(true);
    }

    /**
     * Sphinx 公共方法
     * @param $query 搜索条件
     * @param $index 索引
     * @param $limit 查询条数
     * @param int $match 匹配模式
     * @param int $sort  排序模式
     */
    public function setSphinx($query,$index,$limit,$match=SPH_MATCH_ANY,$sort=SPH_SORT_RELEVANCE,$groupBy=''){

        $this->CI->sphinx1->ResetFilters();
        //$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->CI->sphinx1->SetMatchMode($match);
        $this->CI->sphinx1->SetSortMode($sort);
        $this->CI->sphinx1->SetLimits(0,$limit);
        if($groupBy){
            $this->CI->sphinx1->SetGroupBy("totalcc",SPH_GROUPBY_ATTR,"@group desc");
        }
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

    /**
     * 查询关键词
     * @param $query
     * @return mixed
     */
    public function getTagindex($query){

        return $this->setSphinx($query,'tagindex',5,'SPH_MATCH_ANY','SPH_SORT_RELEVANCE',1);
    }

    /**
     * 查询商品
     * @param $query
     * @return mixed
     */
    public function getSellTotal($query){
        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->ResetGroupBy();
        return $this->setSphinx($query,'sell_total',6);
    }

    /**
     * 分类下的商品
     * @param $limit
     * @param $catid
     * @param $did
     */
    public function getCategorySell($page,$page_size,$catid,$did){

        $this->CI->sphinx1->ResetFilters();
        //$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_FULLSCAN);
        $this->CI->sphinx1->SetSortMode(SPH_SORT_RELEVANCE);
        $this->CI->sphinx1->SetLimits($page,$page_size);

        if($catid){
            $this->CI->sphinx1->SetFilter('catid',$catid);
        }

        if($did){
            $this->CI->sphinx1->SetFilter('did',$did);
        }

        $res = $this->CI->sphinx1->Query('','sell_total');
       return $res;
    }

    /**
     * 获取分类下的属性
     * @param $page
     * @param $page_size
     * @return mixed
     */
    public function getCategoryAttr($page,$page_size,$catid,$did){

        $this->CI->sphinx1->ResetFilters();
        //$this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_FULLSCAN);
        $this->CI->sphinx1->SetSortMode(SPH_SORT_RELEVANCE);


        if($catid){
            $this->CI->sphinx1->SetFilter('catid',$catid);
        }

        if($did){
            $this->CI->sphinx1->SetFilter('did',$did);
        }

        $this->CI->sphinx1->ResetGroupBy();
        $this->CI->sphinx1->SetLimits($page,$page_size);
        $this->CI->sphinx1->SetGroupBy("catid",SPH_GROUPBY_ATTR,"@count desc");
        $this->CI->sphinx1->AddQuery("","sell_total");

        $this->CI->sphinx1->ResetGroupBy();
        $this->CI->sphinx1->SetGroupBy("did",SPH_GROUPBY_ATTR,"@count desc");
        $this->CI->sphinx1->SetLimits($page,$page_size);
        $this->CI->sphinx1->AddQuery('','sell_total');
        $res = $this->CI->sphinx1->RunQueries();
        return $res;
    }

    public function test($word){

        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_EXTENDED2);
        //$this->CI->sphinx1->SetMatchMode(SPH_MATCH_FULLSCAN);
        $this->CI->sphinx1->SetSortMode(SPH_SORT_RELEVANCE);

        $this->CI->sphinx1->SetGroupBy("catid",SPH_GROUPBY_ATTR,"@count desc");
        $res = $this->CI->sphinx1->Query($word,"sell_total");

        return $res;
    }

    public function match_catid($word,$catid){

        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->ResetGroupBy();
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_EXTENDED2);
        //$this->CI->sphinx1->SetMatchMode(SPH_MATCH_FULLSCAN);
        $this->CI->sphinx1->SetSortMode(SPH_SORT_RELEVANCE);
        $this->CI->sphinx1->SetFilter("catid",$catid);
        $this->CI->sphinx1->SetGroupBy("username",SPH_GROUPBY_ATTR,"@count desc");
        $res = $this->CI->sphinx1->Query($word,"sell_total");
        dump($this->CI->sphinx1->GetLastError());
        return $res;
    }

/**
     * username查找商品
     * @param $query
     * @return mixed
     */
    public function getUserItemid($query){
        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->ResetGroupBy();
        return $this->setSphinx($query,'sell_user',6,SPH_MATCH_PHRASE);
    }

    /**
     * 根据关键词搜索
     * @param $query
     * @param $page
     * @param $page_size
     * @param $catid
     * @param $did
     * @return mixed
     */
    public function getTagAttr($query,$page,$page_size){

        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_EXTENDED2);
//        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_FULLSCAN);
        $this->CI->sphinx1->SetSortMode(SPH_SORT_RELEVANCE);


        $this->CI->sphinx1->ResetGroupBy();
        $this->CI->sphinx1->SetLimits($page,$page_size);
        $this->CI->sphinx1->SetGroupBy("catid",SPH_GROUPBY_ATTR,"@count desc");
        $this->CI->sphinx1->AddQuery("\"{$query}\"/2","sell_total");

        $this->CI->sphinx1->ResetGroupBy();
        $this->CI->sphinx1->SetGroupBy("did",SPH_GROUPBY_ATTR,"@count desc");
        $this->CI->sphinx1->SetLimits($page,$page_size);
        $this->CI->sphinx1->AddQuery("\"{$query}\"/2",'sell_total');
        $res = $this->CI->sphinx1->RunQueries();
        return $res;
    }

    /**
     * 分类下的商品
     * @param $limit
     * @param $catid
     * @param $did
     */
    public function getTagSell($query,$page,$page_size,$catid,$did){

        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->CI->sphinx1->SetSortMode(SPH_SORT_RELEVANCE);
        $this->CI->sphinx1->SetLimits($page,$page_size);

        if($did){
            $this->CI->sphinx1->SetFilter('did',$did);
        }

        if($catid){
            $this->CI->sphinx1->SetFilter('catid',$catid);
        }

        $res = $this->CI->sphinx1->Query("\"{$query}\"/2",'sell_total');
        return $res;
    }

    /**
     * 查询关键词
     * @param $catname
     */
    public function getCategoryTag($catname){

        $this->CI->sphinx1->ResetFilters();
        $this->CI->sphinx1->ResetGroupBy();
        $this->CI->sphinx1->SetLimits(0,5);
        $this->CI->sphinx1->SetMatchMode(SPH_MATCH_EXTENDED2);
        //$this->sphinx->SetGroupBy("totalcc",SPH_GROUPBY_ATTR,"@group desc");
        $re = $this->CI->sphinx1->Query("\"{$catname}\"/2", "tagindex");
        return $re;
    }


}