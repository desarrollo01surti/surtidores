<?php

class Conexion
{

	static public function conectar()
	{

		$link = new PDO(
			"mysql:host=161.132.174.23;dbname=surtidoresnew",
			"root",
			"dev2379@SAC",
			array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			)
		);

		return $link;
	}

	static public function conectarSurti()
	{

		$link = new PDO(
			"mysql:host=192.168.2.11;dbname=surtidores",
			"adminsurti21",
			"cat2admin21",
			array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			)
		);

		return $link;
	}
}
