<?php  
/**
 * tareasController.php
 *
 * @author Arturo Adonay Rayas Vergara <arturorayas60@gmail.com>
 */

 	/** *//**
 	 * Clase tareasController
 	 */
	class tareasController extends AppController
	{
		/** *//**
		 * Funcion contructora
		 * @return type
		 */
		public function __construct()
		{
			parent::__construct();
		}

		/** *//**
		 * funcion que envia al index
		 * @return type
		 */
		public function index()
		{
			$tareas = $this->loadModel("tarea");
			$categorias = $this->loadModel("categoria");
			$this->_view->tareas=$tareas->getTareas();
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}

		/** *//**
		 * funcion que agrega una tarea
		 * @return type
		 */
		public function agregar()
		{
			if($_POST)
			{
				$tareas = $this->loadModel("tarea");
				$this->_view->tareas = $tareas->agregar($_POST);
				$this->redirect(array("controller"=>"tareas"));
			}
			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Agregar Tarea";
			$this->_view->renderizar("agregar");
		}

		/** *//**
		 * Funcion que edita una tarea con el id que reciba
		 * @param null $id 
		 * @return type
		 */
		public function editar($id=null)
		{
			if($_POST)
			{
				$tareas = $this->loadModel("tarea");
				$tareas->actualizar($_POST);
				$this->redirect(array("controller"=>"tareas"));
			}
			$tareas = $this->loadModel("tarea");
			$this->_view->tarea = $tareas->buscarPorId($id);

			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();

			$this->_view->titulo="Editar Tarea";
			$this->_view->renderizar("editar");
		}
		
		/** *//**
		 * Elimina la tarea con el index que se envie
		 * @param null $id 
		 * @return type
		 */
		public function eliminar($id)
		{
			$tarea = $this->loadModel("tarea");
			$registro = $tarea->buscarPorId($id);
			if(!empty($registro))
			{
				$tarea->eliminar($id);
				$this->redirect(array("controller"=>"tareas"));
			}			
		}

		/** *//**
		 * Cambia el estado de la tarea con el id que se le envie
		 * @param null $id 
		 * @param null $status 
		 * @return type
		 */	
		public function cambiarEstado($id=null,$status=null)
		{
			$tarea = $this->loadModel("tarea");
			$registro = $tarea->buscarPorId($id);
			if(!empty($registro))
			{
				if($status==0)
				{
					$status=1;
				}
				else
				{
					$status=0;
				}
				$tarea->actualizarEstatus($id,$status);
				$this->redirect(array("controller"=>"tareas"));
			}	
		}
	}
?>