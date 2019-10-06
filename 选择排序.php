<?php
	header('Content-type: text/html; charset=utf8');

	//while each list遍历数组
	
	$arr1 = array(60,40,20,30,50,10);

	function xuanze(&$arr)
	{
		//引用传递数组，进行选择排序
		$len=count($arr);
		$temp=0;
/*		echo "<br /> len=$len";
		echo "<br /> max=$max";
		var_dump($arr);*/
		
		for($i=0;$i<$len-1;$i++)//第一层循环，控制循环n-1次。i=0 1 2 3 4 5
		{
			$max_num=$arr[0];
			$max_xiabiao=0;
			for($j=0;$j<$len-$i;$j++) //找出最大值和下标，并记录最大值和下标
			{						
				if($max_num<$arr[$j])
				{
					$max_num=$arr[$j];
					$max_xiabiao=$j;
				}
			}
			//最大值最后一个不确定位置交换
			$temp=$arr[$j-1];
			$arr[$j-1]=$max_num;
			$arr[$max_xiabiao]=$temp;
		}		
	}


	var_dump($arr1);
	xuanze($arr1);
	echo "<br />选择排序后  <br />";
	var_dump($arr1);
	
?>