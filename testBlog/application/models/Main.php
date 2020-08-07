<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	public $error;

	public function contactValidate($post){
		$nameLength = strlen($post['name']);
		$textLength = strlen($post['text']);

		if ($nameLength < 3 or $nameLength > 20){
			$this->error = 'Имя недопустимой длинны';
			return false;
		} elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'Неверный формат почты';
			return false;
		} elseif ($textLength < 10 or $textLength > 400) {
			$this->error = 'Слишком большой или маленький текст';
			return false;
		}
		return true;
	}


	public function postsCount() {
		return $this->db->column('SELECT COUNT(id) FROM posts');
	}


	public function postsList($route) {

		$max = 10;

		if( isset($route['page']) ){
	       $pag = $route['page'];
		}else{
		 $pag = 1;
		} 
		
		$params = [
		 'max' => 10,//$max,
		 'start' => 2, //(($pag)-1)*$max,
		];

		return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
	}

}