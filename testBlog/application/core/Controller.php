<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;
	public $admin;

	public function __construct($route) {
		$this->admin = (require 'application/config/admin.php')[0];

		$this->route = $route;
		if (!$this->checkAcl()) {
			View::errorCode(403);
		}
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);

		//--------------------------------------------------------------------- admin settings;

	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function checkAcl() {

		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
			return true;
		}
		elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
			return true;
		}
		elseif (@($_SESSION['admin'] == $this->admin['login']) and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}

}