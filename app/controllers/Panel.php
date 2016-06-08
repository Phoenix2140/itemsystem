<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class Panel{
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
			 * Variables agregadas a las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios"; //Título de la página
			$this->view->menuVal = 'panel'; //para seleccionar el menu como selected

			/**
			 * Agregamos la url base para incluir los css y demaces de 
			 * la carpeta public
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * Mostramos las vistas dependiendo del rol del usuario
			 */
			if ($_SESSION["tipo"] == 'admin') {
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/admin.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'administrador/panel.php');
			}elseif($_SESSION["tipo"] == 'encargado'){
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'encargado/panel.php');
			}else{
				/**
				 * Agregamos el menu a la vista
				 */
				$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

				/**
				 * Agregamos la pantalla panel a la vista
				 */
				$this->view->contenido = $this->view->render($this->config->get('viewsDir').'normal/panel.php');
			}

			/**
			 * Mostramos la vista final
			 */
			echo $this->view->render($this->config->get('viewsDir').'main.php');
		}
	}
?>