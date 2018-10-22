<?php

include 'view/view.php';

class RegisterView extends View{
	public function index(){
		$this->render('registerForm');
	}
}
