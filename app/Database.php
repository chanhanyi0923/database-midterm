<?php

namespace App;

class Database
{
	private static $connection;

	public static function getConnection()
	{
		return static::$connection;
	}

	public static function connect()
	{
		if (static::$connection == null) {
			try {
				$db_info = include ROOT_DIR.'/config/database.php';
				static::$connection = new \PDO(
					'mysql:host='.$db_info['hostname'].';dbname='.$db_info['database'],
					$db_info['username'],
					$db_info['password'],
					[\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
				);
				//
				static::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				static::$connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

			} catch (PDOException $e) {
				echo $e->getMessage();
				\App\Error::abort();
			}
		}
	}
}
