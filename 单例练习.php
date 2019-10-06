<?php
	header('Content-type: text/html; charset=utf8');

	//练习对象的单例
	
	class danli{
		private static $instance;
		private function __construct()
		{}
		private function __clone()
		{}
		public static function getinstance()
		{
			if(!isset(self::$instance))
			{
				self::$instance=new self;
			}
			return self::$instance;
		}
	}

	$obj1=danli::getinstance();
	$obj2=danli::getinstance();
	var_dump($obj1);
	echo "<br />";
	var_dump($obj2);
	$obj3=new danli();
	
?>