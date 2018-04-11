<?php

namespace App;

class Contact extends Model
{
//	protected static $connection = null;
	protected static $table = 'contacts';
	protected static $columns = [
		'name',
		'birthday',
		'fax',
	];
//	protected static $primaryKey = 'id';
}
