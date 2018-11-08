<?php  
/**
 * Controller.php
 *
 * @author Arturo Adonay Rayas Vergara <arturorayas60@gmail.com>
 */

	/** *//**
	 * Clase AppController
	 */	
	abstract class AppController
	{
		/**
		 * $_view
		 */
		protected $_view;	

		/** *//**
		 * funcion constructora
		 * @return type
		 */
		public function __construct()
		{
			$this->_view = new View(new Request);
		}

		/** *//**
		 * funcion index
		 * @return type
		 */
		abstract function index();		

		/** *//**
		 * Función loadModel se encarga de cargar los modelos
		 * @param $modelo 
		 * @return type
		 */
		protected function loadModel($modelo)
		{
			$modelo = $modelo."Model";
			$rutaModelo = ROOT."models".DS.$modelo.".php";

			if(is_readable($rutaModelo))
			{
				require_once($rutaModelo);
				$modelo = new $modelo;
				return $modelo;
			}
			else
			{
				throw new Exception("Error al cargar el modelo");
				
			}
		}

		/** *//**
		 * Función redirect se encarga de redireccionar 
		 * @param array $url 
		 * @return type
		 */
		public function redirect($url = array())
		{
			$path = "";
			if ($url["controller"]) {
				$path .= $url["controller"];
			}

			if ($url["action"]) {
				$path .="/".$url["action"];
			}

			header("LOCATION: ".APP_URL.$path);
		}
	}
?>