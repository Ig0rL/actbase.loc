<?php
// include conf file 'init'
require_once dirname(__DIR__) . '/config/init.php';
// include file func.php
require_once LIBS . '/func.php';
require_once CONF . '/routes.php';
// create instance class App
new \cube\App();