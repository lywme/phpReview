<?php
	header('Content-type: text/html; charset=utf8');

	//while each list遍历数组
	
	$arr1 = array(60,50,40,30,20,10);

	function maopao(&$arr)
	{
		//引用传递数组，进行冒泡排序
		$len=count($arr);
		$max=$arr[0];
		$temp=0;
/*		echo "<br /> len=$len";
		echo "<br /> max=$max";
		var_dump($arr);*/
		
		for($i=0;$i<$len-1;$i++)//第一层循环，控制循环n-1次。i=0 1 2 3 4 5
			for($j=0;$j<$len-$i-1;$j++)//当i=0时，需要循环5次。当i=1时，需要循环4次 
			{						//j需要从0 1 2 3 4  到0 1 2 3  到0 1 2 ....到0
				if($arr[$j+1]<$arr[$j])//当j=0时，要跟j=1的两项对比大小
				{
					$temp=$arr[$j]; //大项给temp
					$arr[$j]=$arr[$j+1]; //前一项跟后一项交换
					$arr[$j+1]=$temp; //大项交换给后一项 
				}
			}		
	}


	var_dump($arr1);
	maopao($arr1);
	echo "<br />冒泡后  <br />";
	var_dump($arr1);
	
?>