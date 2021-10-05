<?php
	ob_start();
	session_start();
	require_once('../models/database.php');
	require_once('../models/usuario.php');

	
	if( ISSET($_GET['usur']) && ISSET($_GET['pass']))
	{
			$user=filter_input(INPUT_GET,'usur',FILTER_SANITIZE_SPECIAL_CHARS);
			$pass=filter_input(INPUT_GET,'pass',FILTER_SANITIZE_SPECIAL_CHARS);
			
			if(ISSET($user) && ISSET($pass))
			{
					$objUser=new Usuario();
					$respuesta=$objUser->Login($user,md5($pass));
					
					
					
					if ($respuesta->login=="NO")
					{
							
						header("Location: ./main.cerrar.php");
						exit();


					}
					elseif($respuesta->login=="SI")
					{
                            $_SESSION['usId'] = $respuesta->userId;
							$_SESSION['usNombre'] = $respuesta->name;
							$_SESSION['usPass'] = $respuesta->passw;
							$_SESSION['usRol'] = $respuesta->rol;
							$_SESSION['usLogin']= $respuesta->login;						
                           
							header('Location: ../main.php');

					}
					else
					{
						echo "NO SE PUEDE POR CREDENCIALES ERRADAS";
						 
						//header("Location: ./main.cerrar.php");
						exit();
					}
		
			}
			else
			{
				echo "VARIABLES VACIAS";
				//header("Location: ./main.cerrar.php");
				exit();
			}
	}
	else
	{

		echo "FORMULARIO VACIO";
		//header("Location: ./main.cerrar.php");
		exit();
	}
?>