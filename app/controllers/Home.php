<?php 
	/**
	 * Controlador de ejemplo Home llamado desde las rutas
	 * Solo hace uso básico de las vistas y un acceso 
	 * simple a base de datos
	 */
	class Home{
		private $config;
		private $view;

		/**
		 * Constructor del controlador que recibe como
		 * parámetro la configuración
		 */
		public function __construct($config){
			/**
			 * Asigna la configuración recibida en la variable 
			 * privada $config
			 */
			$this->config = $config;

			/**
			 * Carga la clase template y se crea un objeto tipo template
			 * para trabajar con las vistas
			 */
			require_once($this->config->get('baseDir').'Template.php');
			$this->view = new Template();
		}

		public function indexAction(){
			
			/**
			 * Se crean variables en la vista.
			 */
			$this->view->titulo = "ITEMSYSTEM - Gestión de inventarios"; //Título de la página
			$this->view->menuVal = ''; //para seleccionar el menu como selected

			/**
			 * Agregamos la url base para incluir los css y demaces de 
			 * la carpeta public
			 */
			$this->view->baseUrl = $this->config->get('baseUrl');

			/**
			 * Agregamos el menu a la plantilla
			 */
			$this->view->menu = $this->view->render($this->config->get('viewsDir').'menu/base.php');

			/**
			 * Se crea una variable (especial) que contiene una vista
			 * views/home.php, con los valores deseados
			 */
			$this->view->contenido = $this->view->render($this->config->get('viewsDir').'home.php');

			/**
			 * Luego se genera y junta toda la vista en 
			 * la "vista padre" views/header.php, esta vista contiene
			 * en su interior todas las variables creadas anteriormente
			 * incluso la vista parcial home.php
			 */
			echo $this->view->render($this->config->get('viewsDir').'main.php');

		}
	}
 ?>