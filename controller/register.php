<?php

include 'controller/controller.php';

class RegisterController extends Controller{
	public function index(){
		$view = $this->loadView('register');
		$view->index();
	}

	public function register(){
		$model = $this->loadModel('register');
		$model->registerAttempt();

		if(!isset($_SESSION['registration_approved'])){
			unset($_SESSION['registration_approved']);
			header("location: index.php?task=register&action=index");
		}
		else
			$this->redirect('index.php');
	}
}