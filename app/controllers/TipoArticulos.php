<?php 
	/**
	 * Controlador de maneja la vista TipoArticulo,
	 * sólo para los administradores que crean los tipos de artículo
	 * que van a administrar
	 */
	class TipoArticulos{
		private $config;
		private $view;
		private $tipoArticulo;

		public function __construct($config){
			/**
			 * Obtiene y asigna la configuración
			 */
			$this->config = $config;

			/**
			 * Cargamos el soporte para las vistas
			 */
			require_once($this->config->get('baseDir').'Template.php');
			$this->view = new Template();

			/**
			 * Cargamos el modelo de TipoArticulo
			 */
			require_once($this->config->get('modelsDir').'TipoArticulo.php');
			$this->tipoArticulo = new TipoArticulo($this->config);
		}

		/**
		 * Función que se encarga de mostrar la vista inicial
		 */
		public function indexAction(){
			/**
			 * Creamos las variables básicas de las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios";
			$this->view->menuVal = 'tipos';

			/**
			 * Agregamos la URL base para llamar a los css y otros elementos
			 * de las vistas
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * obtenemos la lista de los " tipos de articulos"
			 */
			$this->view->listaTipos = $this->tipoArticulo->getTipoArticulo();

			if($_SESSION["tipo"] == 'admin'){
				/**
				 * Agregamos el menú a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos la pantalla de
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/tipoArticulos.php');
			}else{
				header('Location: '.$this->config->get('baseUrl'));
			}

			echo $this->view->render($this->config->get('viewsDir').'main.php');

		}

		/**
		 * Función que detecta la acción a tomar por el método POST
		 * enviado desde las rutas.
		 */
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
							if($this->comprobarCreacion($post["tipo-articulo"])){
								$this->tipoArticulo->crearTipoArticulo($post["tipo-articulo"]);

								// echo json_encode(array('return' => true));
								$this->redireccion();

							}else{
								// echo json_encode(array('return' => false));
								$this->redireccion();
							}
							break;

						case 'editar':

							if ($this->comprobarID($post) && (isset($post["tipo-articulo"]) 
								&& $this->comprobarCreacion($post["tipo-articulo"]))) {

								$this->tipoArticulo->updateTipoArticulo($post["id"], $post["tipo-articulo"]);
								
								// echo json_encode(array('return' => true));
								$this->redireccion();
							}else {
								
								// echo json_encode(array('return' => false));
								$this->redireccion();
							}

							
							break;

						case 'eliminar':
							if ($this->comprobarID($post)) {

								$this->tipoArticulo->deleteTipoArticulo($post["id"]);
								
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
		 * Comprobamos que la descripción del artículo que exista y no sea nulo,
		 * además que no se repita. si pasa los controles se retorna true.
		 */
		public function comprobarCreacion($desTipoArticulo){
			if(isset($desTipoArticulo) && !is_null($desTipoArticulo) && !$this->comprobarExistencia($desTipoArticulo)){
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Función que comprueba si existe una descrićión del mismo nombre
		 */
		public function comprobarExistencia($descripcion){
			$str = strtolower($descripcion);
			foreach ($this->tipoArticulo->getTipoArticulo() as $tipo) {
				if (strtolower($tipo["descripcion_tipoArticulo"]) == $str) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Comprobamos si los datos enviados pos POST exista una
		 * variable "id" y que no sea nulo
		 */
		public function comprobarID($post){
			if (isset($post["id"]) && !is_null($post["id"])) {
				return true;
			} else {
				return false;
			}
			
		}

		/**
		 * Redireccionamos la página
		 */
		public function redireccion(){
			header('Location: '.$this->config->get('baseUrl').'/tipos');
		}
	}
 ?>