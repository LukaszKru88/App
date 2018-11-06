<?php

include 'view/view.php';

class AddExpenseView extends View
{
	public function index()
	{
		$expenseCategories = $this->loadModel('addExpense');
		$this->set('expenseCategories', $expenseCategories->getExpenseCategories());
		$this->set('paymentMethods', $expenseCategories->getPaymentMethods());
	    $this->render('addExpense');
	}
}