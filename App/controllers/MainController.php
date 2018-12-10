<?php

namespace App\controllers;

use App\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		$result = $this->model->getNews();
		$vars = [

			'news' => $result,

		];
		$this->view->render('Home', $vars);
	}


    public function select($data, $condition = '') {
        $selectResult = $this->db->exSelect($this->table, $data, $condition);
        return $selectResult;
    }

}