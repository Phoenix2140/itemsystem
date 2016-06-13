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

		public function comprobarCreacion($desTipoArticulo){
			if(isset($desTipoArticulo) && !is_null($desTipoArticulo) && !$this->comprobarExistencia($desTipoArticulo)){
				return true;
			}else{
				return false;
			}
		}

		public function comprobarExistencia($descripcion){
			foreach ($this->tipoArticulo->getTipoArticulo() as $tipo) {
				if ($tipo["descripcion_tipoArticulo"] == $descripcion) {
					return true;
				}
			}
			return false;
		}

		public function redireccion(){
			header('Location: '.$this->config->get('baseUrl').'/tipos');
		}
	}
 ?>