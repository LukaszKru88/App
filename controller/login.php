<?php

include 'controller/controller.php';

class LoginController extends Controller{
	public function index(){
		$view = $this->loadView('login');
		$view->index();
	}

	public function login(){
		$model = $this->loadModel('login');
		$model->loginAttempt();
		$this->redirect('templates/mainMenu.html.php');
	}
}