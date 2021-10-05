<?php

class Logacciones
{
private $pdo;

public function __Construct()
{
	try{	
		$this->pdo=Database::Conectar(); 
	}catch (Exception $e){	
		die($e->getMessage());
	}
}

public function dataTime(){

	$unixTime = time();
	$timeZone = new \DateTimeZone("America/Bogota");
	$time = new \DateTime();
	$time->setTimestamp($unixTime)->setTimezone($timeZone);
	$formattedTime = $time->format('Y/m/d H:i:s');

	return $formattedTime;

}

public function Select($id)
{
	try{
		$sql=$this->pdo->prepare("SELECT * FROM tbl_logacciones WHERE id=?");
		$sql->execute(
			array($id)
		);
		return $sql->fetchALL(PDO::FETCH_OBJ);
	}
catch (Exception $e) {	die($e->getMessage());			 }
}


public function Insert(Logacciones $data)
{

	try{
		
		$data->creadoDateTime=$this->dataTime();
		$sql="INSERT INTO tbl_logacciones (creadoPor,creadoDateTime)
		VALUES(?,?)";
		$this->pdo->prepare($sql)
		->execute(
			array(
				$data->creadoPor,
				$data->creadoDateTime
			)
		);

		return $this->pdo->lastInsertId();
				
	}catch (Exception $e) {	
		die($e->getMessage());			 
	}
}

public function Update(Logacciones $data)
{

	try{
		$data->actualizadoDateTime=$this->dataTime();

		$sql= "UPDATE tbl_logacciones SET actualizadoPor=?,actualizadoDateTime=? WHERE id=?;";
		$this->pdo->prepare($sql)->execute(
			array(
				$data->actualizadoPor,
				$data->actualizadoDateTime,
				$data->idLogAcciones
			)
		); 
	}catch (Exception $e) {
		die($e->getMessage());
	}
}

public function Delete(Logacciones $data)
{
	try{
		$data->eliminadoDateTime=$this->dataTime();
		
		$sql="UPDATE tbl_logacciones SET eliminadoPor=?,eliminadoDateTime=? WHERE id=?;";
		$this->pdo->prepare($sql)
		->execute(
			array(
				$data->eliminadoPor,
				$data->eliminadoDateTime,
				$data->$idLogAcciones
			)
		);
	}catch (Exception $e) {	
		die($e->getMessage());			 
	}
}

}
?>