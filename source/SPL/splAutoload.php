<?php 

/* 
 * 代码片段一：__autoload 用法 
 * 实现：__autoload自动加载类库，同时报出异常
 * NOTE: __autoload多次定义会报错
 * */
function __autoload($class) {
    echo 'load' . $class . 'php';
    throw new Exception('Unable to load' .$class. 'php');
}

try {
    $obj = new MyClass();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}


/*
 * 代码片段二：spl_autoload_register 基本用法
 * NOTE: 
 * 1.参数null，默认实现函数spl_autoload()
 * */
function myLoader1($class) {
	//加载第三方类库vender
}

function myLoader2($class) {
	//加载自定义类库
}

spl_autoload_register(null,false);
spl_autoload_register('myLoader1',false);
spl_autoload_register('myLoader2',false);



/*
 * 代码片段三：解决__autoload()和spl_auto_register兼容问题
 * NOTE:
 * 1.spl_autoload_register() === false 
 *   spl自动加载栈未初始化
 * 2.若已实现__autoload()，spl_autoload_register()
 *   函数会将Zend Engine中的 __autoload()函数取代为
 *   spl_autoload()或spl_autoload_call()。 
 * */
if( false === spl_autoload_register()){
	if( function_exists('__autoload') ){
		spl_autoload_register('__autoload',false);
	}
}