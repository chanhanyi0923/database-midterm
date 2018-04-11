<?php

define('ROOT_DIR', __DIR__);

require_once ROOT_DIR.'/app/Database.php';
require_once ROOT_DIR.'/app/Error.php';
require_once ROOT_DIR.'/app/Model.php';
require_once ROOT_DIR.'/app/Contact.php';

require_once ROOT_DIR.'/app/FilterRecord.php';

//use \App\Contact;
use \App\FilterRecord;


/*
$contacts = Contact::all();
var_dump($contacts);
*/
/*
$contact = Contact::find(5);

//echo var_dump($contact);

//echo 123;

$contact->name = 'name55555';
Contact::update($contact);
*/
/*
$contacts = Contact::where('id < ?', [5]);
var_dump($contacts);
*/
