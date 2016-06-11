<?php  
	/**
	 * Modelo de la tabla Tipo_Articulo segun modelo trello
	 * Estructura de la base de datos
	 *		id_tipoArticulo	 			INT
	 *		descripcion_tipoArticulo 	VARCHAR(45)
	 */
	Class TipoArticulo{
		private $db;

		/**
		 * Constructor de la clase
		 */
		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función que crea nuevo tipo de articulo, supondre que los id se crean auto
		 */
		public function crearTipoArticulo($desTipoArticulo){
			$this->db->query("INSERT INTO Tipo_Articulo (descripcion_tipoArticulo) 
				VALUES (:desTipoArticulo)");

			/**
			 * Se unen los valores asignados a la query y se limpian
			 */
			$this->db->bind(':desTipoArticulo', $desTipoArticulo);


			/**
			 * Se ejecuta la query preparada
			 */
			$this->db->execute();
		}

		/**
		 * Función que obtiene todos los tipos de articulos
		 */
		public function getTipoArticulo(){
			$this->db->query("SELECT * FROM Tipo_Articulo");

			/**
			 * Retorna todos los tipos con resultSet()
			 */
			return $this->db->resultSet();
		}

		/**
		 * Función que actualiza los datos de los tipos por id
		 */
		public function updateTipoArticulo($id, $desTipoArticulo){
			$this->db->query("UPDATE Tipo_Articulo SET descripcion_tipoArticulo=:desTipoArticulo
				WHERE id_tipoArticulo=:id");

			$this->db->bind(':desTipoArticulo', $desTipoArticulo);
			$this->db->bind(':id', $id);

			$this->db->execute();
		}
		/**
		 * Función que elimina un tipo 
		 */
		public function deleteTipoArticulo($id){
			$this->db->query("DELETE FROM Tipo_Articulo WHERE id_tipoArticulo=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}
?>