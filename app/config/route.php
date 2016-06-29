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
	require_once($config->get('controllersDir').'Usuarios.php');
	require_once($config->get('controllersDir').'TipoArticulos.php');
	require_once($config->get('controllersDir').'Estados.php');
	require_once($config->get('controllersDir').'Salir.php');
	$home = new Home($config);
	$login = new Login($config);
	$panel = new Panel($config);
	$equipo = new Equipos($config);
	$departamento = new Departamentos($config);
	$funcionario = new Funcionarios($config);
	$usuario = new Usuarios($config);
	$tipoArticulos = new TipoArticulos($config);
	$estados = new Estados($config);
	$salir = new Salir($config);

	
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
				if (isset($_SESSION["user"]) && !is_null($_SESSION["user"])) {
					header('Location: '.$config->get('baseUrl').'/panel');
				}else{
					return $home->indexAction();
				}
				
				break; // Se finaliza el switch
			
			case 'login': 
				/**
				 * Llamamos a la función indexAction, para mostrar la vista
				 * principal
				 */
				if(isset($_SESSION["user"]) && !is_null($_SESSION["user"])){
					header('Location: '.$config->get('baseUrl').'/panel');
				}else{
					return $login->indexAction();
				}
				
				break;

			case 'panel':
				/**
				 * Llamamos a la función principal
				 */
				if(isset($_SESSION["user"]) && !is_null($_SESSION["user"])){
					return $panel->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'equipos':
				/**
				 * Llamamos a la función principal
				 */
				if(isset($_SESSION["user"]) && !is_null($_SESSION["user"])){
					return $equipo->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'departamentos':
				/**
				 * Llamamos a la función principal
				 */
				if(isset($_SESSION["user"]) && !is_null($_SESSION["user"])){
					return $departamento->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'funcionarios':
				/**
				 * Llamamos a la función principal
				 */
				if(isset($_SESSION["user"]) && !is_null($_SESSION["user"])){
					return $funcionario->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'tipos':
				/**
				 * Comprobamos si el usuario está loggeado
				 */
				if (isset($_SESSION["user"]) && !is_null($_SESSION["user"])) {
					return $tipoArticulos->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'estados':
				/**
				 * Comprobamos si el usuario está loggeado
				 */
				if (isset($_SESSION["user"]) && !is_null($_SESSION["user"])) {
					return $estados->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'usuarios':
				/**
				 * Llamamos a la función principal
				 */
				if(isset($_SESSION["tipo"]) && ($_SESSION["tipo"]) == 'admin'){
					return $usuario->indexAction();
				}else{
					header('Location: '.$config->get('baseUrl'));
				}
				break;

			case 'salir':
				return $salir->salir();
				break;

			case 'test':
				var_dump(getenv(OPENSHIFT_MYSQL_DB_HOST));

				var_dump($OPENSHIFT_MYSQL_DB_HOST);

				var_dump("OPENSHIFT_MYSQL_DB_HOST");
				break;
			
			default:
				# code...
				break;
		}

	}elseif($ruta->get() == 'POST'){
		$enlace = $ruta->enlace();
		/**
		 * No está implementado, pero es similar a los pasos del
		 * Método GET con el switch
		 */
		switch ($enlace[1]) {
			case 'login':
				
				$login->login($_POST);

				break;

			case 'equipos':

				$equipo->detectarAccion($_POST);

				break;

			case 'usuarios':

				$usuario->detectarAccion($_POST);

				break;

			case 'departamentos':

				$departamento->detectarAccion($_POST);
				
				break;

			case 'funcionarios':
				
				$funcionario->detectarAccion($_POST);
				break;

			case 'tipos':
				
				$tipoArticulos->detectarAccion($_POST);
				break;

			case 'estados':
				
				$estados->detectarAccion($_POST);
				break;
			
			default:
				# code...
				break;
		}
	}else{
		/**
		 * Pueden agregarse más Métodos
		 */
		echo "Nothing";
	}
 ?>