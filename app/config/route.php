<?php 
	/**
	 * Se llama a la clase Router para tratar las rutas
	 * y el tipo de Método que utiliza (POST, GET u otro)
	 */
	require_once($config->get('baseDir').'Router.php');
	$ruta = new Router();

	/**
	 * Se cargan todos los controladores que son necesarios
	 * para las distintas rutas y se crean objetos de estas.
	 */
	require_once($config->get('controllersDir').'Home.php');
	require_once($config->get('controllersDir').'Login.php');
	require_once($config->get('controllersDir').'Panel.php');
	require_once($config->get('controllersDir').'Equipos.php');
	require_once($config->get('controllersDir').'Departamentos.php');
	require_once($config->get('controllersDir').'Funcionarios.php');
	$home = new Home($config);
	$login = new Login($config);
	$panel = new Panel($config);
	$equipo = new Equipos($config);
	$departamento = new Departamentos($config);
	$funcionario = new Funcionarios($config);

	
	/**
	 * Se separan las rutas por los métodos GET y POST
	 * que son los métodos más utilizados, se pueden 
	 * incorporar otros según se requiera.
	 */
	if($ruta->get() == 'GET'){

		/**
		 * Se obtiene el enlace de la dirección web y se divide
		 * para poder tratarlas con un switch.
		 *
		 * Por ejemplo si la ruta es http://aplicacion.com/inicio
		 * el post procesado de ruta lo dejaría así:
		 * $enlace[0] = '';
		 * $enlace[1] = 'inicio';
		 *
		 * La ruta raíz de la página por defecto es vacía ''.
		 *
		 * Puedes anidar switches en caso que la ruta tenga 
		 * subdirectorios, por ejemplo http://aplicacion.com/usuario/3
		 * $enlace[0] = "";
		 * $enlace[1] = "usuario";
		 * $enlace[2] = "3";
		 */
		$enlace = $ruta->enlace();

		/**
		 * El Switch utiliza una accion dependiendo de la ruta.
		 */
		switch ($enlace[1]){
			case '':		
				/**
				 * Se llama y retorna la función indexAction() de la clase
				 * Home
				 */
				return $home->indexAction();
				break; // Se finaliza el switch
			
			case 'login': 
				/**
				 * Llamamos a la función indexAction, para mostrar la vista
				 * principal
				 */
				return $login->indexAction();
				break;

			case 'panel':
				/**
				 * Llamamos a la función principal
				 */
				return $panel->indexAction();
				break;

			case 'equipos':
				/**
				 * Llamamos a la función principal
				 */
				return $equipo->indexAction();
				break;

			case 'departamentos':
				/**
				 * Llamamos a la función principal
				 */
				return $departamento->indexAction();
				break;

			case 'funcionarios':
				/**
				 * Llamamos a la función principal
				 */
				return $funcionario->indexAction();
				break;
			
			default:
				# code...
				break;
		}

	}elseif($ruta->get() == 'POST'){
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método GET con el switch
		 */
	}else{
		/**
		 * Pueden agregarse más Métodos
		 */
		echo "Nothing";
	}
 ?>