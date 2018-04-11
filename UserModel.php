<?php

include_once "a-model.php";

class User extends AModel {
	//static private $id;
	public function __construct($surname){
		parent::__construct();
		$this->surname = $surname;
		//$this->id = $id;
		self::$_table = 'detectives';
		self::$_fields = ['surname'];

		var_dump(self::$con);
	}
	
	public function get_one($id){
		$res = self::$con->query("SELECT * FROM detectives where id = $id");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
}

$obj_User = new User("Ivan");
$obj_User->create();
$res = $obj_User->get_all();
print_r($res);
echo"1411111111111111111111\n";
print_r( $obj_User->get_one( 5 ) );
