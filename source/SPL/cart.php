<?php 
/* 
 * 产品类 product
 * */
class Product{
	
	public $no;
	public $productName;
	public $price;
	
	public function __construct($no, $productName, $price){
		$this->no = $no;
		$this->productName = $productName;
		$this->price = $price;
	}
	
	public function getNo(){
		return $this->no;
	}
	
	public function getProductName(){
		return $this->productName;
	}
	
	public function getPrice(){
		return $this->price;
	}
	
}



/*
 * cart 购物车类
 * 1.继承ArrayObject，获取类数组的操作
 * */

class Cart extends ArrayObject{
	
	public $product;
	
	public function __construct(){
		$this->product = array();
		parent::__construct($this->product);	
	}
	
	//获取购物车总价
	public function getPriceTotal(){
		$total = 0;
		foreach ($this as $k=>$v){
			$total += $this[$k]->getPrice();
		}
		return $total;
	}
	
}

$product1 = new Product('001', '零食', '100');
$product2 = new Product('002', '衣服', '100');

$cart = new Cart();
$cart[spl_object_hash($product1)] = $product1; 
$cart[spl_object_hash($product2)] = $product2;
echo '<pre>';
print_r($cart); 

echo 'cart Total： '.$cart->getPriceTotal();  //200

/*  output
Cart Object
(
	[product] => Array
	(
	)

	[storage:ArrayObject:private] => Array
	(	
		[0] => Product Object
		(
			[no] => 001
			[productName] => 零食
			[price] => 100
		)

		[1] => Product Object
		(
			[no] => 002
			[productName] => 衣服
			[price] => 100
		)

	)

)
 */