<?php  
	/**
	 * Modelo de la tabla Estado
	 * Estructura de la base de datos
	 *		id_estado	 			INT
	 *		descripcion_estado 		VARCHAR(45)
	 *		utilizable 				BOOLEAN
	 */
	Class Estado{
		private $db;

		/**
		 * Constructor de la clase
		 */
		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función que crea nuevo estado
		 */
		public function crearEstado($desEstado, $utilizable){
			$this->db->query("INSERT INTO Estado (descripcion_estado, 
				utilizable) VALUES (:desEstado, :utilizable)");

			/**
			 * Se unen los valores asignados a la query y se limpian
			 */
			$this->db->bind(':desEstado', $desEstado);
			$this->db->bind(':utilizable', $utilizable);

			/**
			 * Se ejecuta la query preparada
			 */
			$this->db->execute();
		}

		/**
		 * Función que obtiene todos los estados
		 */
		public function getEstado(){
			$this->db->query("SELECT * FROM Estado");

			/**
			 * Retorna todos los estados con resultSet()
			 */
			return $this->db->resultSet();
		}

		/**
		 * Función que actualiza los datos del estado por id
		 */
		public function updateEstado($id, $desEstado, $utilizable){
			$this->db->query("UPDATE Estado SET descripcion_estado=:desEstado,
			utilizable=:utilizable WHERE id_estado=:id");

			$this->db->bind(':desEstado', $desEstado);
			$this->db->bind(':utilizable', $utilizable);
			$this->db->bind(':id', $id);

			$this->db->execute();
		}
		/**
		 * Función que elimina un estado
		 */
		public function deleteEstado($id){
			$this->db->query("DELETE FROM Estado WHERE id_estado=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}
?>