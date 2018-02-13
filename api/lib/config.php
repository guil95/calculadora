<?php
session_name('small');
session_start();
date_default_timezone_set('America/Sao_Paulo');
header('Access-Control-Allow-Origin: *');
function start() {
    $controller = 'Index';
    $action = 'index';
    $params = array();

    $uri = $_SERVER['REQUEST_URI'];
    $request = explode('/', ltrim($uri, '/'));
    if (isset($request[0])) {
        if ($request[0] !== '') {
            $controller = ucfirst($request[0]);
        }
    }

    if (isset($request[1])) {
        if ($request[1] !== '') {
            $action = lcfirst($request[1]);
        }
    }

    if (isset($request[2])) {
        if ($request[2] !== '') {
            $get = explode('&', $request[2]);

            for ($i = 0; $i < count($get); $i++) {
                $param = explode("=", $get[$i]);
                $params[$param[0]] = $param[1];
            }
        }
    }

    $filename = 'controllers/' . $controller . '.php';
    if (!file_exists($filename)) {
        die("Controller não encontrado - $controller");
    }

    require_once $filename;
    $instance = new $controller($params);

    if (!method_exists($instance, $action)) {
        die("Action não encontrada - {$controller}->{$action}");
    }

    $instance->$action();
}

function my_autoload($pClassName) {
    $class = explode("_", $pClassName);
    switch ($class[0]) {
        case "Model":
            unset($class[0]);
            $class = join(DIRECTORY_SEPARATOR, $class);
            require_once("models" . DIRECTORY_SEPARATOR . $class . ".php");
            break;
        default:
            require_once("controllers/" . ucfirst($pClassName) . ".php");
            break;
    }
}

spl_autoload_register("my_autoload");

function getPost($name, $default = '') {
    return (isset($_POST[$name])) ? trim($_POST[$name]) : $default;
}
