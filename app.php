<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

require './vendor/autoload.php';

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($url, PHP_URL_PATH);

$a = explode('/', $path);

$controller = !empty($a[1]) ? $a[1] : 'index';
$action = isset($a[2]) && !empty($a[2]) ? $a[2] : 'index';

$controllerPath = 'src/Controller/'.ucfirst($controller).'Controller.php';

if(!file_exists($controllerPath)) {
    throw(new \Exception('Erreur, fichier controller introuvable'));
}

$controllerClass = "Controller\\".ucfirst($controller).'Controller';

if(!class_exists($controllerClass)) {
    throw(new \Exception("Erreur, fichier controller trouvé mais la classe $controllerClass introuvable"));
}

$methodName = $action.'Action';

if(!method_exists($controllerClass, $methodName)) {
    throw(new \Exception("Erreur, méthode $methodName introuvable"));
}

$configInstance = new \IAD\Config();
$config = $configInstance->getValues();

$authenticationRequired = !isset($config['publicRoute']["$controller/$action"]);

$instance = new $controllerClass();
$instance->setAuthenticationRequired($authenticationRequired);
$instance->setController($controller);
$instance->setAction($action);
$instance->setConfig($config);
$instance->initDb();

echo $instance->{$methodName}();



