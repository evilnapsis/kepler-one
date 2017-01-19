<?php
class OperationData {
	public static $tablename = "operation";

	public function OperationData(){


		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (q,product_id,kind,created_at) ";
		$sql .= "value (\"$this->q\",\"$this->product_id\",\"$this->kind\",$this->created_at)";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k,$v){
		$sql = "delete from ".self::$tablename." where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}

	public static function sumByPK($p,$k){
		 $sql = "select sum(q) as s from ".self::$tablename." where product_id=$p and kind=$k";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}

	public static function sumByPKD($p,$k,$d){
		 $sql = "select sum(q) as s from ".self::$tablename." where product_id=$p and kind=$k and date(created_at)=\"$d\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperationData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByKind($k){
		 $sql = "select * from ".self::$tablename." where kind=$k order by date_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllByKindDate($d,$k){
		 $sql = "select * from ".self::$tablename." where kind=$k and date_at=\"$d\" order by date_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getSumByKindDate($d,$k){
		$sql = "select sum(amount) as t from ".self::$tablename." where kind=$k and date_at=\"$d\" order by date_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperationData());
	}


}

?>