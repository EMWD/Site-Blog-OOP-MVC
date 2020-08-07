<?php

namespace application\models;

use application\core\Model;
use Imagick;

class Admin extends Model {

	public $error;

	//----------------------------------------------------------------------------------------------// Login validation
	public function loginValidate($post){
		$admin = (require 'application/config/admin.php')[0];

		if ( $admin['login'] != $post['login']  or $admin['password'] != $post['password'] ){   
			$this->error = 'Логин или пароль введены неверно';
			return false;
		} 
		return true;
	}

	//----------------------------------------------------------------------------------------------// Posts Validation
	public function postValidate($post, $type){

		$nameLength = strlen($post['name']);
		$descriptionLength = strlen($post['description']);
		$textLength = strlen($post['text']);

		if ($nameLength < 3 or $nameLength > 200){
			$this->error = 'Название недопустимой длинны';
			return false;
		} elseif ($descriptionLength < 3 or $descriptionLength > 100) {
			$this->error = 'Описание недопустимой длинны';
			return false;
		} elseif ($textLength < 10 or $textLength > 4000) {
			$this->error = 'Слишком большой или маленький текст';
			return false;
		}

		if (empty($_FILES['img']['tmp_name']) and $type == 'add'){
			$this->error = 'Изображение не выбрано';
			return false;
		}
		return true;

	}

	//----------------------------------------------------------------------------------------------// Delete
	public function postAdd($post) {

		$params = [
			'id' => null,
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];

		$this->db->query('INSERT INTO posts VALUES (:id, :name, :description, :text)', $params);
		return $this->db->lastInsertId();
	}

	//----------------------------------------------------------------------------------------------// Edit
	public function postEdit($post, $id) {
		$params = [
			'id' => $id,
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);
	}

	//----------------------------------------------------------------------------------------------// Post image uploading
	public function postUploadImage($path, $id) {

		// $img = new Imagick($path);
		// $img->cropThumbnailImage(1080, 600);
		// $img->setImageCompressionQuality(80);
		// $img->writeImage('public/materials/'.$id.'.jpg');
		move_uploaded_file($path, 'public/materials/'. $id.'.jpg');
	}

	//----------------------------------------------------------------------------------------------// Сhecking post for existence
	public function isPostExists($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
	}

	//----------------------------------------------------------------------------------------------// Post deleting
	public function postDelete($id) {
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM posts WHERE id = :id', $params);

		if(file_exists('public/materials/'.$id.'.jpg')) { 
			unlink('public/materials/'.$id.'.jpg');
		}
	}
	//----------------------------------------------------------------------------------------------// Data about post
	public function postData($id) {
		$params = [
			'id' => $id,
		];
		return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
	}


}