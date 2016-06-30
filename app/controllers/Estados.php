<?php 
	/**
	 * Controlador de la vista Estados
	 */
	Class Estados{
		private $config;
		private $view;
		private $estado;

		/**
		 * Constructor de la clase
		 */
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

			/**
			 * Cargamos el modelo de la tabla funcionarios
			 */
			require_once($this->config->get('modelsDir').'Estado.php');
			$this->estado = new Estado($this->config);
		}

		/**
		 * Función que se encarga de mostrar la vista inicial
		 */
		public function indexAction(){
			/**
			 * Creamos las variables básicas de las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios";
			$this->view->menuVal = 'estados';

			/**
			 * Agregamos la URL base para llamar a los css y otros elementos
			 * de las vistas
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * obtenemos la lista de los " tipos de articulos"
			 */
			$this->view->listaEstados = $this->estado->getEstado();

			if($_SESSION["tipo"] == 'admin'){
				/**
				 * Agregamos el menú a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos la pantalla de
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/estados.php');
			}else{
				header('Location: '.$this->config->get('baseUrl'));
			}

			echo $this->view->render($this->config->get('viewsDir').'main.php');

		}

		public function detectarAccion($post){
			/**
			 * Si no es admin o encargado, retorna un false, ya que el admin puede agregar u editar
			 * información de los funcionarios
			 */
			if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin'){
				/**
				 * Comprobamos que se haya enviado la variable accion
				 * en el $_POST y que no venga nulo, sino retornamos un false
				 */
				if(isset($post["accion"]) && !is_null($post["accion"])){
					switch ($post["accion"]) {
						case 'crear':
							if($this->comprobarCreacion($post)){
								$this->estado->crearEstado($post["estado-articulo"], $post["utilizable"]);

								// echo json_encode(array('return' => true));
								$this->redireccion();

							}else{
								// echo json_encode(array('return' => false));
								$this->redireccion();
							}
							break;

						case 'editar':
							if ( $this->comprobarID($post) && $this->comprobarCreacion($post)) {

								$this->estado->updateEstado( $post["id"], $post["estado-articulo"], $post["utilizable"]);
								
								$this->redireccion();
							} else {
								
								$this->redireccion();
							}
							
							break;

						case 'eliminar':
							if ($this->comprobarID($post)) {

								$this->estado->deleteEstado($post["id"]);
								
								$this->redireccion();
							} else {
								
								$this->redireccion();
							}
							
							break;
						
						default:
							# code...
							break;
					}
				}else{
					// echo json_encode(array('return' => false));
					$this->redireccion();
				}

			}else{
				// echo json_encode(array('return' => false));
				$this->redireccion();
			}
		}

		/**
		 * Comprobamos si son enviados los parametros correctos
		 */
		public function comprobarCreacion($post){
			if(isset($post["estado-articulo"]) && isset($post["utilizable"]) && 
				!$this->comprobarExistencia($post["estado-articulo"])){
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Comprobamos que no se repita la descripción en la basede datos
		 */
		public function comprobarExistencia($descripcion){
			foreach ($this->estado->getEstado() as $estado) {
				if ($tipo["descripcion_estado"] == $descripcion) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Verificamos si se envía la variable ID mediante el 
		 * método POST
		 */
		public function comprobarID($post){
			if (isset($post["id"]) && !is_null($post["id"])) {
				return true;
			} else {
				return false;
			}
			
		}

		public function redireccion(){
			header('Location: '.$this->config->get('baseUrl').'/estados');
		}
	}
 ?>