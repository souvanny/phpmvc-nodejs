<?php
/**
 * Created by PhpStorm.
 * User: ssise
 * Date: 14/10/2018
 * Time: 00:14
 */

namespace Controller;

use IAD\CoreController;
use IAD\DbConnect;

class ChatController extends CoreController
{
    function indexAction()
    {
        return $this->renderView([
            'token' => md5($_SESSION['user']['idUser'].$this->getConfigValue('secretKey')),
            'baseUrl' => $this->getConfigValue('baseUrl').':'.$this->getConfigValue('nodeJsPort'),
            'myEmail' => $_SESSION['user']['email'],
        ]);
    }

    function listAction()
    {
        $type = $_REQUEST['type'] == 'room' ? 0 : 1;

        $sql = "select t1.*, t2.email as sourceEmail, t3.email as targetEmail 
                FROM messages t1 
                LEFT JOIN users t2 on t1.source=t2.id_user
                LEFT JOIN users t3 on t1.target=t3.id_user
                WHERE type=? ORDER BY id_message DESC LIMIT 50
                ";
        $rows =  DbConnect::getInstance()->fetchAll($sql, [$type]);

        return $this->renderJson($rows);
    }

    function messageAction()
    {
        $type = $_REQUEST['type'];
        $target = isset($_REQUEST['target']) ? $_REQUEST['target'] : '0';
        $message = $_REQUEST['message'];
        $token = $_REQUEST['token'];
        $this->checkMessageToken($token);

        $targetIdUser = 0;
        $sourceIdUser = $_SESSION['user']['idUser'];
        if($type == 'private') {
            $sql = "select id_user as idUser FROM users WHERE email=?";
            $rows =  DbConnect::getInstance()->fetchAll($sql, [$target]);
            if(count($rows) === 1) {
                $targetIdUser = $rows[0]['idUser'];
            } else {
                throw(new \Exception("Erreur chat 1"));
            }
        }

        $sql = 'INSERT INTO messages (type, source, target, message) VALUES (?, ?, ?, ?)';
        $params = [$type == 'room' ? 0 : 1, $sourceIdUser, $targetIdUser, $message];
        DbConnect::getInstance()->query($sql, $params);

        if($type == 'private') {
            $array = [
                'message' => $message,
                'type' => $type,
                'source' => md5($_SESSION['user']['idUser'].$this->getConfigValue('secretKey')),
                'target' => md5($targetIdUser.$this->getConfigValue('secretKey')),
                'date_created' => date("Y-m-d H:i:s"),
            ];
        } else {
            $array = [
                'message' => $message,
                'type' => $type,
                'source' => md5($_SESSION['user']['idUser'].$this->getConfigValue('secretKey')),
                'target' => '',
                'date_created' => date("Y-m-d H:i:s"),
            ];
        }

        $this->callCurl($array);

        return json_encode(['result' => true]);
    }

    protected function callCurl($array)
    {
        $host = $this->getConfigValue('baseUrl').':'.$this->getConfigValue('nodeJsPort').'/message';

        $json = json_encode($array);

        $ch = curl_init($host);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($ch, CURLOPT_PORT, 3000);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json))
        );
        curl_exec($ch);
    }

    protected function checkMessageToken($token)
    {
    }
}