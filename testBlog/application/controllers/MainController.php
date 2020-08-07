<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller {


	public function indexAction() {
		$pagination = new Pagination($this->route, $this->model->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route),
		];
		$this->view->render('Главная страница', $vars);
	}

	public function contactAction() {

		if (!empty($_POST)) {
			if (!$this->model->contactValidate($_POST)){
				$this->view->message('Ошибка', $this->model->error);
			}
			mail(
				$this->admin["admin_mail"],
				$_POST['name'] . ', ' . $_POST['email'],
				$_POST['text']
			);

			$this->view->message('Успешно', 'Сообщение отправлено');
		}
		$this->view->render('Контакты');
	}

	public function aboutAction() {
		$this->view->render('Обо мне');
	}

	public function postAction() {
		$adminModel = new Admin;
		if (!$adminModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->postData($this->route['id'])[0],
		];
		$this->view->render('Пост', $vars);
	}

}