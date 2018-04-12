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

	$obj_User = new User("Maks");
	$handle = fopen ("php://stdin","r");
	
	$i=7;
	while ($i != 0){
	echo"1. Create\n";
	echo"2. Get all\n";
	echo"3. Get one\n";
	echo"4. Update\n";
	echo"5. Delete all users\n";
	echo"0. exit";
	echo "please type i(int)\n";
	$i=(int) fgets($handle);
	    
	switch ($i) {
    case 1:
		$obj_User->create();
		echo"create was sucsesful you may check in table results\n";
	    break;
    case 2:
        $res = $obj_User->get_all();
		print_r($res);
        break;
    case 3:
		echo "please type id(int)\n";
		$id=(int) fgets($handle);
		print_r( $obj_User->get_one( $id ) );
		break;
	case 4:
		echo "please type id(int)\n";
		$id=(int) fgets($handle);
	    $obj_User->update('This is update', $id);
		break;
    case 5:
		$count_del = $obj_User->delete_all_users();
		echo"Count delete number = $count_del\n";
	}
	
	}
	