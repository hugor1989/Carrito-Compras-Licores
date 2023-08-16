<?php
class dbconn {
	public $dblocal;
	public function __construct()
	{

	}
	public function initDBO()
	{
		$user = 'solhexc1_carrito1';
		$pwd = 'vmLk(_tQe0!,';
		$dbname = 'solhexc1_carrito';
		try {
			$this->dblocal = new PDO("mysql:host=localhost;dbname=".$dbname.";charset=latin1",$user,$pwd,array(PDO::ATTR_PERSISTENT => true));
			$this->dblocal->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			die("Can't connect database");
		}
		
	}
	
}