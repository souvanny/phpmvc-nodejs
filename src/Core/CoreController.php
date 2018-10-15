<?php
/**
 * Created by PhpStorm.
 * User: ssise
 * Date: 14/10/2018
 * Time: 01:09
 */

namespace IAD;

use Twig_Environment;
use Twig_Loader_Array;

class CoreController
{

    protected $authenticationRequired = false;
    protected $controller = 'index';
    protected $action = 'index';
    protected $config = [];

    public function __construct()
    {
//        echo "CoreController construct ...\n";

    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function getConfigValue($key)
    {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        return null;
    }

    public function initDb()
    {
        DbConnect::getInstance()->init($this->getConfigValue('db'));
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function renderView($viewBag = [])
    {
        $path = __DIR__ . '/../View/layout.html.twig';
        $tplLayout = file_get_contents($path);

        $path = __DIR__ . '/../View/layout_connected.html.twig';
        $tplLayoutConnected = file_get_contents($path);

        $path = __DIR__ . '/../View/' . $this->controller . '/' . $this->action . '.html.twig';
        $tpl = file_get_contents($path);

        $loader = new Twig_Loader_Array(array(
            'index' => $tpl,
            'layout.html' => $tplLayout,
            'layout_connected.html' => $tplLayoutConnected,
        ));
        $twig = new Twig_Environment($loader);

        return $twig->render('index', $viewBag);
    }

    public function renderJson($value)
    {
        return json_encode($value);
    }

    public function setAuthenticationRequired($authenticationRequired)
    {
        $this->authenticationRequired = $authenticationRequired;
        $this->checkAuthentication();
        $this->checkAuthorization();
    }

    protected function checkAuthentication()
    {
        if ($this->authenticationRequired && !isset($_SESSION["user"])) {
            header('location: /login');
        }
    }

    protected function checkAuthorization()
    {

    }

}