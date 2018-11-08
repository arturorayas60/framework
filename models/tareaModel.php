<?php  
/**
 * tareaModel.php
 *
 * @author Arturo Adonay Rayas Vergara <arturorayas60@gmail.com>
 */

	/** *//**
	 * Clase TareaModel
	 */	
	class TareaModel extends AppModel
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
		 * funcion getTareas carga las tareas
		 * @return type
		 */
		public function getTareas()
		{
			$tareas = $this->_db->query("SELECT T.*,C.nombre as Categoria FROM tareas T INNER JOIN categorias C ON C.id=T.categoria_ID");
			$rows=null;
			if(count($tareas)>0){
				foreach (range(0, $tareas->columnCount()-1) as $column_index) {
					$meta[] = $tareas->getColumnMeta($column_index);
				}

				$resultados = $tareas->fetchAll(PDO::FETCH_NUM);

				for ($i=0; $i < count($resultados); $i++) { 
					$j = 0;
					foreach ($meta as $value) {
						$rows[$i][$value["table"]][$value["name"]] = $resultados[$i][$j];
						$j++;
					}
				}		
			}
			return $rows;
		}

		/** *//**
		 * funcion agregar agrega una nueva tarea
		 * @param array $datos 
		 * @return type
		 */
		public function agregar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"INSERT INTO tareas
				(categoria_id,nombre,descripcion,fecha,prioridad,status)
				VALUES
				(:categoria_id,:nombre,:descripcion,:fecha,:prioridad,0)"
			);

			$consulta->bindParam(":categoria_id",$datos["categoria"]);
			$consulta->bindParam(":nombre",$datos["nombre"]);
			$consulta->bindParam(":descripcion",$datos["descripcion"]);
			$consulta->bindParam(":fecha",$datos["fecha"]);
			$consulta->bindParam(":prioridad",$datos["prioridad"]);			

			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/** *//**
		 * funcion actualizar actualiza los datos que se le envían 
		 * @param array $datos 
		 * @return type
		 */
		public function actualizar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"UPDATE tareas SET
				categoria_id=:categoria_id,
				nombre=:nombre,
				descripcion=:descripcion,
				fecha=:fecha,
				prioridad=:prioridad				
				WHERE id=:id"
			);

			$consulta->bindParam(":categoria_id",$datos["categoria"]);
			$consulta->bindParam(":nombre",$datos["nombre"]);
			$consulta->bindParam(":descripcion",$datos["descripcion"]);
			$consulta->bindParam(":fecha",$datos["fecha"]);
			$consulta->bindParam(":prioridad",$datos["prioridad"]);	
			$consulta->bindParam(":id",$datos["id"]);		

			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/** *//**
		 * funcion buscarPorId busca una tarea por id
		 * @param $id 
		 * @return type
		 */
		public function buscarPorId($id)
		{
			$tarea = $this->_db->prepare("SELECT * FROM tareas WHERE id=:id");
			$tarea->bindParam(":id",$id);
			$tarea->execute();
			$registro = $tarea->fetch();

			if ($registro) 
			{
				return $registro;
			}
			else
			{
				return false;
			}
		}

		/** *//**
		 * funcion eliminar elimina una tarea por el id que se le envie
		 * @param  $id 
		 * @return type
		 */
		public function eliminar($id)
		{
			$query = $this->_db->prepare("DELETE FROM tareas WHERE id=:id");
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

		/** *//**
		 * funcion actualizarestatus actualiza el estatus de una tarea 
		 * @param $id 
		 * @param $status 
		 * @return type
		 */
		public function actualizarEstatus($id,$status)
		{
			
			$query = $this->_db->prepare("UPDATE tareas SET status=:status WHERE id=:id");		

			$query->bindParam(":id",$id);
			$query->bindParam(":status",$status);
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