<?php
	header('Content-type: text/html; charset=utf8');

	//使用二分法查找有序数组中的元素
	
	$arr1 = array(3,4,5,15,19,21,25,28,30,30,33,38,44,51,52,55,60,77,80,82,83);
	$len=count($arr1);
	$keyw=44;

	function erfen($arr,$keyword,$startp,$endp)
	{
		//第一步，找到二分后的位置
		$pos=floor(($startp+$endp)/2);
		//判断这个位置的元素是否为所找的
		if($keyword==$arr[$pos])
		{
			//如果相等，直接返回下标
			return $pos;
		}else if($keyword>$arr[$pos])
		{
			//如果要找的数据大于中间元素，去右面继续找
			//计算出右面起止的位置
			$startp=$pos+1;
			if($startp<=$endp)
				return erfen($arr,$keyword,$pos+1,$endp);
			else
				return false;
		}else if($keyword<$arr[$pos])
		{
			//如果要找的数据小于中间元素，去左边继续找
			$endp=$pos-1;
			if($startp<=$endp)
				return erfen($arr,$keyword,$startp,$pos-1);
			else
				return false;
		}

	}


	var_dump($arr1);
	$position=erfen($arr1,$keyw,0,$len-1);
	echo "<br /> 所查数据{$keyw}在数组中的下标为{$position}";
	
?>