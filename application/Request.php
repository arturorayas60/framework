<?php 
/**
 * Request.php
 *
 * @author Arturo Adonay Rayas Vergara <arturorayas60@gmail.com>
 */

/** *//**
 * Clase Request
 */
	class Request
	{
		/** *//**
		 * @var $_controlador almacena los controladores
		 */
		private $_controlador;
		/** *//**
		 * @var $_metodo almacena los metodos
		 */
		private $_metodo;
		/** *//**
		 * @var $_argumentos almacena los argumentos
		 */
		private $_argumentos;

		/** *//**
		 * Funcion contructora
		 * @return type
		 */
		public function __construct()
		{			
			if(isset($_GET['url']))
			{
				$url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
				$url = explode("/", $url);
				$url = array_filter($url);

				$this->_controlador=strtolower(array_shift($url));
				$this->_metodo=strtolower(array_shift($url));
				$this->_argumentos = $url;

				if(!$this->_controlador)
				{
					$this->_controlador = DEFAULT_CONTROLLER;
				}

				if(!$this->_metodo)
				{
					$this->_metodo = "index";
				}

				if(!$this->_argumentos)
				{
					$this->_argumentos = array();
				}
			}
		}

		/** *//**
		 * funcion getController trae los controladores
		 * @return type
		 */
		public function getController()
		{			
			return $this->_controlador;
		}

		/** *//**
		 * Funcion getMethod consige los metodos
		 * @return type
		 */
		public function getMethod()
		{
			return $this->_metodo;
		}

		/** *//**
		 * Funcion getArgs consige los argumentos
		 * @return type
		 */
		public function getArgs()
		{
			return $this->_argumentos;
		}
	}
?>