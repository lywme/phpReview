<?php
	header('Content-type: text/html; charset=utf8');

	$args=array(
		'host'=>'localhost',
		'pwd'=>'123',
		'dbName'=>'php34',
	);

	include "./MysqlDB.class.php";

	$dao=MysqlDB::getInstance($args);
	$sql="select t1.t_name as t1name,m.t1_score,m.t2_score,t2.t_name as t2name,m.m_time from `match` as m join team as t1 on m.t1_id=t1.t_id join team as t2 on m.t2_id=t2.t_id";
	$result=$dao->getAll($sql);

?>
<html>
	<head>
	</head>
	<body>
		<table border="border">
			<th>球队一</th><th>比分</th><th>球队二</th><th>比赛时间</th>
			<?php foreach($result as $key=>$value) : ?>
				<tr>
					<td><?php echo $value['t1name'];?></td>
					<td><?php echo $value['t1_score'].":".$value['t2_score'];?></td>
					<td><?php echo $value['t2name'];?></td>
					<td><?php echo date('Y-m-d H:i',$value['m_time']);?></td>
				</tr>
			<?php endForeach;?>
		</table>
	</body>
</html>