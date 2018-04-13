<?php

class Database
{
	private $connection;
	private $db_info;

	public function __construct($setting)
	{
		$this->db_info = $setting;
	}

	public function getConnection()
	{
		if ($this->connection == null) {
			$this->connect();
		}
		return $this->connection;
	}

	public function connect()
	{
		$this->connection = new \PDO(
			'mysql:host='.$this->db_info['hostname'].';dbname='.$this->db_info['database'],
			$this->db_info['username'],
			$this->db_info['password'],
			[\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
		);
		$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
	}
}
