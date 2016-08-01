<?php
 
/**
 * 第一种：用dir返回对象
 * 遍历指定目录下所有文件
 * @param string $directory
 * @return array
 */
function tree($directory){
	$mydir = dir($directory);
	$files = array();
	while($file = $mydir->read()){
		if((is_dir("$directory/$file")) AND ($file!=".") AND ($file!="..")) { 
			//是目录
			$files[$file] = tree("$directory/$file"); 
		}else{
			//是文件
			if(is_file("$directory/$file"))
				$files[$file] = $file;
		}
	
	}
	$mydir->close();
	return $files;
}

echo "<br/>******************* dir() **********************<br>";
print_r(tree(dirname(__FILE__))) ;

/*****************************************************************************************************/


/**
  * 第二种：DirectoryIterator迭代器
  * 遍历指定目录下所有文件
  * @param string $directory
  * @param array $files
  * @return array
  */
  function reDirectoryIterator ($directory = null ) {
     $iterator = new \DirectoryIterator ( $directory );
     $files = array();
 
    foreach ( $iterator as $info ) {
         if ($info->isFile ()) {
             $files [$info->__toString ()] = $info->getFilename()? $info->getFilename(): 'test1111';
         } elseif (!$info->isDot ()) { //是文件夹
         	 //递归调用方法
             $list = array($info->__toString () => reDirectoryIterator(
                         $directory.DIRECTORY_SEPARATOR.$info->__toString ()
             ));
             if(!empty($files))
                 $files = array_merge_recursive($files, $list);
             else {
                 $files = $list;
             }
         }
     }
     return $files;
 }
echo "<br/>******************* DirectoryIterator **********************<br>";
print_r(reDirectoryIterator(dirname(__FILE__))) ;
 
?> 