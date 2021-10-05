<?php

	require_once('./models/usuario.php');

	class UsuarioController
	{	
		private $usuario;

		function __Construct()	{
							  		$this->usuario = new Usuario();
							  	}

		public function Index()
								{	
                                    
								    //require_once('../views/comentario/comentarioView.php');
								}

		public function Insertar()
								{
									$datos= $this->usuario;

									$datos->respst 	= $_REQUEST['respst'];
									$datos->perprt 	= $_REQUEST['perprt'];
									$datos->usunumdnt 	= $_SESSION['SIdu'] ;
									if(isset($_REQUEST['comid'])){
										$datos->comid	= $_REQUEST['comid'];
										$this->usuario->InsertResp($datos);
									}else{
										$datos->forid = $_REQUEST['id'];
										$this->usuario->Insert($datos);
									}																		

									//require_once('../views/usuario/usuarioSelect.php');
								}										

		public function Eliminar()
								{	
									if(isset($_REQUEST['resid'])){
										$this->usuario->DeleteResp($_REQUEST['resid']);
									}else{
										$this->usuario->Delete($_REQUEST['comid']);
									}										

									//require_once('../views/usuario/usuarioSelect.php');
								}

		public function Actualizar()
									{
										$datos = $this->usuario;
										$datos->respst 	= $_REQUEST['respst'];
										
										if(isset($_REQUEST['resid'])){
											$datos->id = $_REQUEST['resid'];
											$this->usuario->UpdateResp($datos);
										}else{
											$datos->id = $_REQUEST['comid'];
											$this->usuario->Update($datos);
										}										

										//require_once('../views/comprador/compradorSelect.php');
										 
									}

	}

?>