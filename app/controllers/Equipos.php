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

			/**
			 * Agregamos el menu a la vista
			 */
			$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/encargado.php');

			/**
			 * Agregamos el contenido de la vista ( equipos )
			 */
			$this->view->contenido = $this->view->render($this->config->get('viewsDir').'encargado/equipos.php');

			/**
			 * Mostramos la vista final
			 */
			echo $this->view->render($this->config->get('viewsDir').'main.php');
		}
	}
?>