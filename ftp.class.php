<?php
header("Content-Type: text/html;charset=utf-8");
header("Access-Control-Allow-Origin: *");

//it is test sign by blacklaw1
//delpath('D:\usr\webroot\townke\wwwroot\filetest\ccd\aa');
//$path='filetest/abc.txt';
$ftp=new FTP();
$path=$ftp->truepath($_GET['path']);
switch($_GET['action']){
  case 'list':$result=$ftp->listfile($path);break; 
	case 'del':$result=$ftp->del($path);break;
	case 'new':$result=$ftp->newfile($path);break;
	case 'read':$result=$ftp->read($path);break;
	case 'write':$result=$ftp->write($path,$_POST['content']);break;
	default: $result='invaliable action';
}
echo $result;
//echo $ftp->listdir('filetest');

class FTP{
	public $root;
	function __construct($root=null){
		if($root==null)
		$this->root=$_SERVER[DOCUMENT_ROOT];
	}
	function __destruct(){
		
	}
	function truepath($path){
		$path=$path==''?$this->root:$this->root.'/'.$path;
		//$path=$this->root.$path;
		return iconv('utf-8','gb2312',$path);
	}
	//列表
	function listfile($path){
		$filedir=$path;//$this->root.'/'.$path;
		$handle=opendir($filedir);
		$rvalue=array();
		while($fname=readdir($handle)){
		  if($fname=='.'||$fname=='..') continue;
			$filepath=$filedir.'/'.$fname;
			$filesize=filesize($filepath).'B';
			$mtime=date("Y-m-d H:i:s",filemtime($filepath));
			$type=is_dir($filepath)?'dir':'file';
			$file=new FILEINFO(iconv('gb2312','utf-8',$fname),$type,$mtime,$filesize);
			array_push($rvalue,$file);
			}
		closedir($handle);
		return json_encode($rvalue);
	}

	//删除
	function del($path){
		//$this->debug($path,'is path');
		//$path=$this->truepath($path);
		//$this->debug($path,'is path2');
		//$path=iconv('utf-8','gb2312',$path);
		//删除文件
		if(is_file($path)){
			//$this->debug($path,'is file');
			unlink($path);
			return true;
		} 
		//删除目录
		if(is_dir($path)){
			$handle=opendir($path);
			//遍历目录
			while($filename=readdir($handle)){
				//父目录不允许操作
			
				if($filename=='.' || $filename=='..'){
					continue;
				} else {
					$filepath=$path.'/'.$filename;
					//echo $filepath.'<hr/>';
					//$this->debug($filepath,'filepath');
					$this->del($filepath);
				}
			}
			closedir($handle);
			rmdir($path);
			return true;
		}
		return false;
	}
	//新建空文件
	function newfile($path){
		//$path=$this->truepath($path);
		//echo $path;
		if(file_exists($path)){
		  echo "文件 $path 已经存在";
			return false;
		} 
		
		$handle=fopen($path,'w+');
		fclose($handle);
		return true;
	}
	//写文件
	function write($path,$content){
		//$path=$this->truepath($path);
		file_put_contents($path,$content);
	}
	//读文件
	function read($path){
		//$path=$this->truepath($path);
		return file_get_contents($path);
	}
	function debug($content,$key=null){
		$this->linenum=$this->linenum+1;
		echo "<b>DEBUG LINE $this->linenum: $key </b>".$content.'<br>';
	}
}
	class FILEINFO{
		public $name;
		public $type;
		public $mtime;
		public $size;
		function __construct($name,$type,$mtime,$size){
			$this->name=$name;
			$this->type=$type;
			$this->mtime=$mtime;
			$this->size=$size;
		}
	}
?>
