<?php

define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
$dotenv->load();

use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;
$capsule = new Capsule;
$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => $_ENV['DB_HOST'],
	'database'  => $_ENV['DB_NAME'],
	'username'  => $_ENV['DB_USER'],
	'password'  => $_ENV['DB_PASS'],
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
	
]);
date_default_timezone_set("Asia/Ho_Chi_Minh");
$capsule->setAsGlobal();
$capsule->bootEloquent();
