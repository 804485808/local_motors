<?php
	//使用UTF-8

	define('SAMPLE_DENSITY',30);//像素点采样精度(每个指定像素采样比对一次)数值越大越精细，但处理也会更耗时
	define('CM_LEVAL',20);		//颜色匹配级别 color match leval(0-255)
	define('CMT_LEVAL',0.9);	//匹配次数级别 count match leval(0.1-1)

	define('RED_INDEX', 0);		//颜色索引
	define('GREEN_INDEX', 1);	//颜色索引
	define('BLUE_INDEX', 2);	//颜色索引

	define('GAUSS_BLOCK_SIZE',100);		//Gauss模糊处理块边大小，一次读取块越小，占用内存越小，同时块数会增加
	define('SUPORT_MIME',"JPG,PNG,GIF");//支持的文件类型
	define('JPEG_SAVE_QUALITY',80);		//JPEG图片保存的质量（0-100）

//Imageblur Class
class Imageblur{
	private $image= null;		//图形资源句柄
	private $width= 0;			//图形宽度
	private $height= 0;			//图形的高度
	private $imageType= null;	//图形的类型
	private $imageMime= null;	//图片MIME

	private $imageFilePath= null;//图片所在的目录
	private $imageFileName= null;//图片名称


	/**
	 * construct
	 *
	 * @param string $imageFile 载入的图片路径
	 */
	function __construct($imageFile= null){
		if($imageFile != null){
			$this->loadImage($imageFile);
		}
	}
	
	/**
	 * 载入图片
	 *
	 * @param string $imageFile
	 * @return boolean 成功返回true，失败返回 false
	 */
	function loadImage($imageFile){
		if(!is_file($imageFile)){
			return false;
		}
		if($this->isLoad()){
			$this->close();
		}
		if(!$image_infor= Imageblur::get_image_infor($imageFile))
			return false;

		$this->width = $image_infor['width'];
		$this->height= $image_infor['height'];
		$this->imageMime= $image_infor['mime'];
		$pathName= realpath($imageFile);

		$this->imageFilePath= str_replace('\\', '/', dirname($pathName).'/');
		$this->imageFileName= basename($pathName);

		$this->imageType= $image_infor['type'];
		$image_type_array= explode(',', SUPORT_MIME);
		if(!in_array($this->imageType, $image_type_array)){
			return false;
		}
		switch ($this->imageType){
			case 'JPG' :
				$this->image = imagecreatefromjpeg($imageFile);
				break;
			case 'PNG':
				$this->image = imagecreatefrompng($imageFile);
				break;
			case 'GIF':
				$this->image = imagecreatefromgif($imageFile);
				break;
			default:
				exit("未处理的图片打开方式'{$this->imageType}'");
		}
		return true;
	}
	
	/**
	 * 保存图片（图片处理之后的保存操作）
	 *
	 * @param string $imgRePath 重定向的保存目录
	 * @param unknown_type $imgReName 重命名文件
	 * @return 成功返回 true 失败返回false
	 */
	function saveImage( $imgRePath= null,$imgReName= null){

		$imgName= $this->imageFileName;
		$imgPath= $this->imageFilePath;
		if($imgReName != null) $imgName= $imgReName;
		if($imgRePath != null) $imgPath= $imgRePath;

		if(preg_match("/[\\/]$/", $imgRePath) == 0){		//末尾补 '/'
			$imgRePath = $imgRePath.'/';
		}
		return $this->writeImage( $imgPath.$imgName);
	}
	
	/**
	 * 直接输出图片到当前页面
	 */
	function outPutImage(){
		return $this->writeImage(null);
	}

	/**
	 * destruct
	 *
	 */
	function __destruct(){
		$this->close();
	}

	/**
	 * getWidth
	 *
	 * @return int 返回图片宽
	 */
	function getWidth(){
	
		if($this->isLoad()){
			return $this->width;
		}
		return 0;
	}
	
	/**
	 * getHeight
	 *
	 * @return int 返回图片高
	 */
	function getHeight(){

		if($this->isLoad()){
			return $this->height;
		}
		return 0;
	}
	
	/**
	 * 获取图片资源句柄
	 *
	 * @return resource 资源句柄
	 */
	function getImage(){
		if($this->isLoad()){
			return $this->image;
		}
		return null;
	}

	/**
	 * 关闭一个打开的图片
	 *
	 * @return true
	 */
	function close(){
		if($this->isLoad()){
			@imagedestroy($this->image);
			$this->image= null;
			$this->height= 0;
			$this->width= 0;
			$this->imageMime= null;
			$this->imageType= null;
			$this->imageFileName= null;
		}
		return true;
	}

	/**
	 * 输出image图片，此方法不导出
	 *
	 * @param string $imgFileName
	 */
	private function writeImage($imgFileName){
		if($imgFileName == null){
			ob_end_clean();
			header("Content-Type: {$this->imageMime}");
		}
		switch ($this->imageType){
			case 'JPG' :
				imagejpeg($this->image,$imgFileName, JPEG_SAVE_QUALITY);
				break;
			case 'PNG':
				imagepng($this->image, $imgFileName);
				break;
			case 'GIF':
				imagegif($this->image, $imgFileName);
				break;
			//case 'WBMP':
			//	imagewbmp($this->image, $imgFileName);
			default:
				exit("不支持的图片存储格式 '{$this->imageType}'");
		}

		return true;
	}
	
	/**
	 * 转换图片格式
	 *
	 * @param string $newType 新的图片格式（不是所有的都能支持保存）
	 * @return boolean 成功返回true
	 */
	function formatConversion($newType){
		if(is_integer($newType)){
			switch($newType){
				case 1:  $newType= 'GIF'; break;
				case 2:  $newType= 'JPG'; break;
				case 3:  $newType= 'PNG'; break;
				case 4:  $newType= 'SWF'; break;
				case 5:  $newType= 'PSD'; break;
				case 6:  $newType= 'BMP'; break;
				case 7:  $newType= 'TIFF';break;
				case 8:  $newType= 'TIFF';break;
				case 9:  $newType= 'JPC'; break;
				case 10: $newType= 'JP2'; break;
				case 11: $newType= 'JPX'; break;
				case 12: $newType= 'JB2'; break;
				case 13: $newType= 'SWC'; break;
				case 14: $newType= 'IFF'; break;
				case 15: $newType= 'WBMP';break;
				case 16: $newType= 'XBM'; break;
				default: exit('未知的图片文件存储格式');
			}
		}
		$newType= strtoupper($newType);
		$image_type_array= explode(',', SUPORT_MIME);
		if(in_array($newType, $image_type_array)){
			$this->imageType= $newType;

			//同时修改将来保存的默认文件名
			$reFileNameArr= explode('.', $this->imageFileName);
			if(count($reFileNameArr)>1) array_pop($reFileNameArr);
			$this->imageFileName= implode('.', $reFileNameArr).'.'.$this->imageType;
			return true;
		}
		exit("不支持的格式转换存储 {$newType}");
	}

	/**
	 * 判断图片是否正确加载
	 *
	 * @return boolean 成功加载返回 true，出错返回false
	 */
	function isLoad(){
		if($this->image == null)
			return false;
		return true;
	}
	
	/**
	 * 获取图片文件的详细信息（该方法公用）
	 *
	 * @param string $image_file 图片文件路径
	 * @return array 成功返回图片详细信息数组，失败返回 null
	 */
	static function get_image_infor($image_file){

		if(!!$arr_image_infor= @getimagesize($image_file)){
			$image_infor = &$arr_image_infor;
			$image_infor['type_index']= $arr_image_infor[2];
			$image_infor['width']= $arr_image_infor[0];
			$image_infor['height']= $arr_image_infor[1];
			$image_infor['mime']= $arr_image_infor['mime'];
			$image_infor['string_size']= $arr_image_infor[3];

			switch($arr_image_infor[2]){
				case 1:  $image_infor['type']= 'GIF'; break;
				case 2:  $image_infor['type']= 'JPG'; break;
				case 3:  $image_infor['type']= 'PNG'; break;
				case 4:  $image_infor['type']= 'SWF'; break;
				case 5:  $image_infor['type']= 'PSD'; break;
				case 6:  $image_infor['type']= 'BMP'; break;
				case 7:  $image_infor['type']= 'TIFF';break;
				case 8:  $image_infor['type']= 'TIFF';break;
				case 9:  $image_infor['type']= 'JPC'; break;
				case 10: $image_infor['type']= 'JP2'; break;
				case 11: $image_infor['type']= 'JPX'; break;
				case 12: $image_infor['type']= 'JB2'; break;
				case 13: $image_infor['type']= 'SWC'; break;
				case 14: $image_infor['type']= 'IFF'; break;
				case 15: $image_infor['type']= 'WBMP';break;
				case 16: $image_infor['type']= 'XBM'; break;
				default: $image_infor['type']= '';
			}
			return $image_infor;
		}
		return null;
	}
	
	/**
	 * 返回正确载入后的图片格式类型
	 *
	 * @return string 成功返回图片格式，失败 返回 null
	 */
	function imageType(){
		if($this->isLoad()){
			return $this->imageType;
		}
		return null;
	}
	
	/**
	 * 水印处理方法
	 *
	 * @param resource/string $waterImage 打开的水印图片类或文件目录
	 * @param int $pct 水印深度 0-100
	 * @return boolean 处理成功返回 true 失败返回false
	 */
	function waterMark($waterImage,$pct=50){	//水印应为透底的gif或png图片
		$auto_free= false;			//对于字符串传递的 waterImage需要使用后关闭
		if(is_string($waterImage)){
			$waterImage= new Imageblur($waterImage);
			$auto_free= true;
		}

		if($waterImage instanceof Imageblur){

			if($waterImage->isLoad()){
				$image_width= $this->getWidth();
				$image_heigth= $this->getHeight();
				$waterImage_width =$waterImage->getWidth();
				$waterImage_height= $waterImage->getHeight();

				for($start_x=0;$start_x<$image_width; $start_x+= $waterImage_width){
					for($start_y=0;$start_y<$image_heigth; $start_y+= $waterImage_height){
						imagecopymerge($this->image,$waterImage->getImage(),$start_x,$start_y,0,0,$waterImage_width,$waterImage_height,$pct);
					}
				}
				if($auto_free){
					$waterImage->close();
					unset($waterImage);
				}
				return true;
			}//waterMark image file not loaded error
		}//'error at waterMark';
		return false;
	}


	/**
	 * 高斯模糊区域处理方法
	 * @param int $nRadius
	 * @param int $x_pos
	 * @param int $y_pos
	 * @param int $width
	 * @param int $height
	 * @return boolean
	 */
	function gaussPart($nRadius, $x_pos, $y_pos, $width, $height){

		$nRadius= intval($nRadius);
		//$diamet = $nRadius *2 + 1;			//采样区域直径,或者方阵的边长
		$sigma = $nRadius / 3.0;				//正态分布的标准偏差σ
		$sigma2 = 2.0 * $sigma * $sigma;		//2倍的σ平方,参考N维空间正态分布方程
		$nuclear = 0.0;							//高斯卷积核

		if(!$this->isLoad()){//未打开图片
			return false;
		}
		if($nRadius < 1){//采样区域半径
			return false;
		}

		//计算高斯矩阵
		$matrix= array();						//高斯矩阵定义
		for($x = -$nRadius; $x <= $nRadius; $x++)
		for($y = -$nRadius; $y <= $nRadius; $y++){
			$result = exp(-($x * $x + $y * $y) / $sigma2);
			$nuclear += $result;
			$matrix[$x][$y]= $result;
		}
	
		//缓存像素内存块
		$image_bits= array();
		$img_width= $this->getWidth();	//原图片大小
		$img_height= $this->getHeight();

		//x,y坐标合法性检查
		$x_pos= intval($x_pos);
		$y_pos= intval($y_pos);
		if($x_pos < 0 || $x_pos >= $img_width || $y_pos < 0 || $y_pos >= $img_height) return false;

		//处理像素矩阵的宽与高
		$width= intval($width);
		$height= intval($height);
		if($width < 0 || $height < 0 ) return false;
		$width+= $x_pos;
		$height+= $y_pos;
		if($width > $img_width) $width= $img_width;
		if( $height > $img_height) $height= $img_height;

		//采样缓存图片
		$pix_x= $x_pos- $nRadius;	//为了使边缘自然，采样缓存区域应大于nRadius像素
		$pix_y= $y_pos- $nRadius;
		$pix_width= $width+ $nRadius;
		$pix_height= $height+ $nRadius;

		for($x=$pix_x; $x<$pix_width; $x++)
		{
			for($y=$pix_y; $y<$pix_height; $y++){
				$bit= array();
				$x_index= $x;
				$y_index= $y;

				if($x_index < 0)$x_index= -$x_index;	//插入虚拟坐标点处理，以便使边界更自然
				if($y_index < 0)$y_index= -$y_index;
				$x_index= $x_index% $img_width;	//平铺处理边界
				$y_index= $y_index% $img_height;

				$pix= imagecolorsforindex($this->image, imagecolorat($this->image, $x_index, $y_index));
				$bit[0]= $pix['red'];
				$bit[1]= $pix['green'];
				$bit[2]= $pix['blue'];
				$image_bits[$x][$y]= $bit;
			}
		}
		//遍历并处理像素
		for($x = $x_pos; $x < $width; $x++){
			for($y = $y_pos; $y < $height; $y++){
	
				$red= 0.0;	//分析取样区域
				$green= 0.0;
				$blue= 0.0;
	
				for ($m = -$nRadius; $m <= $nRadius; $m++){
					$yy = $y + $m;
					for($n = -$nRadius; $n <= $nRadius; $n++){
						$xx = $x + $n;	
						$weight = $matrix[$m][$n] / $nuclear;
						$red += $weight * $image_bits[$xx][$yy][0];
						$green += $weight * $image_bits[$xx][$yy][1];
						$blue += $weight * $image_bits[$xx][$yy][2];
					}
				}
				//保存一个像素处理结果
				$red= $red > 255 ? 255: intval($red);
				$green= $green > 255 ? 255:intval($green);
				$blue= $blue > 255 ? 255: intval($blue);
				$new_color = imagecolorallocate($this->image, $red, $green, $blue);
				imagesetpixel($this->image, $x, $y, $new_color);
			}
		}
		return true;
	}

	/**
	 * 高斯模糊图片分块处理方法（大图使用分块GAUSS_BLOCK_SIZE处理）
	 * @param int $nRadius
	 * @return boolean
	 */
	function gauss($nRadius){
	
		$nRadius= intval($nRadius);
		//$diamet = $nRadius *2 + 1;			//采样区域直径,或者方阵的边长
		$sigma = $nRadius / 3.0;				//正态分布的标准偏差σ
		$sigma2 = 2.0 * $sigma * $sigma;		//2倍的σ平方,参考N维空间正态分布方程
		$nuclear = 0.0;							//高斯卷积核
	
		if(!$this->isLoad()){//未打开图片
			return false;
		}
		if($nRadius < 1){//采样区域半径
			return false;
		}
	
		//计算高斯矩阵
		$matrix= array();						//高斯矩阵定义
		for($x = -$nRadius; $x <= $nRadius; $x++){
			for($y = -$nRadius; $y <= $nRadius; $y++){
				$result = exp(-($x * $x + $y * $y) / $sigma2);
				$nuclear += $result;
				$matrix[$x][$y]= $result;
			}
		}
	
		$width= $this->getWidth();	//原图片大小
		$height= $this->getHeight();
		$block_count_x= ceil($width/GAUSS_BLOCK_SIZE);
		$block_count_y= ceil($height/GAUSS_BLOCK_SIZE);
	
		$block_data_buff= array();
		for($block_x=0; $block_x < $block_count_x; $block_x++){
			for($block_y=0; $block_y < $block_count_y; $block_y++){
	
				$block_data_left= null;
				$block_data_top= null;
				if(isset($block_data_buff[$block_x - 1][$block_y])){
					$block_data_left= &$block_data_buff[$block_x - 1][$block_y];
				}
				if(isset($block_data_buff[$block_x][$block_y -1])){
					$block_data_top= &$block_data_buff[$block_x][$block_y - 1];
				}
	
				$block_data_buff[$block_x][$block_y]= $this->getGaussBlockBitmap($block_x, $block_y, $nRadius, $block_data_left, $block_data_top);
				$this->gaussBlockProcess($block_x, $block_y, $nRadius, $matrix, $nuclear, $block_data_buff[$block_x][$block_y]);
	
				if($block_x > 0 && $block_y > 0){
					unset($block_data_buff[$block_x - 1][$block_y - 1]);
				}
	
				if($block_y == $block_count_y-1 && $block_x > 0){
					unset($block_data_buff[$block_x- 1][$block_y]);
				}
				unset($block_data_left);
				unset($block_data_top);
			}
		}
		return true;
	}

	/**
	 * 高斯模糊：图片位图块选取
	 * @param int $block_x
	 * @param int $block_y
	 * @param int $nRadius
	 * @param array $block_data_left
	 * @param array $block_data_top
	 */
	private function getGaussBlockBitmap($block_x, $block_y, $nRadius, $block_data_left, $block_data_top){

		//缓存像素内存块
		$image_bits= array();
		$img_width= $this->getWidth();	//原图片大小
		$img_height= $this->getHeight();

		//x,y坐标位移
		$x_pos= $block_x* GAUSS_BLOCK_SIZE;
		$y_pos= $block_y* GAUSS_BLOCK_SIZE;

		if($x_pos >= $img_width || $y_pos >= $img_height) return null;

		//处理像素矩阵的宽与高
		$width= $x_pos+ GAUSS_BLOCK_SIZE;
		$height= $y_pos+ GAUSS_BLOCK_SIZE;

		if($width > $img_width) $width= $img_width;
		if( $height > $img_height) $height= $img_height;

		//采样缓存图片
		$pix_x= $x_pos- $nRadius;	//为了使边缘自然，采样缓存区域应大于nRadius像素
		$pix_y= $y_pos- $nRadius;
		$pix_width= $width+ $nRadius;
		$pix_height= $height+ $nRadius;
	
		//获取像素
		if($block_x != 0 /*&& $block_data_left != null*/){
			for($x=$pix_x; $x < $pix_x+ $nRadius; $x++){
				for($y= $pix_y; $y <$pix_height; $y++){
					$image_bits[$x][$y]= $block_data_left[$x][$y];
				}
			}
			
			$pix_x+= $nRadius;
		}

		if($block_y != 0 /*&& $block_data_top != null*/){
			$a=$pix_y + $nRadius;
			for($x=$pix_x; $x<$pix_width; $x++){
				for($y= $pix_y; $y <$pix_y + $nRadius; $y++){
					$image_bits[$x][$y]= $block_data_top[$x][$y];
					
				}
			}
			$pix_y+= $nRadius;
		}

		for($x=$pix_x; $x<$pix_width; $x++){
			for($y=$pix_y; $y<$pix_height; $y++){
	
				$bit= array();
				$x_index= $x;
				$y_index= $y;
	
				if($x_index < 0) $x_index= -$x_index;	//插入虚拟坐标点处理，以便使边界更自然
				if($y_index < 0) $y_index= -$y_index;
				$x_index= $x_index% $img_width;			//平铺处理边界
				$y_index= $y_index% $img_height;
	
				$pix= imagecolorsforindex($this->image, imagecolorat($this->image, $x_index, $y_index));
				$bit[0]= $pix['red'];
				$bit[1]= $pix['green'];
				$bit[2]= $pix['blue'];
				$image_bits[$x][$y]= $bit;
			}
		}
		return $image_bits;
	}

	/**
	 * 高斯模糊：图片位图块处理
	 * @param int $block_x
	 * @param int $block_y
	 * @param int $nRadius
	 * @param array $matrix
	 * @param double $nuclear
	 * @param array $image_bits
	 */
	private function gaussBlockProcess($block_x, $block_y, $nRadius, $matrix, $nuclear, $image_bits){

		$img_width= $this->getWidth();	//原图片大小
		$img_height= $this->getHeight();

		$x_pos= $block_x* GAUSS_BLOCK_SIZE;	//x,y坐标位移
		$y_pos= $block_y* GAUSS_BLOCK_SIZE;
		$width= $x_pos+ GAUSS_BLOCK_SIZE;	//处理像素矩阵的宽与高
		$height= $y_pos+ GAUSS_BLOCK_SIZE;
		if($width > $img_width) $width= $img_width;
		if( $height > $img_height) $height= $img_height;

		for($x = $x_pos; $x < $width; $x++){
			for($y = $y_pos; $y < $height; $y++){

				$red= 0.0;	//分析取样区域
				$green= 0.0;
				$blue= 0.0;
		
				for ($m = -$nRadius; $m <= $nRadius; $m++){
					$yy = $y + $m;
					for($n = -$nRadius; $n <= $nRadius; $n++){
						$xx = $x + $n;
						$weight = $matrix[$m][$n] / $nuclear;
						$red += $weight * $image_bits[$xx][$yy][0];
						$green += $weight * $image_bits[$xx][$yy][1];
						$blue += $weight * $image_bits[$xx][$yy][2];
					}
				}
		
				//保存一个像素处理结果
				$red= $red > 255 ? 255: intval($red);
				$green= $green > 255 ? 255:intval($green);
				$blue= $blue > 255 ? 255: intval($blue);
		
				$new_color = imagecolorallocate($this->image, $red, $green, $blue);
				imagesetpixel($this->image, $x, $y, $new_color);
			}
		}
		return true;
	}
}
