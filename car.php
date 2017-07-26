<?php

// 类
// 抽象一个汽车的类
// js object 
// 类 


class carClass {
	// 轮胎
	// 颜色
	// 修饰符
	// java   :  public private(私有地) protected
	private $color;

	// 发动
	
	function run($car_name=""){
		echo $this->color.'的'.$car_name."车跑起来 <br>";
	}

	protected function setColor($col_val="")
	{
		// $this->$color = $col_val;  error  
		$this->color = $col_val;
	}
}


class falli extends carClass{

	public function road()
	{ 
		$this->setColor("红色");
		$this->run("法拉利");
	}

}

$fali = new falli();

// 类的外部调用setColor
// $fali->setColor("红色");

$fali->road();
  


?>