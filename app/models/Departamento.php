<?php 
	/**
	 * Modelo de la Tabla departamento
	 * Estructura de la tabla:
	 *		id_depto		INT
	 *		nombre_depto	VARCHAR(45)
	 */
	Class Departamento{
		private $db;

		/**
		 * Constructor de la Clase
		 */
		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función para crear un departamento
		 */
		public function crearDepartamento($nombre){
			$this->db->query("INSERT INTO Departamento (nombre_depto)
				VALUES (:nombre)");

			$this->db->bind(':nombre', $nombre);

			$this->db->execute();
		}

		/**
		 * Función para obtener un departamento por ID
		 */
		public function getDepartamentoId($id){
			$this->db->query("SELECT * FROM Departamento WHERE id_depto=:id");

			$this->db->bind(':id', $id);

			return $this->db->single();
		}

		/**
		 * Función que obtiene todos los departamentos
		 */
		public function getDepartamentos(){
			$this->db->query("SELECT * FROM Departamento");

			return $this->db->resultSet();
		}

		/**
		 * Función que edita un departamento
		 */
		public function updateDepartamento($id, $nombre){
			$this->db->query("UPDATE Departamento SET nombre_depto=:nombre WHERE id_depto=:id");

			$this->db->bind(':id', $id);
			$this->db->bind(':nombre', $nombre);

			$this->db->execute();
		}

		/**
		 * Función que elimina un departamento por su ID
		 */
		public function delDepartamentoId($id){
			$this->db->query("DELETE FROM Departamento WHERE id_depto=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}


	}
 ?>