<?php

namespace App;

class Model
{
	protected static $table = null;
	protected static $primaryKey = 'id';
	protected static $columns = [];
/*
	public function __construct()
	{
	}
*/

	public static function paginate($number)
	{
		//
	}

	public static function all()
	{
		Database::connect();
		$raw_sql = 'SELECT '.implode(',', static::$columns).','.static::$primaryKey.' '
				 . 'FROM '.static::$table;
		$query = Database::getConnection()->query($raw_sql);
		$result = $query->fetchAll(\PDO::FETCH_OBJ);
		return $result;
	}

	public static function find($id)
	{
		Database::connect();
		$raw_sql = 'SELECT '.implode(',', static::$columns).','.static::$primaryKey.' '
				 . 'FROM '.static::$table.' '
				 . 'WHERE '.static::$primaryKey.' = ?';

		$query = Database::getConnection()->prepare($raw_sql);
		$query->execute([$id]);
		$result = $query->fetch(\PDO::FETCH_OBJ);
		return $result;
	}

	public static function where($sql, $params)
	{
		Database::connect();
		$raw_sql = 'SELECT '.implode(',', static::$columns).','.static::$primaryKey.' '
				 . 'FROM '.static::$table.' '
				 . 'WHERE '.$sql;
		$query = Database::getConnection()->prepare($raw_sql);
		$query->execute($params);
		$result = $query->fetchAll(\PDO::FETCH_OBJ);
		return $result;
	}

	public static function insert($obj)
	{
		Database::connect();
		$db = Database::getConnection();

		$mark = [];
		for ($i = 0; $i < count(static::$columns); $i ++) {
			$mark[] = '?';
		}

		$raw_sql = 'INSERT INTO '.static::$table.' '
                 . '('.implode(',', static::$columns).') '
                 . 'VALUES ('.implode(',', $mark).')';

		$params = [];
		foreach (static::$columns as $column) {
			$params[] = $obj->{$column};
		}

		$query = $db->prepare($raw_sql);
		$query->execute($params);

		$result = $obj;
		$result->{static::$primaryKey} = $db->lastInsertId();
		return $result;
	}

	public static function update($obj)
	{
		Database::connect();

		$set_col = static::$columns;
		foreach ($set_col as &$col) {
			$col .= ' = ?';
		}

		$raw_sql = 'UPDATE '.static::$table.' '
                 . 'SET '.implode(',', $set_col).' '
                 . 'WHERE '.static::$primaryKey.' = ?';

		$params = [];
		foreach (static::$columns as $column) {
			$params[] = $obj->{$column};
		}
		$params[] = $obj->{static::$primaryKey};

		$query = Database::getConnection()->prepare($raw_sql);
		$query->execute($params);
	}

	public static function destroy($id)
	{
		Database::connect();

		$raw_sql = 'DELETE FROM '.static::$table.' '
                 . 'WHERE '.static::$primaryKey.' = ?';

		$query = Database::getConnection()->prepare($raw_sql);
		$query->execute([$id]);
	}
}
