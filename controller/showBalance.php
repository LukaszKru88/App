<?php

include 'controller/controller.php';

class BalanceController extends controller
{
	public function index()
	{
		$view = $this->loadView('showBalance');
		$view->index();
	}
}