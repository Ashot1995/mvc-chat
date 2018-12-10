<?php

namespace App\models;

use App\core\Model;

class Main extends Model {

    public function getNews() {
        $result = $this->db->row('SELECT `username`, `password` FROM users');
        return $result;
    }


//    public function exSelect($table, $data, $condition='') {
//
//        $data = implode(", ", $data);
//        $where = ' ';
//
//        $result = $this->db->query("SELECT $data FROM $table WHERE $condition");
//
//        return $result;
//    }




}