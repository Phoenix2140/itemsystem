<?php  
	/**
	 * Modelo de la tabla Usuario
	 * Estructura de la base de datos
	 *		id_usuario 		INT
	 *		tipoUsuario 	VARCHAR(45)
	 *		nombreUsuario	VARCHAR(45)
	 * 		contraseña		VARCHAR(45)
	 */
	Class Usuario{
		private $db;

		/**
		 * Constructor de la clase
		 */
		public function __construct($config){
			$this->db = new Database($config);
		}

		/**
		 * Función que crea nuevo usuario
		 */
		public function crearUsuario($tipo, $nombre, $pass){
			$this->db->query("INSERT INTO Ususario (tipoUsuario, 
				nombreUsuario, contraseña) VALUES (:tipo, :nombre, :pass)");

			/**
			 * Se unen los valores asignados a la query y se limpian
			 */
			$this->db->bind(':tipo', $tipo);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':pass', $pass);

			/**
			 * Se ejecuta la query preparada
			 */
			$this->db->execute();
		}

		/**
		 * Función que obtiene todos los usuarios
		 */
		public function getUsuarios(){
			$this->db->query("SELECT * FROM Ususario");

			/**
			 * Retorna todos los usuarios con resultSet()
			 */
			return $this->db->resultSet();
		}

		/**
		 * función que obtiene el usuario por su nombre y contraseña
		 */
		public function getUsuarioLogin($nombre, $pass){
			$this->db->query("SELECT * FROM Ususario 
				WHERE nombreUsuario=:nombre AND pass=:pass");

			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':pass', $pass);

			/**
			 * Retorna solo una fila
			 */
			return $this->db->single();
		}

		/**
		 * Función que actualiza los datos del Usuario
		 */
		public function updateUsuario($id, $tipo, $nombre, $pass){
			$this->db->query("UPDATE Ususario SET tipoUsuario=:tipo,
			nombreUsuario=:nombre, contraseña=:pass WHERE id_usuario=:id");

			$this->db->bind(':tipo', $tipo);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':pass', $pass);
			$this->db->bind(':id', $id);

			$this->db->execute();
		}

		/**
		 * Función que elimina un usuario
		 */
		public function deleteUsuario($id){
			$this->db->query("DELETE FROM Ususario WHERE id_usuario=:id");

			$this->db->bind(':id', $id);

			$this->db->execute();
		}
	}
?>