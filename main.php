<?php
	ob_start();
	session_start();
	// Controladores en Forma SINGULAR *ASI LAS TABLAS ESTEN EN PLURAL*
	// Ctr = Controllador --> Nombre Modulo
	// Acc = Accion       --> Metodo a Realizar o Ejecutar
	require_once('./models/database.php');

	
	$controller = '';


	if (isset($_SESSION['usNombre']) And isset($_SESSION['usRol']) And isset($_SESSION['usId']))
	{
		

		try{
			
			if ( !ISSET($_REQUEST['ctrl']) And isset($_SESSION['usLogin'])){

				echo("login Satisfactorio : ".$_SESSION['usLogin']);
				
			}else{

				$controller = strtolower($_REQUEST['ctrl']);
				$accion = ucwords(strtolower(ISSET($_REQUEST['acti']) ? $_REQUEST['acti'] : 'Index'));

				if(!file_exists("./controllers/$controller.controller.php")){

					$error="No Existe El Controlador";
					echo($error);
					
				}else{

					require_once("./controllers/$controller.controller.php");
					$controller = ucwords($controller)."Controller";
					$controller = new $controller;

					if(method_exists($controller,$accion)){
						
						
						call_user_func(array($controller,$accion));

					}else{

						$error="No Existe El Metodo";
						echo($error);

					}
					
				}

			}
		}catch(Exception $e){

			//require_once("error404.php");
			
		}

	}
	else
	{
		echo("no login");
	 	session_destroy();
	  	die();
	}
?>