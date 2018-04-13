<?php

namespace Controller;

use \Interop\Container\ContainerInterface;
use \Slim\Http\Request;
use \Slim\Http\Response;

class BaseController
{
	public function __construct(ContainerInterface $ci)
	{
        $this->ci = $ci;
    }
}