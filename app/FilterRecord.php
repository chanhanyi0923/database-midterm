<?php

namespace App;

class FilterRecord extends Model
{
	protected static $table = 'filter_records';
	protected static $columns = [
		'trade_counterpart_id',
		'name',
		'type',
		'price',
	];
}


