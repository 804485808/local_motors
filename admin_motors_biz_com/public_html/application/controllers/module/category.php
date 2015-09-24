<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MY_Controller{	
	public $gcategory;
	public $catid;	
	function __construct(){
		parent::__construct();
		$category = array();
		$cate = array();
		$cate = $this->comm->findAll("category");
		foreach($cate as $v){
			$category[$v['catid']] = $v;
		}	
		$this->gcategory = $category;
	}
	
	function save_cat(){
		$catid=$this->input->post("catid",TRUE);
		if ($catid){
			$category=$this->input->post("category",TRUE);
			$arrparentid="0";
			$oneSelect=$this->input->post("oneSelect",TRUE);
			$twoSelect=$this->input->post("twoSelect",TRUE);
			$threeSelect=$this->input->post("threeSelect",TRUE);
			$fourSelect=$this->input->post("fourSelect",TRUE);
			if ($oneSelect){
				$arrparentid.=",".$oneSelect;
				if ($twoSelect){
					$arrparentid.=",".$twoSelect;
					if ($threeSelect){
						$arrparentid.=",".$threeSelect;
						if ($fourSelect){
							$arrparentid.=",".$fourSelect;								
						}	
					}
				}				
			}
			$category['arrparentid']=$arrparentid;
			$rs=$this->comm->update("category",array("catid"=>$catid),$category);
			//修改父类的arrchildid，修改子类的arrparentid
            $tip = '修改成功';
            $url = 'module/sell/cat_list2';
            echo "<script language='javascript'>alert('".$tip."');</script>";
            echo "<script language='javascript'>window.location='".site_url($url)."'</script>";
			exit;
		}
		$this->load->helper("getstr");
		$category = $this->input->post("category",TRUE);
		if(empty($category['catname'])){
			show_error("name can't empty");
		}
		$catname=str_replace(array("\r\n", "\n", "\r"), ",", $category['catname']);
		$catname=explode(",",$catname);
		$catname=array_unique($catname);
		/* if(!preg_match("/a-z/i",$category['letter'])){
			$category['letter'] = 0;
		} */
		$c=0;
        $k=0;
		$j=count($catname);

		foreach ($catname as $v){
			if ($v==''){$j--;continue;}
            if(substr($v, -1) != 's')
            {
                $v = $v."s";
            }
			if ($this->comm->find('category',array('catname'=>$v,'parentid'=>$category['parentid']))){
                $k++;
                continue;
            }
//			if ($this->comm->find('category',array('catname'=>trim($v)))){continue;}
			if (strlen($v)>2000){continue;}
			$category['catname']=ucwords(strtolower(getstr($v,2000,0,0,-1)));
			$category['letter'] = strtoupper(substr($category['catname'],0,1));
			if (is_numeric($category['letter'])) $category['letter']='0';
			$category['linkurl'] = preg_replace("/[^0-9a-z]/i","-",$category['catname']);
			$category['linkurl'] = preg_replace("/(-)+/i","-",$category['linkurl']);
			$category['catdir'] = $category['linkurl'];
//			$category['ori_str'] =$this->get_oridata($category['catname']);
//			if ($this->comm->find('category',array('ori_str'=>$category['ori_str']))){
//				continue;
//			}
			$catid = $this->comm->create('category',$category);
			if ($catid){
				$c++;
				$arr_category=$category;
				if($arr_category['parentid']){
					$arr_category['catid'] = $catid;
					$this->gcategory[$catid] = $arr_category;
					$arrparentid = $this->get_arrparentid($catid,$this->gcategory);
				}else{
					$arrparentid = '0';
				}
				$this->comm->update("category",array("catid"=>$catid),array("arrparentid"=>$arrparentid,"listorder"=>$catid));				
				if($arr_category['parentid']){
					$childs = '';
					$childs .= ",".$catid;
					$parents = array();
					$parents = $this->get_arrparentid($catid,$this->gcategory,FALSE);
					//dump($parents);
					foreach($parents as $x) {
						
						/* //还有点问题
						$cate = $this->comm->findAll("category");
						foreach($cate as $v){
							$category[$v['catid']] = $v;
						}
						$this->gcategory = $category; */
						$this->gcategory[$x]=$this->comm->find("category",array("catid"=>$x));

						if ($this->gcategory[$x]['child']){
							$arrchildid = $this->gcategory[$x]['arrchildid'].$childs;
						}else{
							$arrchildid = $x.$childs;
						}
						//$arrchildid = $this->gcategory[$x]['child'] ? $this->gcategory[$x]['arrchildid'].$childs : $x.$childs;
						$this->comm->update("category",array("catid"=>$x),array("child"=>1,"arrchildid"=>$arrchildid));
					}
				}
			}
		}
		$rs = $c==$j ? '添加成功' : '添加失败'.$k."重复,".$c."个成功";
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function del_cat(){
		$catid=intval($this->uri->rsegment(3,0));
		$del_id=array();
		if($catid){
			$del_id=array($catid);
		}elseif ($_POST){
			$del_id=$this->input->post('catids',TRUE);
		}
		if ($del_id){
			$c=0;
			foreach ($del_id as $v){
				$findcat = $this->comm->find("category",array("catid"=>$v));
				if(!$findcat){
					$data['msg']='没有找到此类别';
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				}elseif ($findcat['child']){
					$data['msg']='此类含有子类，不能被删除';
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				}elseif ($findcat['item']){
					$data['msg']='此类下含有产品，不能被删除';
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				}else{
					$j=$this->comm->delete("category",array("catid"=>$v));
					$findparent = $this->comm->find("category",array("parentid"=>$findcat['parentid']));			
					if(!$findparent){
						$this->comm->update("category",array("catid"=>$findcat['parentid']),array("child"=>0));
					}
					$parents = $this->get_arrparentid($v,$this->gcategory,FALSE);			
					if ($parents){
						foreach($parents as $cid) {
							$arrchildid = str_replace(",".$v,"",$this->gcategory[$cid]['arrchildid']);
							$this->comm->update("category",array("catid"=>$cid),array("arrchildid"=>$arrchildid));							
						}
					}
					$c = $j ? $c+1 : $c;
				}
			}
			$rs=$c==count($del_id)?"类别删除成功！":"类别删除失败，请重试!";
		}else{
			$rs="请选择类别";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function update_cat(){
		$category=$this->input->post("category",TRUE);
		$c=0;
		foreach ($category as $k=>$v){
			if ($v['parentid']==$k){
				$data['msg']='分类的父ID不能为自己的ID';
				$str=$this->load->view('public/success',$data,TRUE);
				echo $str;
				exit;
			}else{
				$count=$this->comm->findCount('category',array('catid'=>$v['parentid']));
				if (!$count && $v['parentid']!=0){
					$data['msg']='此父类不存在';
					$str=$this->load->view('public/success',$data,TRUE);
					echo $str;
					exit;
				}else{
					
					$v['catname'] = trim($v['catname']);
					$v['catdir'] = preg_replace("/[^0-9a-z]/i","-",$v['catname']);
					$v['catdir'] = preg_replace("/(-)+/i","-",$v['catdir']);
					$v['linkurl'] = $v['catdir'];
					$v['ori_str'] =$this->get_oridata($v['catname']);
					$result=$this->comm->update("category",array("catid"=>$k),$v);
					$c = $result ? $c+1 : $c;
				}
			}
		}
		$data['msg'] = $c==count($category) ? '分类更新成功' : '分类更新失败，请重试';
		$this->load->view('public/success',$data);
	}

	function attr_list2(){
		$data['catid']=$catid=$this->uri->rsegment(3,0);
		$data['attr']=$attr=$this->comm->findAll("category_option",array("catid"=>$catid));
		$this->load->view("module/sell/attr_list",$data);
	}
	
	function add_attr2(){
		$data['catid']=$catid=$this->uri->rsegment(3,0);
		$rs=$this->comm->find("category",array("catid"=>$catid),"","child");
		if($rs['child']){
			echo "<br/><br/><br/><br/><center>只有最后一级才能添加属性<br/><a href=\"javascript:history.back(-1);\" >返回上一页</a></center>";
		}else{
			$this->load->view("module/sell/add_attr",$data);
		}				
	}
	
	function edit_attr(){
		$oid = intval($this->uri->rsegment(3,0));
		if($oid){
			$data['attr']=$attr=$this->comm->find("category_option",array("oid"=>$oid));
			$data['type']='edit_attr';
			$this->load->view("module/sell/edit_attr",$data);
		}else{
			show_error("Not found this attribute");
		}
	}
	
	function save_attr(){
		$this->load->helper("getstr");
		$act=$this->input->post('action',TRUE);
		$post=$this->input->post('post',TRUE);
		if (strlen($post['name'])>50){
			$data['msg']="属性名称长度不得大于50个字节!";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		if ($post['type']>=2 && strlen($post['value'])>255){
			$data['msg']="属性值长度不得大于255个字节!";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		$attr=array(
				'catid'=>$post['catid'],
				'type'=>$post['type'],
				'required'=>$post['required'],
				'name'=>getstr($post['name'],255,0,0,-1),				
				'value'=>""
		);	
		if ($act=='add'){	
			$tep=$this->comm->findCount("category_option",array("catid"=>$attr['catid'],"name"=>$attr['name']));						
		}elseif ($act=='edit'){
			$oid=$this->input->post('oid',TRUE);
			$tep=$this->comm->findCount("category_option","catid = {$attr['catid']} and name = '{$attr['name']}' and oid <> {$oid}");	
		}
		if($tep){
			$data['msg']="此类别下的属性已存在，属性添加失败!";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}	
		if($attr['type']>=2){
			$attr['value']=getstr($post['value'],255,0,0,-1);
			$attr['value']=ereg_replace(" {2,}", ' ', $attr['value']);
			$attr['value']=str_replace(array("| "," |"),array("|","|"),$attr['value']);
			$attr['value']=ereg_replace("\|{2,}", '|', $attr['value']);
			$temp=explode("|",$attr['value']);
			$temp=array_unique($temp);
			$attr['value']=join("|",$temp);
		}	
		if ($act=='add'){	
			$tep=$this->comm->findCount("category_option",array("catid"=>$attr['catid'],"name"=>$attr['name']));
			if(!$tep){
				$insert_oid=$result=$this->comm->create("category_option",$attr);				
				$rs = $result ? '属性添加成功' : '属性添加失败，请重试';
				$insert_oid=$insert_oid ? $insert_oid : 0;
			}else{
				$rs = '此类别下的属性已存在，属性添加失败';
			}			
		}elseif ($act=='edit'){			
			$result=$this->comm->update("category_option",array("oid"=>$oid),$attr);
			$rs = $result ? '属性修改成功' : '属性修改失败，请重试';
		}else{
			$rs='操作非法';
		}
		$data['msg']=$rs;
		$rs="";
		if($attr['type']>=2){
			$temp=explode("|",$attr['value']);			
			foreach($temp as $t){
				if($t){
					$rs=$this->comm->find("category_default_option",array("value"=>$t));
					if($rs){
						$default_attr=array("id"=>$rs['id'],"value"=>$t,"catid"=>$attr['catid']);			
					}else{
						$maxid=$this->comm->find("category_default_option","","","max(id)");
						$maxid=$maxid ? $maxid['max(id)'] : 0;
						$maxid++;
						$default_attr=array("id"=>$maxid,"value"=>$t,"catid"=>$attr['catid']);
					}
					$default_attr['oid']=isset($oid) ? $oid : $insert_oid;
					$de_temp=$this->comm->findCount("category_default_option",$default_attr);
					if(!$de_temp){
						$this->comm->create("category_default_option",$default_attr);
					}
				}
			}
		}
		$this->load->view('public/success',$data);
	}
	
	function update_attrlist(){
		$update=$this->input->post('listorder',TRUE);
		$c=0;
		if (!$update){
			$data['msg']="没有属性，暂时不能更新!";
			$str=$this->load->view('public/success',$data,TRUE);
			echo $str;
			exit;
		}
		foreach ($update as $k=>$v){
			$findattr = $this->comm->find("category_option",array("oid"=>$k));
			if ($findattr){
				$result=$this->comm->update("category_option",array("oid"=>$k),array("listorder"=>$v));
				$c = $result ? $c+1 : $c;
			}else{
				$data['msg']="没有找到此属性!";				
				$str=$this->load->view('public/success',$data,TRUE);
				echo $str;
				exit;
			}
		}
		if ($c==count($update)){
			$rs="更新排序成功！";
		}else{
			$rs="更新排序失败，请重试!";
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function del_attr(){
		if ($oid=$this->uri->rsegment(3,0)){
			$findattr=$this->comm->findCount("category_option",array("oid"=>$oid));
			if ($findattr){
				$del_oid=$this->comm->delete("category_option",array("oid"=>$oid));
				if ($del_oid){
					$this->comm->delete("category_value",array("oid"=>$oid));
					$rs='属性删除成功';
				}else{
					$rs='属性删除失败';
				}
			}else{
				$rs='没有找到此属性';
			}
		}else{
			$rs='请选择属性';
		}
		$data['msg']=$rs;
		$this->load->view('public/success',$data);
	}
	
	function get_arrparentid($catid,$gcategory,$type=TRUE){
		$parents = array();
		if($gcategory[$catid]['parentid']){			
			$cid = $catid;
			while($catid) {
				if($gcategory[$cid]['parentid']) {
					$parents[] = $cid = $gcategory[$cid]['parentid'];
				} else {
					break;
				}
			}
			if($type === TRUE){
				$parents[] = 0;
				return implode(',', array_reverse($parents));
			}else{
				return $parents;
			}
		}else{
			return $parents;
		}
	}
	
	function category_option(){
		$catid = $this->input->post("catid",TRUE);
		$catid = intval($catid);
	
		$option = $this->comm->findAll("category_option",array("catid"=>$catid),'','','0,8');
		$areaname = $this->comm->findAll("area");
	
	
		foreach($option as $k => $v){
			if(strtolower($v['name'])=='place of origin'){
				echo '<div class="P_all_template_t"><b>*</b>Place Of Origin:</div>'."\n";
				echo '<select name="option['.$v["oid"].']"><option value="0">---Please Select---</option>'."\n";
				foreach($areaname as $a){
					echo '<option  value="'.$a['areaid'].'" title="">'.$a['areaname'].'</option>'."\n";
				}
				echo "</select>";
				echo '<div class="P_clear"></div>'."\n";
				unset($option[$k]);
			}
		}
		foreach($option as $k => $v){
			echo '<div class="P_all_template_t">'.$v['name'].':</div>'."\n";
			echo '<input name=option['.$v["oid"].'] value="" type="text" />';
			echo '<div class="P_clear"></div>'."\n";
		}
	}
	
	function subcategory(){
		$catid = $this->uri->segment(4,0);
		$catid = intval($catid);
	
		$this->load->model("comm_model","cate");
		$tcat = $this->comm->find("category",array("catid"=>$catid));
		$parents = array();
		$tmp = '';
	
		if($tcat['arrparentid']=='0'){
			$parents = $this->comm->findAll("category",array("parentid"=>0));
			$tmp.='<select onchange="load_category(this.value)">';
			$tmp.='<option value="0">请选择分类</option>';
			foreach($parents as $v){
				if($catid==$v['catid']){
					$tmp.='<option value="'.$v['catid'].'" selected>'.$v['catname'].'</option>';
				}else{
					$tmp.='<option value="'.$v['catid'].'">'.$v['catname'].'</option>';
				}
			}
			$tmp.='</select>';
		}else{
			$arrparentid = explode(",",$tcat['arrparentid']);
			foreach($arrparentid as $pid){
				$parents[$pid] = $this->comm->findAll("category",array("parentid"=>$pid));
			}
			foreach($parents as $k => $v){
				$tmp.='<select onchange="load_category(this.value)">';
				$tmp.='<option value="0">请选择分类</option>';
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
			$tmp.='<select onchange="load_category(this.value)">';
			$tmp.='<option value="0">请选择分类</option>';
			foreach($child as $s){
				$tmp.='<option value="'.$s['catid'].'">'.$s['catname'].'</option>';
			}
			$tmp.='</select>';
		}
		header('Content-Type:text/html;charset=utf-8');
		echo($tmp);	
	}
	
	function translate($text,$language='zh-cn|en'){
		if(empty($text))return false;
		@set_time_limit(0);
		$html = "";
		$ch=curl_init("http://translate.google.com/?langpair=".urlencode($language)."&text=".urlencode($text));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
		$html=curl_exec($ch);
		if(curl_errno($ch))$html = "";
		curl_close($ch);
		if(!empty($html)){
			$x=explode("</span></span></div></div>",$html);
			$x=explode("onmouseout=\"this.style.backgroundColor='#fff'\">",$x[0]);
			return @$x[1];
		}else{
			return false;
		}
	}
	
	function get_oridata($str=""){
		$str=strtolower(trim($str));
		if(!$str){
			return false;
		}
		$url="http://192.168.0.220/tree_tagger.php?w=".urlencode($str);
		$rs=file_get_contents($url);
		$rs=explode("##",$rs);
		$ori_data=array();
		foreach($rs as $v){
			$temp=explode("->",$v);
			if($temp[1] == "<unknown>" || !$temp[1] || $temp[1] == "@card@"){
				$ori_data[]=$temp[0];
			}else{
				$ori_data[]=$temp[1];
			}
		}
		sort($ori_data);
		return serialize($ori_data);
	}
	
}