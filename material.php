<?php
class Material{
	var $id;
	var $path;
	private static $conn = Null;

	function __construct($id=-1) {
		if(self::$conn == Null) {
			self::$conn = mysqli_connect('localhost','root','iti','upload');
		}
	}
	function insert() {
		$query= "insert into paths (path) values('$this->path')";
		$result  = mysqli_query(self::$conn,$query);
		return mysqli_insert_id(self::$conn);
	}
	function mateials() {
		$query = "select * from paths";
		$result = mysqli_query(self::$conn,$query);
		$data = [];

		while($row = mysqli_fetch_assoc($result)) {
			$data []= $row;

		}

		return $data;

	}


}