<?php

class Compras
{
    private $pdo;

    public function __Construct()
    {
        try  				 {	$this->pdo=Database::Conectar(); }
        catch (Exception $e) {	die($e->getMessage());			 }
    }
    

    public function Select()
    {
        try {
        $sql=$this->pdo->prepare("SELECT * FROM tbl_compras ORDER BY id DESC");
        $sql->execute();
        return $sql->fetchALL(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {	die($e->getMessage());			 }
    }


    public function Insert(Compras $data)
    {
        try{
            $sql="INSERT INTO tbl_compras (cantidad,fecha,idLogAcciones,idMaterial,idProveedor,idTipoPago,numeroFactura,observacion, precioVenta)
            VALUES(?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($sql)
            ->execute(
                array(
                $data->cantidad,
                $data->fecha,
                $data->idLogAcciones,
                $data->idMaterial,
                $data->idProveedor,
                $data->idTipoPago,
                $data->numeroFactura,
                $data->observacion,
                $data->precioVenta
                )
            );
        }
        catch (Exception $e) {	
            die($e->getMessage());			 
        }
    }

    public function Update(Compras $data){

    try{

        $sql= "UPDATE tbl_compras SET cantidad=?,fecha=?,idMaterial=?,idProveedor=?,idTipoPago=?,numeroFactura=?,observacion=?, precioVenta=? WHERE id=?;";
        $this->pdo->prepare($sql)->execute(
            array(
            $data->cantidad,
            $data->fecha,
            $data->idMaterial,
            $data->idProveedor,
            $data->idTipoPago,
            $data->numeroFactura,
            $data->observacion,
            $data->precioVenta,
            $data->id
            )
        ); 
    }catch (Exception $e) {
    die($e->getMessage());
    }

    }


}
?>