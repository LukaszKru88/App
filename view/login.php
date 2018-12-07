<?php

include 'view/view.php';

class LoginView extends View
{
	public function index(){
		$this->render('loginForm');
	}
}
