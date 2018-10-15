<?php
/**
 * Created by PhpStorm.
 * User: ssise
 * Date: 14/10/2018
 * Time: 18:00
 */

namespace IAD;


class Authentication
{
    public function __construct()
    {
    }

    function check($email, $password, $secretKey)
    {
        $encodedPassword = $this->encodePassword($password);

        $sql = "select id_user as idUser, email, password FROM users WHERE email=?";
        $rows =  DbConnect::getInstance()->fetchAll($sql, [$email]);

        if (1 === count($rows)) {
            $row  = $rows[0];
            if ($row['password'] == $encodedPassword) {
                $idUser = $row['id_user'];
                $_SESSION['user'] = [
                    'email' => $email,
                    'idUser' => $row['idUser'],
                    'token' => md5($idUser.$secretKey),
                ];
                return true;
            } else {
                return false;
            }
        } else {
            $sql = 'INSERT INTO users (email, password) VALUES (?, ?)';
            DbConnect::getInstance()->query($sql, [$email, $encodedPassword]);
            $idUser = DbConnect::getInstance()->getConnection()->lastInsertId();
            $_SESSION['user'] = [
                'email' => $email,
                'idUser' => $idUser,
                'token' => md5($idUser.$secretKey),
            ];
            return true;
        }
        return false;
    }

    protected function encodePassword($password)
    {
//        return password_hash($password, PASSWORD_DEFAULT);
        return md5($password);
    }

}