<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: MysqlLib
	*/

class db extends mysqli{

	protected static $_mysqliCon = null;
	protected $queryCount = 0;
	public function __construct($host, $user, $pass, $db) {
		parent::init();

		if (!parent::options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
			die('Setting MYSQLI_INIT_COMMAND failed');
		}

		if (!parent::options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
			die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
		}

		if (!parent::real_connect($host, $user, $pass, $db)) {
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		} else {
			mysql_connect($host, $user, $pass, $db);
		}
			
	}

	public function query($query){
		$this->queryCount = $this->queryCount + 1;
		return parent::query($query, MYSQLI_STORE_RESULT);
	}
	
	public function __destruct(){
		parent::close();
	}
	
	public function queryAmount(){
		return $this->queryCount;
	}
	
	public function isResult($mysqliObject){
		if($mysqliObject->num_rows >= 1)
			return true;
		return false;
	}
	
	public function escape($esc){
		return mysql_real_escape_string($esc);
	}
	
	public function login($username, $password){
		$login = $this->query("SELECT * FROM icms_user WHERE username = '$username' AND password = PASSWORD('$password') LIMIT 1");
		if($this->isResult($login)){
			$data = $login->fetch_object();
			$_SESSION['userid'] = $data->id;
			$key = md5($_SERVER['REMOTE_ADDR'] + time());
			$_SESSION['key'] = $key;
			setcookie("key", $key, time()+3600);
			return $data;
		} else {
			return false;
		}
	}
}	 
