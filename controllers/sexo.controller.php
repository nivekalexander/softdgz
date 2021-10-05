<?php

require_once("./models/sexo.php");

class SexoController
{	
    private $sexo;
    private $logacciones;
    function __Construct()	{
    $this->sexo = new Sexo();
    }

   

    public function Insertar()
    {
        $datos= $this->sexo;
        $datos->nombre=$_REQUEST['nombre'];
    
        $this->sexo->Insert($datos);
        
    }										

    public function Eliminar()
    {	
        $id=$_REQUEST['id'];
        $this->sexo->Delete($id);

    }

    public function Actualizar()
    {
        $datos= $this->sexo;
        $datos->nombre=$_REQUEST['nombre'];
        $datos->id=$_REQUEST['id'];
        $this->sexo->Update($datos);

        
    }

}

?>