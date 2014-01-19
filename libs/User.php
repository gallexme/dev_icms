<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: UserLib
	*/

class User extends AbstractLib{

	protected $user = array();
	protected static $_userDataQuery = null;	
	protected static $_loggedIn = false;
	function __construct(){
		
	}

	public function loadUser($user = null, $reload = false){
		$sUser = Core::getInstance()->getLib('Session')->getSession('user');
		if(is_null($user)){
			if(is_null($sUser)){
				return false;
			} else {
				$user = $sUser;            
			}
		}
		if(is_null(self::$_userDataQuery) or $reload == true){
			$userQuery = Core::db()->query("SELECT * FROM icms_user WHERE id = ".$user." LIMIT 1");
			self::$_userDataQuery = $userQuery;
		} else {
			$userQuery = self::$_userDataQuery;
		}
		if (!Core::db()->isResult($userQuery))
			return false;
			
		while($detail = $userQuery->fetch_object()){
			$this->user['id'] = $detail->id;
			$this->user['username'] = $detail->username;
			$this->user['password'] = $detail->password;
			$this->user['email'] = $detail->email;
			$this->user['money'] = $detail->money;
			$this->user['premium'] = $detail->premium;
			$this->user['register'] = $detail->register;
		}
		self::$_loggedIn = true;
		return true;		
	}
	
	public function getUser($index = null){
		if (isset($this->user['id']))
			if(is_null($index))
				return $this->user;
			else
				return $this->user[$index];
		else
			return false;
	}
	
	public function isLoggedIn(){
		if(isset($_SESSION['userid']))
			return true;
		return false;
	}
	
	public function logout(){
		unset($_SESSION['userid']);
		unset($_SESSION['key']);
	}
		
		
	public function getId(){
		return $this->user['id'];
	}
}	 
