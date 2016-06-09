<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class Equipos{
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
			 * Creamos las variables básicas del controlador
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios";
			$this->view->menuVal = 'equipos';

			/**
			 * Agregamos la URL base para incluir los css y archivos 
			 * de public
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			if ($_SESSION["tipo"] == 'admin') {
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos la pantalla equipos a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/equipos.php');
			}elseif($_SESSION["tipo"] == 'encargado'){
				/**
				 * Agregamos el menú a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos el contenido a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'encargado/equipos.php');
			}else{
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'normal/equipos.php');
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
			 * Si no es admin o encargado, retorna un false, ya que el admin y 
			 * administradorpuede agregar u editar información de los
			 * funcionarios
			 */
			if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'admin' || $_SESSION['tipo'] == 'encargado') {
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
							header('Location: '.$this->config->get('baseUrl').'/equipos');
							break;
					}

				}else{
					// echo json_encode(array('return' => false));
					header('Location: '.$this->config->get('baseUrl').'/equipos');
				}

			}else{
				// echo json_encode(array('return' => false));
				header('Location: '.$this->config->get('baseUrl').'/equipos');
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

		/**
		 * Comprueba si existe un elemento con el mismo
		 * nombre para no tener datos duplicados
		 */
		public function comprobarExistencia(){

		}
	}
?>