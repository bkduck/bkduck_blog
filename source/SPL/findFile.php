<?php
/* 
 * 基于SPL 查找特定类型的所有文件
  */

class FindFile extends FilterIterator{
	
	public $path;
	public $suffix;
	
	public function __construct($path,$suffix){
		$this->path = $path;
		$this->suffix = $suffix;
		$it = new RecursiveDirectoryIterator($path);
		parent::__construct( new RecursiveIteratorIterator($it) );
	}
	
	public function accept(){
		/* 过滤后缀 php */
		$pathinfo = pathinfo($this->current());
		return $this->suffix == $pathinfo['extension'];
	}
	
	
}

//输出后缀php的所有文件
$files = new FindFile('./test', 'php');
foreach ($files as $file){
	echo $file;
}

/* 结果
 * ./test\test.php
 *  */