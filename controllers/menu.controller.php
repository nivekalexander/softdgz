<?php

require_once('./models/menu.php');

class MenuController
{	
	private $menu;

	function __Construct()	{
		$this->menu = new Menu();
	}

    public function Select()
    {
        $this->menu->Select();
    }

	public function Insertar()
	{
		$datos= $this->menu;

		$datos->nombre 	= $_REQUEST['nombre'];																	
		$datos->icon 	= $_REQUEST['icon'];	

		$this->menu->InsertMenu($datos);

	}										

	public function Eliminar()
	{	
	
		$id= $_REQUEST['id'];	

		$this->menu->Delete($id);

	}

	public function Actualizar()
	{

		$datos= $this->menu;
		$datos->nombre 	= $_REQUEST['nombre'];																	
		$datos->icon 	= $_REQUEST['icon'];		
		$datos->id= $_REQUEST['id'];	

		$this->menu->Update($datos);

	}
    
    public function Insertarmenurol()
	{
		$datos= $this->menu;

		$datos->idmenu 	= $_REQUEST['idmenu'];																	
		$datos->idrol 	= $_REQUEST['idrol'];	

		$this->menu->InsertMenu($datos);

	}										

	public function Eliminarmenurol()
	{	
	
		$id= $_REQUEST['id'];	

		$this->menu->DeleteMenuRol($id);

	}

	public function Actualizarmenurol()
	{

		$datos= $this->menu;
		$datos->idMenu 	= $_REQUEST['idmenu'];																	
		$datos->idRol 	= $_REQUEST['idrol'];		
		$datos->id= $_REQUEST['id'];	

		$this->menu->UpdateMenuRol($datos);

	}

}

?>