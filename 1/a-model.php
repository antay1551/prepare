<?php
include_once 'connection.php';


abstract class AModel {
	static public $_table;
	//static public $_pk;
	static public $_fields = [];

	static public $con;

	static public function get_table(){
		return static::$_table;
	}
	
	public function update($str_update, $id) {
	
	try {
		//var_dump($str_update);
		//echo"$str_update   1111111111111111111111111";
		//$sql = "UPDATE detectives SET `surname`=".$str_update." WHERE id = $id";
		//don't work: ... SET `surname`=$str_update ... to my mind it came in"" but must in ''
		//не пашет апдейт с теми значениями которые приходят(если руками загонять в '' то работает) хз как пофиксить мб в одинарные перевести но идея не оч 
		$sql = "UPDATE detectives SET `surname`='updaaaaate'WHERE id = $id";
		$count = self::$con->exec($sql);
		//print_r( $count );

	} catch(PDOException $e) {
		print "Error!:" . $e->getMessage() . "<br/>";
		die();
	}
		
		
		
		
	}
	
	
	
	public function delete_all_users(){
		try{
			$delrows=self::$con->exec('DELETE FROM detectives');
			return $delrows;
		}
		catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
			exit();
		}	
	}

	public function create() {
		try {
			$sql = 
				"INSERT INTO " . self::$_table  . " (" .
				implode(", ", self::$_fields) . ") VALUES (" . 
				implode(", ", 
					array_map(function($x) {
						return ":" . $x;
					},
					self::$_fields))
				. ")";

	        $query = self::$con->prepare($sql);

	        $execute = [];
	        foreach (self::$_fields as $field) {
	        	$execute[':' . $field] = $this->{$field};
	        }

	        $query->execute($execute);

		} catch(PDOException $e) {
			 print "Error!:" . $e->getMessage() . "<br/>";
			 die();

		}

		return true;
	}

	public function __construct(){
		self::$con = Connection::get_instance()->dbh;
	}

	static public function add_records($records){
		 return array_map(
			function($record) {
				return $record->create();
			},
			$records );
	}

	static public function get_all(){
		$records = [];
		$res = self::$con->query("SELECT * FROM detectives");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)){
			$records[] = $row;
		}
	 	return $records;
	} 

	abstract public function get_one($id);

}

