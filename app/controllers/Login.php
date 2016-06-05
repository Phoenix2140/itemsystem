<?php 
	/**
	 * Controlador de Login, muestra y trata la pantalla de login
	 */

	Class Login{
		private $config;
		private $view;

		/**
		 * Se crea la función construct, que recibe la configuración y
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
		 * Función que se encarga de mostrar la vista inicial
		 */
		public function indexAction(){
			/**
			 * Variables asignadas a las vistas
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios"; //Título de la página
			$this->view->menuVal = 'login'; //para seleccionar el menu como selected

			/**
			 * Agregamos la url base para incluir los css y demaces de 
			 * la carpeta public
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * Agregamos la plantilla menu a la vista
			 */
			$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/base.php');

			/**
			 * Agregamos la plantilla login a la vista
			 */
			$this->view->contenido = $this->view->render($this->config->get('viewsDir').'login.php');

			/**
			 * Mostramos la vista rendereada
			 */
			echo $this->view->render($this->config->get('viewsDir').'main.php');
		}
	}
 ?>