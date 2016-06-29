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

		public function crearArticulo($descripcion, $depto, $estado, $tipo){
			$this->db->query("INSERT INTO Articulo (descripcion_articulo, depto, estado, tipoArticulo) 
				VALUES (:descripcion, :depto, :estado, :tipo)");

			$this->db->bind(':descripcion', $descripcion);
			$this->db->bind(':depto', $depto);
			$this->db->bind(':estado', $estado);
			$this->db->bind(':tipo', $tipo);

			$this->db->execute();
		}

		/**
		 * Función que cuenta todos los artículos por el departamento
		 */
		public function contarArticulosDepartamentoId($depto){
			$this->db->query("SELECT * FROM Articulo WHERE depto=:depto");

			$this->db->bind(':depto', $depto);

			return $this->db->rowCount();
		}

		/**
		 * Función que cuenta todos los artículos por el departamento
		 */
		public function gertArticuloDepartamento($depto){
			$this->db->query("SELECT * FROM Articulo WHERE depto=:depto");

			$this->db->bind(':depto', $depto);

			return $this->db->resultSet();
		}

		/**
		 * Función que obtiene todos los articulos segun estado
		 */
		public function getArticuloEstado($estado){
			$this->db->query("SELECT * FROM Articulo WHERE estado=:estado");

			$this->db->bind(':estado', $estado);

			/**
			 * Retorna todos los estados con resultSet()
			 */
			return $this->db->resultSet();
		}

		/**
		 * Función que obtiene todos los articulos segun tipo
		 */
		public function getArticuloTipo($tipo){
			$this->db->query("SELECT * FROM Articulo WHERE tipoArticulo=:tipoArticulo");

			$this->db->bind(':estado', $tipo);
			/**
			 * Retorna todos los estados con resultSet()
			 */
			return $this->db->resultSet();
		}

		/**
		 * Función que devuelve todos los Articulos
		 */
		public function getArticulos(){
			$this->db->query("SELECT * FROM Articulo");

			return $this->db->resultSet();
		}

		/**
		 * Función que actualiza los datos del articulo por id
		 */
		public function updateArticulo($id, $desArticulo, $depto, $estado, $tipoArticulo){
			$this->db->query("UPDATE Articulo SET descripcion_articulo=:desArticulo,
			depto=:depto, estado=:estado, tipoArticulo=:tipoArticulo WHERE id_articulo=:id");

			$this->db->bind(':desArticulo', $desArticulo);
			$this->db->bind(':depto', $depto);
			$this->db->bind(':estado', $estado);
			$this->db->bind(':tipoArticulo', $tipoArticulo);
			$this->db->bind(':id', $id);

			$this->db->execute();
		}

		/**
		 * Función que elimina un articulo
		 */
		public function deleteArticulo($id){
			$this->db->query("DELETE FROM Articulo WHERE id_articulo=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}
 ?>