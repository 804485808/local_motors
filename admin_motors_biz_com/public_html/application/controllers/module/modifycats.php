<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modifycats extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper("getstr");
	}

	function showcats(){
		$data['catid'] = $this->uri->rsegment(3,0);	
		$main_cate = $this->comm->findAll("category",array("parentid"=>0));
		$data['main_cate'] = $main_cate;
		$this->load->view('module/category/modifycats',$data);
	}
	
	/**
	* 显示下级类目
	* 类目的多级联动功能
	*/
	function subcategory(){
		$catid = $this->uri->rsegment(3,0);
		$catid = intval($catid);
		
		$n = intval($this->uri->rsegment(4,0));
		$tcat = $this->comm->find("category",array("catid"=>$catid));
		$parents = array();
		$tmp = '';
		if($tcat['parentid'] == 0){
			$parents = $this->comm->findAll("category",array("parentid"=>0));
			$tmp.='<select onchange="load_category('.$n.',this.value)" multiple="multiple" size="20" ';
			if($n == 1){$tmp .= 'ondblclick="op(this.value);"';}
			$tmp .= '>';
			foreach($parents as $v){
				if($catid==$v['catid']){
					$tmp.='<option value="'.$v['catid'].'" selected>'.$v['catname'].'</option>';
				}else{
					$tmp.='<option value="'.$v['catid'].'">'.$v['catname'].'</option>';
				}
			}
			$tmp.='</select>';
		}else{
			//$arrparentid = explode(",",$tcat['arrparentid']);
			$arrparentid = $this->getpcatids($catid);
			if($key = array_search($catid,$arrparentid,true)){
				unset($arrparentid[$key]);
			}
			foreach($arrparentid as $pid){
				$parents[$pid] = $this->comm->findAll("category",array("parentid"=>$pid));
			}
			foreach($parents as $k => $v){
				$tmp.='<select onchange="load_category('.$n.',this.value)" multiple="multiple" size="20" ';
				if($n == 1){$tmp .= 'ondblclick="op(this.value);"';}
				$tmp .= '>';
				foreach($v as $c){
					foreach($arrparentid as $p){
						if($p==$c['catid']){
							$tmp.='<option value="'.$c['catid'].'" selected>'.$c['catname'].'</option>';
							continue 2;
						}
					}
				
					if($catid==$c['catid']){
						$tmp.='<option value="'.$c['catid'].'" selected>'.$c['catname'].'</option>';
					}else{
						$tmp.='<option value="'.$c['catid'].'">'.$c['catname'].'</option>';
					}
				}
				$tmp.='</select>';
			}
		}
		
		$child = array();
		$child = $this->comm->findAll("category",array("parentid"=>$catid));
		
		if($tcat['child']==1){
			$tmp.='<select onchange="load_category('.$n.',this.value)" multiple="multiple" size="20" ';
			if($n == 1){$tmp .= 'ondblclick="op(this.value);"';}
			$tmp .= '>';
			foreach($child as $s){
				$tmp.='<option value="'.$s['catid'].'">'.$s['catname'].'</option>';
			}
			$tmp.='</select>';
		}
		
		header('Content-Type:text/html;charset=utf-8');
		echo($tmp);
		
	}
	
	
	function renamecat(){
		$tname = trim($this->input->post("tname",TRUE));
		$tname = strtr($tname,array("&amp;"=>"&"));
		$tid = $this->input->post("tid",TRUE);		
		if(strlen($tname)>50){
			echo json_encode(array('code'=>0,"msg"=>'修改失败，类名过长(>50字符)！'));
			die();
		}
		if(empty($tname)){
			echo json_encode(array('code'=>0,"msg"=>'修改失败，类名不能为空！'));
			die();
		}
		$findcat = $this->comm->find("category",array("catid"=>$tid));
		if(!$findcat){
			echo json_encode(array('code'=>0,"msg"=>'修改失败，被修改的类别不存在！'));
		}else{
			if($findcat['catname'] == $tname){
				echo json_encode(array('code'=>0,"msg"=>'修改失败，修改后的类名和修改前的类名是一样的！'));
				die();
			}
			
			$findsamecat = $this->comm->find("category",array("catname"=>$tname,"parentid"=>$findcat['parentid']));
			if($findsamecat){
				echo json_encode(array('code'=>0,"msg"=>'修改失败，在此父类下已经存在这个类名！'));
				die();
			}
			$letter = strtoupper(substr($tname,0,1));
			$linkurl = preg_replace("/[^0-9a-z]/i","-",$tname);
			$linkurl = preg_replace("/(-)+/i","-",$linkurl);
			if(stripos($linkurl,"-") === 0){
				$linkurl = substr($linkurl,1);
			}
			$rs = $this->comm->update('category',array('catid'=>$tid),array('catname'=>$tname,'letter'=>$letter,'catdir'=>$linkurl,'linkurl'=>$linkurl));
			if($rs){
				$this->comm->update("brand_category",array("catid"=>$tid),array("catname"=>$tname));
				$this->comm->update("toplist_tag",array("catid"=>$tid),array("catname"=>$tname));
				echo json_encode(array('code'=>1,"msg"=>'恭喜你，修改成功！'));
			}else{
				echo json_encode(array('code'=>0,"msg"=>'Sorry，修改失败！'));
			}
		}
	}

	
	//将child=0的cat的arrchildid赋值为catid
	function addcat(){
		$parentid = intval($this->input->post("pcatid",TRUE));
		$catnames = $this->input->post("catnames",TRUE);
		if($parentid < 0){
			echo json_encode(array('code'=>0,"msg"=>'非法操作，请重试！'));
			die();
		}
		if(!$catnames){
			echo json_encode(array('code'=>0,"msg"=>'子分类信息未填写，请重试！'));
			die();
		}
		
		if($parentid == 0){
			$arrparentid = "0";
		}else{
			$thiscat = $this->comm->find("category",array("catid"=>$parentid));
			if(!$thiscat){
				echo json_encode(array('code'=>0,"msg"=>'被选择的上级类别不存在，请重试！'));
				die();
			}
			//$arrparentid = $thiscat['arrparentid'].",".$parentid;
			$arrparentid = $this->getpcatids($parentid);
			$arrparentid = join(",",$arrparentid);
			if(!$thiscat['child']){
				$this->comm->update("category",array("catid"=>$parentid),array("child"=>1));
			}
		}

		$catnames=str_replace(array("\r\n", "\n", "\r"), "<br />", $catnames);
		$catnames=explode("<br />",$catnames);
		$catnames=array_unique($catnames);
		$j = 0;
		$cats = "";
		foreach ($catnames as $v){
			$v = strtr($v,array("&amp;"=>"&"));
			$catlen = strlen(trim($v));
			if ($catlen > 50 || !$catlen){continue;}
			$createdata = array();
			$createdata['catname']=ucwords(strtolower(getstr($v,50,0,0,-1)));
			if (!$createdata['catname']){continue;}
			$findcat = $this->comm->find("category",array("catname"=>$createdata['catname'],"parentid"=>$parentid));
			if($findcat){continue;}
			$createdata['letter'] = strtoupper(substr($createdata['catname'],0,1));
			$createdata['linkurl'] = preg_replace("/[^0-9a-z]/i","-",$createdata['catname']);
			$createdata['linkurl'] = preg_replace("/(-)+/i","-",$createdata['linkurl']);
			$createdata['parentid'] = $parentid;
			$createdata['arrparentid'] = $arrparentid;
			$createdata['child'] = 0;

			$catid = $this->comm->create("category",$createdata);
			if($catid){
				$cats .= "\r\n".$createdata['catname'];
				$j++;
				$this->comm->update("category",array("catid"=>$catid),array("arrchildid"=>$catid));
				$this->db->query("update `zt_category` set arrchildid = concat(arrchildid,',{$catid}') where catid in ({$arrparentid})");
			}
		}

		if($j == count($catnames)){
			echo json_encode(array('code'=>1,"msg"=>"添加成功！\r\n成功的类别有：\r\n".$cats));
		}else{
			echo json_encode(array('code'=>1,"msg"=>"部分子类别添加失败，可能是字符过长、类别已存在等原因造成的！！\r\n成功的类别有：\r\n".$cats));
		}
	}
	
	function delcat(){
		$catid = intval($this->input->post("catid",true));
		if($catid <= 0){
			echo json_encode(array("code"=>0,"msg"=>"请先选择类别！"));
			die();
		}
		$findcat = $this->comm->find("category",array("catid"=>$catid));
		if(!$findcat){
			echo json_encode(array("code"=>0,"msg"=>"此类别不存在，请重试！"));
			die();
		}

		$arrchildids = $this->getsubcatids($catid);
		$arrchildids = array_reverse($arrchildids);
		$j = 0;
		foreach($arrchildids as $cid){
			$tempcat = $this->comm->find("category",array("catid"=>$cid));
			if(!$tempcat){
				//echo json_encode(array("code"=>0,"msg"=>"not find this cat :".$cid));
				//die();
				continue;
			}
			if(!$tempcat['child']){
				$this->comm->delete("category",array("catid"=>$cid));
				if(mysql_affected_rows()){
					$sqlstr = "";
					$sqlstr .= "update zt_article set catid = {$tempcat['parentid']} where catid = {$cid};\r\n";
					$sqlstr .= "delete from zt_brandtotal where catid = {$cid};\r\n";
					$sqlstr .= "update zt_category_buzzillons set matchid = 0 where matchid = {$cid};\r\n";
					$sqlstr .= "update zt_category_dealam set matchid = 0 where matchid = {$cid};\r\n";
					$sqlstr .= "update zt_category_ebay set matchid = 0 where matchid = {$cid};\r\n";
					$sqlstr .= "update zt_category_other set matchedid_0 = 0 where matchedid_0 = {$cid};\r\n";
					$sqlstr .= "update zt_category_other set matchedid_1 = 0 where matchedid_1 = {$cid};\r\n";
					$sqlstr .= "delete from zt_coupon_relation where catid = {$cid};\r\n";
					$sqlstr .= "update zt_onlinestore set catid = 0 where catid = {$cid};\r\n";
					$sqlstr .= "update zt_article set catid = {$tempcat['parentid']},catname = \"{$tempcat['catname']}\" where catid = {$cid};\r\n";
					$sqlstr .= "update zt_products set catid = 0 where catid = {$cid};\r\n";
					$sqlstr .= "update zt_subslist set catid = 0 where catid = {$cid};\r\n";
					$sqlstr .= "delete from zt_subslist where bid = 0 and catid = 0 and pid = 0;\r\n";
					$sqlstr .= "update zt_toplist_tag set catid = {$tempcat['parentid']},catname = \"{$tempcat['catname']}\" where catid = {$cid};\r\n";
					$sqlpath = "./dealsql.txt";
					$fhandle=fopen($sqlpath,"a");
					fwrite($fhandle,$sqlstr);
					fclose($fhandle);
					
					$this->comm->update("article",array("catid"=>$cid),array("catid"=>$tempcat['parentid']));
					$this->comm->delete("brandtotal",array("catid"=>$cid));
					$this->comm->delete("brand_category",array("catid"=>$cid));
					$this->comm->update("category_buzzillons",array("matchid"=>$cid),array("matchid"=>0));
					$this->comm->delete("category_data",array("catid"=>$cid));//先备份
					$this->comm->update("category_dealam",array("matchid"=>$cid),array("matchid"=>0));
					$this->comm->update("category_ebay",array("matchid"=>$cid),array("matchid"=>0));
					$this->comm->update("category_other",array("matchedid_0"=>$cid),array("matchedid_0"=>0));
					$this->comm->update("category_other",array("matchedid_1"=>$cid),array("matchedid_1"=>0));
					$this->comm->delete("coupon_relation",array("catid"=>$cid));
					$this->comm->update("onlinestore",array("catid"=>$cid),array("catid"=>0));
					$this->comm->update("products",array("catid"=>$cid),array("catid"=>0));
					$this->comm->update("subslist",array("catid"=>$cid),array("catid"=>0));
					$this->comm->delete("subslist",array("bid"=>0,"catid"=>0,"pid"=>0));
					$this->comm->update("toplist_tag",array("catid"=>$cid),array("catid"=>$tempcat['parentid'],"catname"=>$tempcat['catname']));
					
					
					$temppcats = $this->comm->findAll("category","catid in ({$tempcat['arrparentid']})","catid desc");
					foreach($temppcats as $v){
						$tpids = explode(",",$v['arrchildid']);
						if($key1 = array_search($cid,$tpids,true)){
							unset($tpids[$key1]);
						}
						asort($tpids);						
						$child = count($tpids)==1 ? 0 : 1;
						$tpids = join(",",$tpids);
						$this->comm->update("category",array("catid"=>$v['catid']),array("child"=>$child,"arrchildid"=>$tpids));
					}
					$j++;
				}
			}
		}
		//dump($this->db->queries);
		if($j == count($arrchildids)){
			echo json_encode(array('code'=>1,"msg"=>'删除成功！',"pcatid"=>$findcat['parentid']));
		}else{
			echo json_encode(array('code'=>1,"msg"=>'部分子类别删除失败，可能是类别同时被其他人占用或者删除等原因造成的！',"pcatid"=>$findcat['parentid']));
		}
	}
	
	function getsubcatids($catid = null){
		if(!$catid){
			return false;
		}
		$thiscat = $this->comm->find("category",array("catid"=>$catid));
		if(!$thiscat){
			return false;
		}
		
		$subcats = $this->comm->findAll("category","catid in ({$thiscat['arrchildid']}) and child = 0","","catid");
		$childids = array();
		foreach($subcats as $subcat){
			$rs = $this->getpcatids($subcat['catid'],$catid);
			if($rs){
				foreach($rs as $v){
					if(!in_array($v,$childids,true)){
						array_push($childids,$v);
					}
				}
			}
		}
		return $childids;
	}
	
	function getpcatids($catid = null, $topcid = 0, $pcats = array()){
		if(!$catid){
			return false;
		}
		if($catid == $topcid){
			return array($catid);
		}
		$rs = $this->comm->find("category",array("catid"=>$catid),"","parentid,arrparentid");
		if(!$rs){
			return false;
		}
		$arrparentids = explode(",",$rs['arrparentid']);
		if(!in_array($topcid,$arrparentids)){
			return false;
		}
		array_unshift($pcats,$catid);
		if($rs['parentid'] == $topcid){
			array_unshift($pcats,$rs['parentid']);
			return $pcats;
		}
		return $this->getpcatids($rs['parentid'],$topcid,$pcats);
	}
	
	function comcat(){		echo json_encode(array("code"=>0,"msg"=>"无法合并"));		die();
		$oricatid = intval($this->input->post("oricatid",true));
		$nowcatid = intval($this->input->post("nowcatid",true));
		if($oricatid <= 0 || $nowcatid <= 0){
			echo json_encode(array("code"=>0,"msg"=>"请先选择类别，再进行合并！"));
			die();
		}
		$findcat = $this->comm->find("category",array("catid"=>$oricatid));
		if(!$findcat){
			echo json_encode(array("code"=>0,"msg"=>"被合并的类别不存在，请重试！"));
			die();
		}
		if($oricatid == $nowcatid){
			echo json_encode(array("code"=>0,"msg"=>"被合并的类别和合并后的类别不能为同一类别！"));
			die();
		}
		
		$findcat_1 = $this->comm->find("category",array("catid"=>$nowcatid));
		if(!$findcat_1){
			echo json_encode(array("code"=>0,"msg"=>"被选择的合并后类别不存在，请重试！"));
			die();
		}

		$arrchildids = $this->getsubcatids($oricatid);
		$arrchildids = array_reverse($arrchildids);
		if(in_array($nowcatid,$arrchildids)){
			echo json_encode(array("code"=>0,"msg"=>"不能合到子类别里去！"));
			die();
		}
		$j = 0;
		
		foreach($arrchildids as $cid){
			$tempcat = $this->comm->find("category",array("catid"=>$cid));
			if(!$tempcat){
				//echo json_encode(array("code"=>0,"msg"=>"not find this cat :".$cid));
				//die();
				continue;
			}
			if(!$tempcat['child']){
				$this->comm->delete("category",array("catid"=>$cid));
				if(mysql_affected_rows()){
					
					$sqlstr = "";
					$sqlstr .= "update zt_article set catid = {$nowcatid} where catid = {$cid};\r\n";
					$sqlstr .= "update zt_brandtotal set catid = {$nowcatid} where catid = {$cid};\r\n";
					$sqlstr .= "update zt_category_buzzillons set matchid = {$nowcatid} where matchid = {$cid};\r\n";
					$sqlstr .= "update zt_category_dealam set matchid = {$nowcatid} where matchid = {$cid};\r\n";
					$sqlstr .= "update zt_category_ebay set matchid = {$nowcatid} where matchid = {$cid};\r\n";					
					$sqlstr .= "update zt_category_other set matchedid_0 = {$nowcatid} where matchedid_0 = {$cid};\r\n";
					$sqlstr .= "update zt_category_other set matchedid_1 = {$nowcatid} where matchedid_1 = {$cid};\r\n";					
					$sqlstr .= "update zt_coupon_relation set catid = {$nowcatid} where catid = {$cid};\r\n";
					$sqlstr .= "update zt_onlinestore set catid = {$nowcatid} where catid = {$cid};\r\n";
					$sqlstr .= "update zt_products set catid = {$nowcatid} where catid = {$cid};\r\n";
					$sqlstr .= "update zt_subslist set catid = {$nowcatid} where catid = {$cid};\r\n";
					$sqlstr .= "update zt_toplist_tag set catid = {$nowcatid},catname = \"{$findcat_1['catname']}\" where catid = {$cid};\r\n";
					$sqlpath = "./dealsql.txt";
					$fhandle=fopen($sqlpath,"a");
					fwrite($fhandle,$sqlstr);
					fclose($fhandle);
					
					$this->comm->update("article",array("catid"=>$cid),array("catid"=>$nowcatid));
					$this->comm->update("brandtotal",array("catid"=>$cid),array("catid"=>$nowcatid));
					$fbc = $this->comm->findAll("brand_category",array("catid"=>$nowcatid),"","bid");
					if($fbc){
						$bids = array();
						foreach($fbc as $f){
							$bids[] = $f['bid'];
						}
						$bids = array_unique($bids);
						$bids = join(",",$bids);
						$this->comm->update("brand_category","catid = {$cid} and bid not in ({$bids})",array("catid"=>$nowcatid,"catname"=>$findcat_1['catname']));
						$this->comm->delete("brand_category","catid = {$cid}");
					}
					
					$this->comm->update("category_buzzillons",array("matchid"=>$cid),array("matchid"=>$nowcatid));
					if(!$this->comm->find("category_data",array("catid"=>$nowcatid))){
						$this->comm->update("category_data",array("catid"=>$cid),array("catid"=>$nowcatid));//先备份
					}else{
						$this->comm->delete("category_data",array("catid"=>$cid));
					}
					
					$this->comm->update("category_dealam",array("matchid"=>$cid),array("matchid"=>$nowcatid));
					$this->comm->update("category_ebay",array("matchid"=>$cid),array("matchid"=>$nowcatid));
					$this->comm->update("category_other",array("matchedid_0"=>$cid),array("matchedid_0"=>$nowcatid));
					$this->comm->update("category_other",array("matchedid_1"=>$cid),array("matchedid_1"=>$nowcatid));
					$this->comm->update("coupon_relation",array("catid"=>$cid),array("catid"=>$nowcatid));//先备份
					$this->comm->update("onlinestore",array("catid"=>$cid),array("catid"=>$nowcatid));
					$this->comm->update("toplist_tag",array("catid"=>$cid),array("catid"=>$nowcatid,"catname"=>$findcat_1['catname']));
					$this->comm->update("products",array("catid"=>$cid),array("catid"=>$nowcatid));
					$this->comm->update("subslist",array("catid"=>$cid),array("catid"=>$nowcatid));
				
					$temppcats = $this->comm->findAll("category","catid in ({$tempcat['arrparentid']})","catid desc");
					foreach($temppcats as $v){
						$tpids = explode(",",$v['arrchildid']);
						unset($tpids[array_search($cid,$tpids)]);
						asort($tpids);						
						$child = count($tpids)==1 ? 0 : 1;
						$tpids = join(",",$tpids);
						$this->comm->update("category",array("catid"=>$v['catid']),array("child"=>$child,"arrchildid"=>$tpids));
					}
					$j++;
				}
			}
			//将本类别下的所有东西归到nowcatid下
		}
		//dump($this->db->queries);
		if($j == count($arrchildids)){
			echo json_encode(array('code'=>1,"msg"=>'合并成功！',"pcatid"=>$findcat['parentid']));
		}else{
			echo json_encode(array('code'=>1,"msg"=>'部分子类别合并失败，可能是类别同时被其他人占用或者删除等原因造成的！',"pcatid"=>$findcat['parentid']));
		}
		//dump($this->db->queries);
	}
	
	function test(){
		$rs = $this->comm->findAll("brand_category","","","distinct catid");
		$cats = array();
		foreach($rs as $v){
			$temp = $this->comm->find("category","catid = {$v['catid']}");
			if(!$temp){
				$cats[] = $v['catid'];
				$this->comm->delete("brand_category","catid = {$v['catid']}");
			}
		}
		dump($cats);
	}
	
	function movecat(){	
		$oricatid = intval($this->input->post("oricatid",true));
		$movecatid = intval($this->input->post("movecatid",true));
		if($oricatid <= 0 || $movecatid < 0){
			echo json_encode(array("code"=>0,"msg"=>"请先选择类别，再进行移动！"));
			die();
		}
		if($oricatid == $movecatid){
			echo json_encode(array("code"=>0,"msg"=>"被移动的类别和移动后的类别不能为同一类别！"));
			die();
		}
		
		$findcat = $this->comm->find("category",array("catid"=>$oricatid));
		if(!$findcat){
			echo json_encode(array("code"=>0,"msg"=>"待移动的类别不存在，请重试！"));
			die();
		}
		$findcat_1 = $this->comm->find("category",array("catid"=>$movecatid));
		if(!$findcat_1){
			if($movecatid == 0){
				$findcat_1 = array('catname'=>"顶级",'arrparentid'=>0);
			}else{
				echo json_encode(array("code"=>0,"msg"=>"移动到的类别不存在，请重试！"));
				die();
			}
		}
		
		if($movecatid == $findcat['parentid']){
			echo json_encode(array("code"=>0,"msg"=>$findcat['catname']." 当前就在 ".$findcat_1['catname']." 类别下"));
			die();
		}
		
		$findsamecat = $this->comm->find("category",array("catname"=>$findcat['catname'],"parentid"=>$movecatid));
		if($findsamecat){
			echo json_encode(array('code'=>0,"msg"=>'此父类下已经存在和待移动类别同名的类目！'));
			die();
		}
		
		$temppcats = $this->comm->findAll("category","catid in ({$findcat['arrparentid']})","catid desc");
		$tarrchilds = $findcat['arrchildid'];
		$tarrchilds = explode(",",$tarrchilds);
		foreach($temppcats as $v){
			$tpids = explode(",",$v['arrchildid']);
			foreach($tarrchilds as $m1){
				if($n1 = array_search($m1,$tpids)){
					unset($tpids[$n1]);
				}
			}
			$tpids = array_unique($tpids);
			asort($tpids);
			$child = count($tpids)==1 ? 0 : 1;
			$tpids = join(",",$tpids);
			$this->comm->update("category",array("catid"=>$v['catid']),array("child"=>$child,"arrchildid"=>$tpids));
		}
		
		//$arrparentids = $movecatid.",".$findcat_1['arrparentid'];
		//$arrparentids = explode(",",$arrparentids);
		//$arrparentids = array_unique($arrparentids);
		//asort($arrparentids);

		$arrparentids = $this->getpcatids($movecatid);
		$arrparentids = $arrparentids ? join(",",$arrparentids) : 0;
		$this->comm->update("category",array("catid"=>$oricatid),array("parentid"=>$movecatid,"arrparentid"=>$arrparentids));
		if(!mysql_affected_rows()){
			echo json_encode(array('code'=>1,"msg"=>'移动失败，请重试！',"pcatid"=>$findcat['parentid']));
			die();
		}
		
		$temppcats_1 = $this->comm->findAll("category","catid in ({$arrparentids})","catid desc");
		foreach($temppcats_1 as $v1){
			$tpids_1 = $v1['arrchildid'].",".$oricatid.",".$findcat['arrchildid'];
			$tpids_1 = explode(",",$tpids_1);
			$tpids_1 = array_unique($tpids_1);
			asort($tpids_1);						
			$child_1 = count($tpids_1)==1 ? 0 : 1;
			$tpids_1 = join(",",$tpids_1);
			$this->comm->update("category",array("catid"=>$v1['catid']),array("child"=>$child_1,"arrchildid"=>$tpids_1));
		}

		
		$tempscats = $this->comm->findAll("category","catid in ({$findcat['arrchildid']})","catid asc");
		foreach($tempscats as $v2){
			$findps = $this->comm->find("category",array("catid"=>$v2['parentid']));
			$tpids_2 = $findps ? $findps['arrparentid'].",".$v2['parentid'] : "0,".$v2['parentid'];
			$tpids_2 = explode(",",$tpids_2);
			$tpids_2 = array_unique($tpids_2);
			asort($tpids_2);
			$tpids_2 = join(",",$tpids_2);
			$this->comm->update("category",array("catid"=>$v2['catid']),array("arrparentid"=>$tpids_2));
			
			$arrparentid = $this->getpcatids($v2['catid']);
			if($key2 = array_search($v2['catid'],$arrparentid,true)){
				unset($arrparentid[$key2]);
			}
			$tpids_3 = join(",",$arrparentid);
			$this->comm->update("category",array("catid"=>$v2['catid']),array("arrparentid"=>$tpids_3));
		}
		echo json_encode(array('code'=>1,"msg"=>'移动成功！',"pcatid"=>$findcat['parentid']));
		//dump($this->db->queries);
	}
	
	function islastcat(){
		$catid = intval($this->input->post("catid",true));
		if($catid <= 0){
			echo json_encode(array("code"=>0,"msg"=>"请先选择类别！"));
			die();
		}
		$rs = $this->comm->find("category",array("catid"=>$catid),"","catid,child");
		if(!$rs){
			echo json_encode(array("code"=>0,"msg"=>"此类别不存在，请重试！"));
			die();
		}
		
		if(!$rs['child']){
			echo json_encode(array("code"=>1,"msg"=>"last cat"));
		}else{
			echo json_encode(array("code"=>1,"msg"=>"not last cat"));
		}
	}
}