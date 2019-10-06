<?php
	header('Content-type: text/html; charset=utf8');

	/*
	创建Mysql 用户表  放在php32数据库里

create table usertable(
	id int auto_increment primary key not null,
	uname varchar(10) not null,
	upwd varchar(10) not null,
	uage tinyint not null,
	xueli enum('博士','研究生','大学本科','高中','初中','小学'),
	hobby set('排球','篮球','足球','中国足球','地球'),
	laizi enum('东北','华北','西北','华东','华南','华西'),
	regtime timestamp
					);
	 */
	// insert into usertable values (null,'aa','123',18,'大学本科',3,'东北',null);
	//要注意auto_increment和timestamp要插入null 不要直接,省略

	//连接数据库，为后续做准备
	$link=mysql_connect("localhost","root","123");
	mysql_query("set names utf8");
	mysql_query("use php32");
	
	//如果有Post数据，把Post数据接收到，存入数据库
	if(isset($_POST["uname"]))
	{
		$uname=$_POST["uname"];
		$upwd=$_POST["upwd"];
		$age=$_POST["age"];
		$xueli=$_POST["xueli"];

		$hobby=$_POST["hobby"];
		$hobby_sum=array_sum($hobby);
		$from=$_POST["from"];
		$sql="insert into usertable values (null,'$uname','$upwd',$age,'$xueli','$hobby_sum','$from',null)";
		//注意字符串变量前后要加''
		//echo $hobby_sum;
		$result=mysql_query($sql);
		if($result===false)
		{
			echo "失败，请参考失败提示信息 : ".mysql_error();
		}
	}

	//如果有Get['rid'] 则需要删除相应的记录
	if(isset($_GET["rid"]))
	{
		$id=$_GET["rid"];
		$sql="delete from usertable where id=$id";
		$result=mysql_query($sql);
		if($result===false)
		{
			echo "失败，请参考失败提示信息 : ".mysql_error();
		}
	}
	

?>
<html>
	<head>
	</head>
	<body>
		<form action="" method="post">
			<table border="0">
			<tr>
				<td>添加数据</td>
			</tr>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="uname" size="10" /></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="upwd" size="10" /></td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name="age" size="4" /></td>
			</tr>
			<tr>
				<td>学历</td>
				<td>
					<select name="xueli">
						<option value="1">博士</option>
						<option value="2">研究生</option>
						<option value="3" selected="selected">大学本科</option>
						<option value="4">高中</option>
						<option value="5">初中</option>
						<option value="6">小学</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>兴趣</td>
				<td>
					<input type="checkbox" name="hobby[]" value="1" />排球
					<input type="checkbox" name="hobby[]" value="2" />篮球
					<input type="checkbox" name="hobby[]" value="4" />足球
					<input type="checkbox" name="hobby[]" value="8" />中国足球
					<input type="checkbox" name="hobby[]" value="16" />地球
				</td>
			</tr>
			<tr>
				<td>来自</td>
				<td>
					<input type="radio" name="from" value="1" />东北
					<input type="radio" name="from" value="2" />华北
					<input type="radio" name="from" value="3" />西北
					<input type="radio" name="from" value="4" />华东
					<input type="radio" name="from" value="5" />华南
					<input type="radio" name="from" value="6" />华西
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="submit" />
				</td>
				<td>
					<input type="reset" value="reset" />
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>

<?php

	//分页
	$pagesize=3;
	$page=1;
	if(!empty($_GET['page']))
	{
		$page=$_GET['page'];
	}

	$start=($page-1)*$pagesize;

	//在这里做数据的展示
	//$sql="select uname,uage,xueli,hobby,laizi,regtime from usertable";
	$sql="select * from usertable where 1=1 order by id desc limit $start,$pagesize";
	$result=mysql_query($sql);
	if($result===false)
	{
		echo "失败，请参考失败提示信息 : ".mysql_error();
	}
	else
	{
		echo "<table border=\"1\">";
		while($record=mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$record['uname']."</td>";
			echo "<td>".$record['uage']."</td>";
			echo "<td>".$record['xueli']."</td>";
			echo "<td>".$record['hobby']."</td>";
			echo "<td>".$record['laizi']."</td>";
			echo "<td>".$record['regtime']."</td>";
			echo "<td><a href=\"1zuoye10.php?rid=".$record['id']."\">Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>