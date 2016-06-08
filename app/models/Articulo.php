<?php 
	/**
	 * Modelo de la tabla Articulo
	 * Estructura de la tabla:
	 *		id_articulo 			INT(3)
	 *		descripcion_articulo 	VARCHAR(45)
	 *		depto 					INT(3)
	 *		estado 					INT(3)
	 *		tipoArticulo 			INT(3)
	 */
	Class Articulo{
		private $db;

		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función que cuenta todos los artículos por el departamento
		 */
		public function contarArticulosDepartamentoId($depto){
			$this->db->query("SELECT * FROM Articulo WHERE depto=:depto");

			$this->db->bind(':depto', $depto);

			return $this->db->rowCount();
		}
	}
 ?>