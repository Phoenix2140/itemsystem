<?php 
	class Salir{
		private $config;

		public function __construct($config){
			$this->config = $config;
		}

		public function salir(){
			session_destroy();
			header('Location: '.$this->config->get('baseUrl'));
		}
	}
 ?>