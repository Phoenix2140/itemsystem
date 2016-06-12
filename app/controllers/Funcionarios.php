<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class Funcionarios{
		private $config;
		private $view;
		private $funcionario;
		private $departamento;


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
			 * Cargamos el modelo de la tabla funcionarios
			 */
			require_once($this->config->get('modelsDir').'Funcionario.php');
			$this->funcionario = new Funcionario($this->config);

			/**
			 * Cargamos el modelo departamento para obtener el nombre del departamento
			 */
			require_once($this->config->get('modelsDir').'Departamento.php');
			$this->departamento = new Departamento($this->config);
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

			/**
			 * Obtenermos la lista de todos los funcionarios
			 */
			$this->view->listaFuncionarios = $this->funcionario->getFuncionario();

			/**
			 * Obtenemos la lista de departamentos y la guardamos en un array
			 */
			$deptos = array();

			foreach ($this->departamento->getDepartamentos() as $departamento) {
				$deptos[$departamento["id_depto"]] = $departamento["nombre_depto"];
			}
			$this->view->listaNombresDepartamentos = $deptos;


			/**
			 * Dejamos toda la lista de departamentos para mostrarla en los formularios
			 */
			$this->view->listaDepartamentos = $this->departamento->getDepartamentos();

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
						case 'crear':
							
							if($this->comprobarCreacion($post)){
								$this->funcionario->crearFuncionario($post["nombre"], $post["rut"], $post["departamento"]);

								// echo json_encode(array('return' => true));
								$this->redireccion();

							}else{
								// echo json_encode(array('return' => false));
								$this->redireccion();
							}
							break;
						
						default:
							// echo json_encode(array('return' => false));
							$this->redireccion();
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
		 * Comprueba si existen todos los valores antes de 
		 * hacer la consulta y crear
		 */
		public function comprobarCreacion($post){
			if(isset($post["rut"]) && isset($post["nombre"]) && isset($post["departamento"]) &&
				!$this->comprobarExistenciaFuncionario($post["nombre"])){
				return true;
			}else{
				return false;
			}
		}

		/**
		 * Obtiene datos de comprobarCreacion(), además
		 * comprueba que se envíe el identificador
		 */
		public function comprobarEdicion($post){

		}

		/**
		 * Comprobar que no exista un funcionario con el mismo nombre
		 */
		public function comprobarExistenciaFuncionario($nombre){
			foreach ($this->funcionario->getFuncionario() as $funcionario) {
				if($funcionario["nombre"] == $nombre_depto){
					return true;
				}
			}
			return false;
		}

		/**
		 * Redireccion a la página actual
		 */
		public function redireccion(){
			header('Location: '.$this->config->get('baseUrl').'/funcionarios');
		}

	}
?>