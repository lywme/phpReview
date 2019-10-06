<?php
	header('Content-Type:text/html;charset=utf-8');
//树状显示所有文件结构

/*
 * @param $path 目录地址
 * @param $deep=0  递归的层级
 */
function dirTree($path,$deep=0)
{
	$dir_handle=openDir($path);

	//循环打开文件或目录
	while(false!==$file=readDir($dir_handle))
	{
		if($file=='.' || $file=='..')
			continue;
		if($deep!='0')
		{
			echo str_repeat("&nbsp", $deep*10)."┗".$file.'<br />';
		}
		else
		{
			echo $file.'<br />';
		}
		if(is_dir($path.'/'.$file))
		{
			//如果是目录，继续递归调用此函数
			$func_name=__FUNCTION__;
			$func_name($path.'/'.$file,$deep+1);
		}
	}

	closeDir($dir_handle);
}

	if(isset($_POST['path_dir']))
	{
		$path_dir=$_POST['path_dir'];
		dirTree($path_dir);
	}
	else
	{
		echo "还没有设置有效路经 <br />";
	}
	//var_dump($_POST['path_dir']);
?>
<html>
	<head>
	</head>
	<body>
		<form action="" method="post">
			磁盘目录路经：<input type="text" name="path_dir" />
			<br />
			<input type="submit" value="submit" />
		</form>
	</body>
</html>