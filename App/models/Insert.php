<?php

namespace App\models;

use App\lib\Db;

class Insert
{
    private $table = 'users';

    public function register($userName, $email, $password)
    {
        $db = new Db();
        $mdpassword = md5($password);
        $res1 = $db->query("INSERT INTO `chat`.`" . $this->table . "` (`username`, `email`, `password`)
                          VALUES ('$userName', '$email', '$mdpassword')");

        $stmt = $db->query("SELECT LAST_INSERT_ID()");
        $user_id = $stmt->fetchColumn();
        $_SESSION["id"] = $user_id;

        if ($user_id!="0") {
            echo json_encode([
                'success' => true
            ]);
        } else {
           echo json_encode([
                'errorMessage' => "Email already exists",
                'success' => false
            ]);}

    }

    public function login($email)
    {

        $db1 = new Db();
        $data = $db1->row("SELECT id, username, email,password FROM `chat`.`users` WHERE email='" . $email . "'");
        return $data;
    }

    public function message($message, $us)
    {
        $user_id = $_SESSION["id"];
        $db = new Db();
        $db->query("INSERT INTO `chat_text`( `text`, `users_id`)
                                       VALUES ('$us : $message',  '$user_id')");
        $stmt = $db->query("SELECT LAST_INSERT_ID()");
        $usr_id = $stmt->fetchColumn();
        $mess = $db->row("SELECT `text`  FROM `chat`.`chat_text` where id = $usr_id");


        echo json_encode($mess);

    }

    public function selMess()
    {
        $user_id = $_SESSION["id"];
        $sdb = new Db();
        $mess = $sdb->row("SELECT `text`  FROM `chat`.`chat_text` ");
        $user = $sdb->row("SELECT `id`,`username`  FROM $this->table ");
        $arr = array();
        $arr = [$mess, $user];
        return $arr;


    }

    public function message1($persmessage,$us_id, $us)
    {

//        $user_id = $_SESSION["id"];

        $db = new Db();
        $db->query("INSERT INTO `chat`.`pers_chat_text`( `pers_text`, `users_id`)
                                       VALUES ('$us : $persmessage',  '$us_id')");
        $stmt = $db->query("SELECT LAST_INSERT_ID()");
        $last_id = $stmt->fetchColumn();
        $mess1 = $db->row("SELECT `pers_text`  FROM `chat`.`pers_chat_text` WHERE users_id = $us_id AND id = $last_id");
        return $mess1;

    }
    public function selMessage1($us_id)
    {

        $db = new Db();
        $m = $db->row("SELECT `pers_text`  FROM `chat`.`pers_chat_text` WHERE users_id = $us_id");

       return $m;

    }


}









