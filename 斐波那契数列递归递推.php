<?php
	header('Content-type: text/html; charset=utf8');

	//求斐波那契数列第n项的值,n必须大于等于3开始
	// 1,1,2,3,5,8,12,21  前两项是已知的，某项的值是前两项的值的和
	
	function feibnq1($n)   //递归算法
	{
		if($n==3)
		{
			return 2;
		}
		else if($n==2||$n==1)
			{
				return 1;
			}
			else
			{
				return feibnq1($n-1)+feibnq1($n-2);
			}
	}

	function feibnq2($n)    //递推算法
	{
		//想办法推出$n-2和$n-1的值
		$x1=1;  //代表第1项，之后代表第x项的前2项
		$x2=1;	//代表第2项，之后代表第x项的前1项
		$sum=0; //用于存放第n项

		for($i=1;$i<=$n;$i++)
		{
			if($i>=3)
			{
				$sum=$x1+$x2;
				$x1=$x2;
				$x2=$sum;
			}
			else
			{
				$sum=1;
			}
		}
		return $sum;
	}

	for($i=1;$i<=50;$i++)
	{
		echo "斐波那契数列第".$i."项为：";
		echo feibnq1($i);
		echo "<br />";
	}
   
?>
