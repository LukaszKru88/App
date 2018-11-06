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
		if(!isset($_SESSION['is_logged'])){
			$this->redirect('index.php?task=login&action=index');
		}
		else
			$this->redirect('index.php');
	}
}