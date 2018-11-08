<?php 
/**
 * categoriaModel.php
 *
 * @author Arturo Adonay Rayas Vergara <arturorayas60@gmail.com>
 */

	/** *//**
	 * clase CategoriaModel
	 */
	class CategoriaModel extends AppModel
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
		 * funcion getCategorias obtiene las categorias
		 * @return type
		 */
		public function getCategorias()
		{
			$tareas = $this->_db->query("SELECT * FROM categorias");
			return $tareas->fetchall();			
		}

		/** *//**
		 * funcion find encuentra la categoria del id que sea enviado
		 * @param null $id 
		 * @return type
		 */
		public function find($id)
		{
			$query = $this->_db->prepare("SELECT * FROM categorias WHERE id=:id");
			$query->bindParam(":id",$id);
			$query->execute();
			$category = $query->fetch();

			if($category)
			{
				return $category;
			}
			else
			{
				return false;
			}
		}

		/** *//**
		 * funcion add agrega una nueva categoria que sea enviada por un arreglo
		 * @param null|array $data 
		 * @return type
		 */
		public function add($data = array())
		{
			$query = $this->_db->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");

			$query->bindParam(":nombre",$data["nombre"]);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/** *//**
		 * funcion update actualiza la categoria del arreglo que se le envie 
		 * @param null|array $data 
		 * @return type
		 */
		public function update($data = array())
		{
			$query = $this->_db->prepare(
				"UPDATE categorias SET nombre=:nombre WHERE id=:id"				
			);

			$query->bindParam(":id",$data["id"]);
			$query->bindParam(":nombre",$data["nombre"]);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/** *//**
		 * funcion para eliminar una categoria
		 * @param null $id 
		 * @return type
		 */
		public function delete($id)
		{
			$query = $this->_db->prepare("DELETE FROM categorias WHERE id=:id");
			echo $id;
			$query->bindParam(":id",$id);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>