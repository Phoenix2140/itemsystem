<?php 
	Class Usuarios{
		private $config;
		private $view;
		private $usuario;

		public function __construct($config){
			/**
			 * Obtiene y asigna la configuración
			 */
			$this->config = $config;

			/**
			 * Carga el soporte para vistas
			 */
			require_once($this->config->get('baseDir').'Template.php');
			$this->view = new Template();

			require_once($this->config->get('modelsDir').'Usuario.php');
			$this->usuario = new Usuario($this->config);
		}

		public function indexAction(){
			/**
			 * Variables asignadas a las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios"; //Título de la página
			$this->view->menuVal = 'usuarios'; //para seleccionar el menu como selected

			/**
			 * Agregamos la url base para incluir los css y demaces de 
			 * la carpeta public
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * Comprobamos si el usuario es el administrador, ya que solo el usuario
			 * administrador puede acceder a la gestión de usuarios
			 */
			if (isset($_SESSION["tipo"]) && ($_SESSION["tipo"] == 'admin')) {

				/**
				 * Le enviamos la lista completa de usuarios
				 */
				$this->view->usuarios = $this->usuario->getUsuarios();
				/**
				 * Agregamos la vista menu
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos el contenido de la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/usuarios.php');

				/**
				 * Mostramos la vista generada
				 */
				echo $this->view->render($this->config->get('viewsDir').'main.php');
			}else{
				header('Location: '.$this->config->get('baseUrl').'/panel');
			}
		}

		/**
		 * Función que detecta que acciones tomar desde el POST
		 */
		public function detectarAccion($post){
			/**
			 * Si no es admin, retorna un false
			 */
			if (isset($_SESSION["tipo"]) && ($_SESSION["tipo"] == 'admin')) {

				/**
				 * Comprobamos que el campo accion exista y no sea nulo
				 */
				if(isset($post["accion"]) && !is_null($post["accion"]) ){

					switch ($post["accion"]) {
						case 'crear':
							/**
							 * Si todos los valores son enviados por el POST
							 * se procede a hacer la consulta a la query (grabar datos)
							 */
							if($this->comprobarCreacion($post)){
								/**
								 * Se escribe en la base de datos (por fin)
								 */
								$this->usuario->crearUsuario( $post["tipo-usuario"],  
								$post["usuario"], $post["pass"]);

								header('Location: '.$this->config->get('baseUrl').'/usuarios');

							}else{
								// echo json_encode(array('return' => false));
								header('Location: '.$this->config->get('baseUrl').'/usuarios');
							}
							
							break;

						case 'editar':
							/**
							 * Si todos los valores necesitados existen,
							 * se procede a realizar el cambio en la base de
							 * datos
							 */
							if($this->comprobarEdicion($post)){
								/**
								 * Si el campo de la contraseña está vacía, significa
								 * que el usuario no quiere cambiar su contraseña
								 */
								if($post["pass"] != ""){
									$this->usuario->updateUsuario( $post["id"], $post["tipo-usuario"], 
										$post["usuario"], $post["pass"]);
									
								}else{
									$this->usuario->updateUsuarioSinPass( $post["id"], $post["tipo-usuario"], 
										$post["usuario"]);
								}

								header('Location: '.$this->config->get('baseUrl').'/usuarios');

							}else{
								// echo json_encode(array('return' => false));
								header('Location: '.$this->config->get('baseUrl').'/usuarios');
							}
							break;

						case 'eliminar':
							/**
							 * Si existe el ID, entonces se puede eliminar
							 */
							if (isset($post["id"])) {

								$this->usuario->deleteUsuario($post["id"]);
								
								header('Location: '.$this->config->get('baseUrl').'/usuarios');

							}else{
								// echo json_encode(array('return' => false));
								header('Location: '.$this->config->get('baseUrl').'/usuarios');
							}
							break;
						
						default:
							// echo json_encode(array('return' => false));
							header('Location: '.$this->config->get('baseUrl').'/usuarios');
							break;
					}
				}
			}else{
				echo json_encode(array('return' => false));
			}

		}

		/**
		 * Función que comprueba si están todos los valores necesarios
		 */
		public function comprobarCreacion($post){
			if ( (isset($post["usuario"]) && $post["usuario"] != "") && isset($post["pass"]) && 
				isset($post["tipo-usuario"]) && !$this->comprobarExistenciaUsuario($post["usuario"])) {
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Función que comprueba si están todos los datos del POST
		 * para la edición del usuario
		 */
		public function comprobarEdicion($post){

			if ( isset($post["id"]) && $this->comprobarCreacion($post)) {
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Función que comprueba si el usuario tiene el mismo nombre
		 */
		public function comprobarExistenciaUsuario($nombre){
			/**
			 * Comprobamos si existe un usuario que se llame igual,
			 * si el usuario es nuevo se crea, pero si ya existe
			 * se omite la creación de usuario y se devuelve un false
			 * para no tener inconsistencias de usuario
			 */
			foreach ($this->usuario->getUsuarios() as $usuario) {

				if($usuario["nombreUsuario"] == $nombre){ return true; } 

			}
			return false;
		}

		
	}
 ?>