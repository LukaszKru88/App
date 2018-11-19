<?php

include 'view/view.php';

class EditExpenseView extends View
{
	public function index()
	{
		$expense = $this->loadModel('editExpense');
		$this->editExpense = $expense->getExpense();
		$this->categoryName = $expense->getCategoryName($this->editExpense);
		$this->paymentMethod = $expense->getPayment($this->editExpense);
		$this->set('expenseCategories', $expense->
			getExpenseCategories());
		$this->set('paymentMethods', $expense->
			getPaymentMethods());
		$this->render('editExpense');
	}

	public function printExpenseCategories($expenseCategories)
	{
		$i=1; 
		foreach($this->get($expenseCategories) as $category) 
		{
			echo '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="form-check-input" type="radio" name="category" id="exampleRadios' . $i . '"  value="' . $category['name'] . '"' . ($this->categoryName['name'] == $category['name'] ? "checked" : "") . '>' . $category['name'] . '</label></li>';
		$i++;
		}
	}

	public function printPaymentMethods($paymentMethods)
	{
		$i=1; 
		foreach($this->get($paymentMethods) as $paymentMethod) 
		{
			echo '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="form-check-input" type="radio" name="payment_method" id="exampleRadios' . $i . '"  value="' . $paymentMethod['name'] . '"' . ($this->paymentMethod['name'] == $paymentMethod['name'] ? "checked" : "") . '>' . $paymentMethod['name'] . '</label></li>';
		$i++;
		}
	}

	public function printAmount()
	{
		echo $this->editExpense['amount'];
	}

	public function printDate()
	{
    	echo $this->editExpense['date']; 
	}

	public function printComment()
	{
		echo $this->editExpense['comment'];
	}
}
