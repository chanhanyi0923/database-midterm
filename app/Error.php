<?php

namespace App;

class Error
{
	public static function abort()
	{
		echo PHP_EOL.'Error'.PHP_EOL;
		exit(1);
	}
};