<?php  
	/**
 * categoriasController.php
 *
 * @author Arturo Adonay Rayas Vergara <arturorayas60@gmail.com>
 */

	/** *//**
	 * Clase categoriasController
	 */	
	class categoriasController extends AppController
	{
		/** *//**
		 * funcion constructora
		 * @return type
		 */
		public function __construct()
		{
			parent::__construct();
		}

		/** *//**
		 * funcion index se envia al index
		 * @return type
		 */
		public function index()
		{
			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}

		/** *//**
		 * funcion agregar agrega una categoria
		 * @return type
		 */
		public function agregar()
		{
			if($_POST)
			{
				$categoria = $this->loadModel("categoria");
				$categoria->add($_POST);
				$this->redirect(array("controller"=>"categorias"));
			}
			$this->_view->titulo="Nueva Tarea";
			$this->_view->renderizar("agregar");
		}

		/** *//**
		 * funcion edita edita una categoria con el id que se envia
		 * @param $id 
		 * @return type
		 */
		public function editar($id=null)
		{
			if($_POST)
			{
				$categoria = $this->loadModel("categoria");
				$categoria->update($_POST);
				$this->redirect(array("controller"=>"categorias"));
			}
			$categoria = $this->loadModel("categoria");
			$this->_view->categoria=$categoria->find($id);
			$this->_view->titulo="Editar Tarea";
			$this->_view->renderizar("editar");
		}

		/** *//**
		 * funcion eliminar elimina una categoria con el id que se envia
		 * @param $id 
		 * @return type
		 */
		public function eliminar($id = null)
		{
			$categoria = $this->loadModel("categoria");
			$item = $categoria->find($id);
			print_r($item);
			if($item)
			{
				$categoria->delete($id);
				$this->redirect(array("controller"=>"categorias"));
			}
		}
	}
?>