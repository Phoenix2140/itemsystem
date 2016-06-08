<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class Departamentos{
		private $config;
		private $view;
		private $departamento;
		private $articulo;

		/**
		 * Se crea la función construct, que recibe  la configuración y
		 * activa el soporte para vistas
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
			 * Carga el modelo Departamento
			 */
			require_once($this->config->get('modelsDir').'Departamento.php');
			$this->departamento = new Departamento($this->config);

			/**
			 * Carga el modelo Articulo para usar la función contar
			 */
			require_once($this->config->get('modelsDir').'Articulo.php');
			$this->articulo = new Articulo($this->config);
		}

		/**
		 * Funcion que se encarga de mostrar la vista inicial
		 */
		public function indexAction(){
			/**
			 * Creamos las variables básicas de las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios";
			$this->view->menuVal = 'departamentos';

			/**
			 * Agregamos la URL base para llamar a los css y otros elementos
			 * de las vistas
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * Obtener la lista de departamentos, se carga antes del If ya que
			 * todos los roles pueden ver los departamentos
			 */
			$this->view->listDepartamentos = $this->departamento->getDepartamentos();

			/**
			 * Se cuentan todos los equipos por departamento existentes y se devuelven a la vista
			 */
			$contar = array();
			foreach ($this->departamento->getDepartamentos() as $depto) {
				$contar[$depto["id_depto"]] = $this->articulo->contarArticulosDepartamentoId($depto["id_depto"]);
			}
			$this->view->equiposPorDepartamento = $contar;

			if ($_SESSION["tipo"] == 'admin') {
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/departamentos.php');
			}elseif($_SESSION["tipo"] == 'encargado'){
				/**
				 * Agregamos el menú a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos el contenido a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'encargado/departamentos.php');
			}else{
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'normal/departamentos.php');
			}
			/**
			 * Mostramos la vista final
			 */
			echo $this->view->render($this->config->get('viewsDir').'main.php');
		}

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
							if ($this->comprobarCreacion($post)) {
								$this->departamento->crearDepartamento($post["nombre"]);

								header('Location: '.$this->config->get('baseUrl').'/departamentos');
							}else{
								// echo json_encode(array('return' => false));
								header('Location: '.$this->config->get('baseUrl').'/departamentos');
							}
							break;
						
						default:
							# code...
							break;
					}
				}else{
					// echo json_encode(array('return' => false));
					header('Location: '.$this->config->get('baseUrl').'/departamentos');
				}
			}else{
				// echo json_encode(array('return' => false));
				header('Location: '.$this->config->get('baseUrl').'/departamentos');
			}

		}

		public function comprobarCreacion($post){
			if(isset($post["nombre"]) && !$this->comprobarExistenciaDepto($post["nombre"])){
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Función que comprueba si existe un departamento con el mismo nombre
		 */
		public function comprobarExistenciaDepto($nombre){
			
			foreach ($this->departamento->getDepartamentos() as $depto) {

				if($depto["nombre_depto"] == $nombre){ return true; } 

			}
			return false;
		}
	}
?>