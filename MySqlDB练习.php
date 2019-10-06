<?php
	header('Content-type: text/html; charset=utf8');
//MySqlDB类的实现

class MysqlDB
{
	//属性列表，用于设置初始参数
	private $host;
	private $port;
	private $userName;
	private $pwd;
	private $charset;
	private $dbName;

	//单例实现，三私一公
	private static $link;
	private $resource;
	private function __construct($config)
	{
		$this->host=isset($config['host'])?$config['host']:'localhost';
		$this->port = isset($config['port'])? $config['port'] : '3306';
		$this->userName = isset($config['userName'])? $config['userName'] : 'root';
		$this->pwd = isset($config['pwd'])? $config['pwd'] : '';
		$this->charset = isset($config['charset'])? $config['charset'] : 'utf8';
		$this->dbName = isset($config['dbName'])? $config['dbName'] : '';

		//连接数据库
		$this->connect();
		//设置字符集
		$this->setCharset($this->charset);
		//选择数据库
		$this->selectDB($this->dbName);
	}
	private function __clone(){}

	public static function getInstance($config)
	{
		if(!isset(self::$link))
			self::$link=new self($config);
		return self::$link;
	}

	private function connect()
	{
		$this->resource=mysql_connect("$this->host:$this->port","$this->userName","$this->pwd") or die();
	}

	public function query($sql)
	{
		if(!$result=mysql_query($sql,$this->resource))
		{
			echo "<br />执行sql语句失败";
			echo "<br />出错信息为".mysql_error();
			die();
		}
		return $result;
	}

	public function setCharset($charset)
	{
		mysql_set_charset($charset,$this->resource);
	}

	public function selectDB($db)
	{
		mysql_select_db($db,$this->resource);
	}

	//返回一个二维数组
	public function getAll($sql)
	{
		$result=$this->query($sql);
		$arr=array();
		while($rec=mysql_fetch_assoc($result))
		{
			$arr[]=$rec;
		}
		return $arr;
	}

	//返回一行
	public function getRow($sql)
	{
		$result=$this->query($sql);
		if($rec=mysql_fetch_assoc($result))
			return $rec;
	}

	//返回一行一列，一个变量
	public function getOne($sql)
	{
		$result=$this->query($sql);
		$rec=mysql_fetch_row($result);
		if($result===false)
			return false;
		return $rec[0];
	}
}

$arg1=array(
	'host'=>'localhost',
	'port'=>'3306',
	'userName'=>'root',
	'pwd'=>'123',
	'charset'=>'utf8',
	'dbName'=>'php32',
);
$test1=MysqlDB::getInstance($arg1);
$sql="select * from stu";
$result=$test1->getAll($sql);
//var_dump($result);
foreach($result as $key => $value)
{
	foreach($value as $key=>$value)
	{
		echo "<br /> $key => $value";
	}
	echo "<br /><br />";
}
//var_dump($test1);