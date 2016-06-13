<?php 
	/**
	 * Controlador que muestra la pantalla de selección una vez loggeado
	 * separa por usuarios (usuario, encargado o administrador)
	 */

	Class Equipos{
		private $config;
		private $view;
		private $articulo;
		private $estado;
		private $tipo;
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
			 * Cargamos el modelo Artículo
			 */
			require_once($this->config->get('modelsDir').'Articulo.php');
			$this->articulo = new Articulo($this->config);

			/**
			 * Cargamos el modelo Estado
			 */
			require_once($this->config->get('modelsDir').'Estado.php');
			$this->estado = new Estado($this->config);

			/**
			 * Cargamos el modelo TipoArticulo
			 */
			require_once($this->config->get('modelsDir').'TipoArticulo.php');
			$this->tipo = new TipoArticulo($this->config);

			/**
			 * Cargamos el modelo Departamento
			 */
			require_once($this->config->get('modelsDir').'Departamento.php');
			$this->departamento = new Departamento($this->config);
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
			 * Cobtenemos los datos de Departamento, los asignamos a un 
			 * array (para facilidad de acceso) y una lista en bruto para
			 * recorrerla en los formularios
			 */
			$auxArray = array(); //Se crea el array Auxiliar
			foreach ($this->departamento->getDepartamentos() as $depto) {
				$auxArray[$depto["id_depto"]] = $depto["nombre_depto"];
			}
			$this->view->arrayDepartamentos = $auxArray;
			$this->view->listaDepartamentos = $this->departamento->getDepartamentos();

			/**
			 * Cobtenemos los datos de TipoArticulo, los asignamos a un 
			 * array (para facilidad de acceso) y una lista en bruto para
			 * recorrerla en los formularios
			 */
			$auxArray = array(); // Se limpia el array Auxiliar
			foreach ($this->tipo->getTipoArticulo() as $tipoAr) {
				$auxArray[$tipoAr["id_tipoArticulo"]] = $tipoAr["descripcion_tipoArticulo"];
			}
			$this->view->arrayTipos = $auxArray;
			$this->view->listaTipos = $this->tipo->getTipoArticulo();

			/**
			 * Cobtenemos los datos de Estado, los asignamos a un 
			 * array (para facilidad de acceso) y una lista en bruto para
			 * recorrerla en los formularios
			 */
			$auxArray = array(); // Se limpia el array Auxiliar
			foreach ($this->estado->getEstado() as $estadoAr) {
				$auxArray[$estadoAr["id_estado"]] = array('descripcion' => $estadoAr["descripcion_estado"], 
					'utilizable' => $estadoAr["ultilizable"]);
			}
			$this->view->arrayEstados = $auxArray;
			$this->view->listaEstados = $this->estado->getEstado();

			/**
			 * Obtenemos la lista de Articulos o Equipos
			 */
			$this->view->listaEquipos = $this->articulo->getArticulos();



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
			if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'admin' || $_SESSION['tipo'] == 'encargado')) {
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
								$this->articulo->crearArticulo( $post["descripcion"], $post["departamento"], 
									$post["estado-articulo"], $post["tipo-articulo"]);

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
			if(isset($post["tipo-articulo"]) && isset($post["descripcion"]) && 
				isset($post["estado-articulo"]) && isset($post["departamento"])){
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
		 * Función que recarga la pagina
		 */
		public function redireccion(){
			header('Location: '.$this->config->get('baseUrl').'/equipos');
		}
	}
?>