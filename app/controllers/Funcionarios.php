<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class Funcionarios{
		private $config;
		private $view;

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
		}

		/**
		 * Funcion que se encarga de mostrar la vista inicial
		 */
		public function indexAction(){
			/**
			 * Creamos las variables básicas de las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios";
			$this->view->menuVal = 'funcionarios';

			/**
			 * Agregamos la URL base para llamar a los css y otros elementos
			 * de las vistas
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			if ($_SESSION["tipo"] == 'admin') {
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/funcionarios.php');
			}elseif($_SESSION["tipo"] == 'encargado'){
				/**
				 * Agregamos el menú a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos el contenido a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'encargado/funcionarios.php');
			}else{
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'normal/funcionarios.php');
			}

			/**
			 * Mostramos la vista final
			 */
			echo $this->view->render($this->config->get('viewsDir').'main.php');
		}

		/**
		 * Función que detecta la función enviada por el método post
		 */
		public function detectarAccion($post){
			/**
			 * Si no es admin, retorna un false, ya que el admin puede agregar u editar
			 * información de los funcionarios
			 */
			if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin') {
				/**
				 * Comprobamos que se haya enviado la variable accion
				 * en el $_POST y que no venga nulo, sino retornamos un false
				 */
				if(isset($post["accion"]) && !is_null($post["accion"])){

					/**
					 * Utilizamos un switch para cada tipo de accion 
					 * soportada.
					 */
					switch ($post["accion"]) {
						case 'value':
							# code...
							break;
						
						default:
						// echo json_encode(array('return' => false));
							header('Location: '.$this->config->get('baseUrl').'/funcionarios');
							break;
					}

				}else{
					// echo json_encode(array('return' => false));
					header('Location: '.$this->config->get('baseUrl').'/funcionarios');
				}

			}else{
				// echo json_encode(array('return' => false));
				header('Location: '.$this->config->get('baseUrl').'/funcionarios');
			}
		}

		/**
		 * Comprueba si existen todos los valores antes de 
		 * hacer la consulta y crear
		 */
		public function comprobarCreacion($post){

		}

		/**
		 * Obtiene datos de comprobarCreacion(), además
		 * comprueba que se envíe el identificador
		 */
		public function comprobarEdicion($post){

		}

	}
?>