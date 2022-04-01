<?php

require_once "conexion.php";


class ModeloRoles
{

	/*=============================================
	MOSTRAR TODOS LOS ROLES PARA TABLA
	=============================================*/

	static public function mdlMostrarRolesTabla($item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT r.id_rol, r.nombre_rol, e.nombre, r.estado, r.fecha FROM tu_roles r INNER JOIN tu_usuario u ON r.id_usuario = u.idusuario INNER JOIN tu_empleado e ON u.idempleado = e.idempleado WHERE r.id_rol = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT r.id_rol, r.nombre_rol, e.nombre, r.estado, r.fecha FROM tu_roles r INNER JOIN tu_usuario u ON r.id_usuario = u.idusuario INNER JOIN tu_empleado e ON u.idempleado = e.idempleado ORDER BY r.id_rol DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR DATOS DE ROLES
	=============================================*/
	static public function mdlMostrarRolTickets($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR DATOS DE ROLES ASIGNADOS (TICKETS)
	=============================================*/
	static public function mdlMostrarRolesAsignado($idrol, $iduser)
	{
		if ($idrol != null) {

			$stmt = Conexion::conectar()->prepare("SELECT ru.id_rolusuario, u.idusuario, ru.id_rol, ro.nombre_rol, e.nombre
												FROM tu_roles_usuario ru 
												INNER JOIN tu_usuario u ON ru.id_usuario = u.idusuario
												INNER JOIN tu_roles ro ON ru.id_rol = ro.id_rol
												INNER JOIN tu_empleado e ON u.idempleado = e.idempleado
												WHERE ru.id_rol = $idrol and ru.id_usuario = $iduser");

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT ru.id_rolusuario, u.idusuario, ru.id_rol, ro.nombre_rol, e.nombre
												FROM `tu_roles_usuario` ru 
												INNER JOIN tu_usuario u ON ru.id_usuario = u.idusuario
												INNER JOIN tu_roles ro ON ru.id_rol = ro.id_rol
												INNER JOIN tu_empleado e ON u.idempleado = e.idempleado");

			$stmt->execute();

			return $stmt->fetchAll();
		}
		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	CREAR ROL
	=============================================*/

	static public function mdlIngresarRol($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_rol, estado, fecha) VALUES (:nombre_rol, :estado, :fecha)");

		$stmt->bindParam(":nombre_rol", $datos["nombre_rol"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	CREAR ROL
	=============================================*/

	static public function mdlAsignarRolUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, id_rol) VALUES (:id_usuario, :id_rol)");

		$stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizarRol($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlBorrarRolAsignado($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_rolusuario = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
