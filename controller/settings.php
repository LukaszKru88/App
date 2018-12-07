<?php

include 'controller/controller.php';

class SettingsController extends controller
{
	public function index(){
		$view = $this->loadView('settings');
		$view->index();
	}

	public function getCategories(){
		$view = $this->loadView('settings');
		$categories = $view->getCategories();
		exit($categories);
	}

	public function editCategory(){
		$model = $this->loadModel('settings');
		$model->editCategory();
	}

	public function addCategory() {
		$model = $this->loadModel('settings');
		$model->addCategory();
	}

	public function deleteCategory() {
		$model = $this->loadModel('settings');
		$model->deleteCategory();
	}
}
