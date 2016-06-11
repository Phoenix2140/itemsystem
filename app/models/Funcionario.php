<?php  
	/**
	 * Modelo de la tabla Funcionario
	 * Estructura de la base de datos
	 *		id_funcionario 	INT
	 *		nombre 			VARCHAR(45)
	 *		rut 			VARCHAR(10)
	 * 		depto			INT
	 */
	Class Funcionario{
		private $db;

		/**
		 * Constructor de la clase
		 */
		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función que crea nuevo funcionario
		 */
		public function crearFuncionario($nombre, $rut, $depto){
			$this->db->query("INSERT INTO Funcionarios (nombre, 
				rut, depto) VALUES (:nombre, :rut, :depto)");

			/**
			 * Se unen los valores asignados a la query y se limpian
			 */
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':rut', $rut);
			$this->db->bind(':depto', $depto);

			/**
			 * Se ejecuta la query preparada
			 */
			$this->db->execute();
		}

		/**
		 * Función que obtiene todos los funcionarios
		 */
		public function getFuncionario(){
			$this->db->query("SELECT * FROM Funcionarios");

			/**
			 * Retorna todos los funcionarios con resultSet()
			 */
			return $this->db->resultSet();
		}

		/**
		 * Función que actualiza los datos del funcionario por id
		 */
		public function updateFuncionario($id, $nombre, $rut, $depto){
			$this->db->query("UPDATE Funcionarios SET nombre=:nombre,
			rut=:rut, depto=:depto WHERE id_funcionario=:id");

			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':rut', $rut);
			$this->db->bind(':depto', $depto);
			$this->db->bind(':id', $id);

			$this->db->execute();
		}
		/**
		 * Función que elimina un funcionario
		 */
		public function deleteUsuario($id){
			$this->db->query("DELETE FROM Funcionarios WHERE id_funcionario=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}
?>