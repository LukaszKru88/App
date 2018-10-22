<?php

include 'controller/controller.php';

class RegisterController extends Controller{
	public function index(){
		$view = $this->loadView('register');
		$view->index();
	}

}