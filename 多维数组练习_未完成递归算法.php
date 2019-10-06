<?php
	header('Content-type: text/html; charset=utf8');

	$arr2=array(
					5,
					array(3,5,6,33,44,55),
					array(2,9,4,22),
					array(5,2,11),
					array(
							3,4,5,
							array(
								61,62,63
							)
						)
				);
	$arr1=array(
					array(10,10),
					5,
					array(
						5,5,5,4,5,6,
							array(
								5,5,5
							)
							),

				);





   //求和，最大，最小值
   //提示：使用递归，判断数据类型 is_array(), is_numeric()
   
   function calcsum($arr)  //求和
   {
   		static $sum=0;
   		$len=count($arr);
   		for($i=0;$i<$len;$i++)
   		{
   			if(is_array($arr[$i]))//先判断如果是数组
   			{
   				$len2=count($arr[$i]);
   				for($j=0;$j<$len2;$j++)
   				if(isset($arr[$i][$j][0])&&is_numeric($arr[$i][$j][0]))//如果有三维数组
				{
					$len3=count($arr[$i][$j]);
					for($f=0;$f<$len3;$f++)
					{
						$sum+=$arr[$i][$j][$f];
					}
				}
				else if(isset($arr[$i][0])&&is_numeric($arr[$i][0]))//如果有二维数组
				{
					$sum+=$arr[$i][$j];
				}
			}
   			else if(is_numeric($arr[$i]))//先判断如果是数值
   			{
   				$sum+=$arr[$i];
   			}
   		}
   		return $sum;
	}

   function calcmax($arr)  //求最大值
   {
   		static $max=0;
   		$len=count($arr);
   		for($i=0;$i<$len;$i++)
   		{
   			if(is_array($arr[$i]))//先判断如果是数组
   			{
   				$len2=count($arr[$i]);
   				for($j=0;$j<$len2;$j++)
   				if(isset($arr[$i][$j][0])&&is_numeric($arr[$i][$j][0]))//如果有三维数组
				{
					$len3=count($arr[$i][$j]);
					for($f=0;$f<$len3;$f++)
					{
						if($arr[$i][$j][$f]>$max)
							$max=$arr[$i][$j][$f];
					}
				}
				else if(isset($arr[$i][0])&&is_numeric($arr[$i][0]))//如果有二维数组
				{
					if($arr[$i][$j]>$max)
						$max=$arr[$i][$j];
				}
			}
   			else if(is_numeric($arr[$i]))//先判断如果是数值
   			{
   				if($arr[$i]>$max)
   					$max=$arr[$i];
   			}
   		}
   		return $max;
	}

	function calcmaxdigui($arr)//递归求最大值
	{
 		static $max=0;
   		$len=count($arr);
   		for($i=0;$i<$len;$i++)
   		{
   			if(is_array($arr[$i]))//先判断如果是数组
   			{
   				$len2=count($arr[$i]);
   				for($j=0;$j<$len2;$j++)
   				if(isset($arr[$i][$j][0])&&is_numeric($arr[$i][$j][0]))//如果有三维数组
				{
					
					return calcmaxdigui($arr[$i][$j][$f]);
				}
				else if(isset($arr[$i][0])&&is_numeric($arr[$i][0]))//如果有二维数组
				{

					return calcmaxdigui($arr[$i][$j]);
				}
			}
   			else if(is_numeric($arr[$i]))//先判断如果是数值
   			{
   				if($arr[$i]>$max)
   					$max=$arr[$i];
   			}
   			if(is_numeric($arr))
   			{
   				   	if($arr>$max)
   					$max=$arr[$i];
   			}
   		}
   		return $max;
	}
	// echo "<pre>";
	// var_dump($arr1);
	$result=calcsum($arr2);
	echo "<br />多维数组的和为：".$result;


	$result=calcmax($arr2);
	echo "<br />多维数组中的最大值为：".$result;

	$result=calcmaxdigui($arr2);
	echo "<br />通过递归求得多维数组中的最大值为：".$result;
	// if(is_array($arr1[0]))
	// 	echo "TRUE";
	// else
	// 	echo "False";
?>