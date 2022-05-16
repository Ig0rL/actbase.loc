<?php
// develop or production
define("DEBUG", 1);
// main dir
define("ROOT", dirname(__DIR__));
// public dir
define("WWW", ROOT . '/public');
// app dir
define("APP", ROOT . '/app');
// core dir
define("CORE", ROOT . '/vendor/cube/core');
// libs dir
define("LIBS", ROOT . '/vendor/cube/core/libs');
// tmp dir
define("CACHE", ROOT . '/tmp/cache');
// config dir
define("CONF", ROOT . '/config');
// default name site directory
define("LAYOUT", 'default');
define("DEF", '/Default/');
// Db name
define("DB", 'actbase');
// get url with protocol
$app_path = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
// cut the script name
$app_path = preg_replace("#[^/]+$#", "", $app_path);
// get url main page
$app_path = str_replace('/public/', '', $app_path);
// const main page
define("PATH", $app_path);
// const admin
define("ADMIN", PATH . '/admin');
// include file autoload classes
require_once ROOT . '/vendor/autoload.php';

