<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once 'lib/bd.php';
require_once 'lib/config.php';
require_once  'lib/MyPdo.php';
start();
