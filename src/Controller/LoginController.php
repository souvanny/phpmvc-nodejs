<?php
/**
 * Created by PhpStorm.
 * User: ssise
 * Date: 14/10/2018
 * Time: 00:14
 */

namespace Controller;

use IAD\Authentication;
use IAD\CoreController;

class LoginController extends CoreController
{

    function indexAction()
    {
        return $this->renderView();
    }

    function checkAction()
    {
        $authentication = new Authentication();
        $b = $authentication->check($_REQUEST['email'], $_REQUEST['password'], $this->getConfigValue('secretKey'));
        if(!$b) {
            header('location: /login');
        } else {
            header('location: /chat');
        }
        exit;
    }

}