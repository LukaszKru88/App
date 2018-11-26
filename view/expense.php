<?php

include 'view/view.php';

class ExpenseView extends View
{
	public function addExpenseView()
	{
		$expenseCategories = $this->loadModel('expense');
		$this->set('expenseCategories', $expenseCategories->getExpenseCategories());
		$this->set('paymentMethods', $expenseCategories->getPaymentMethods());
	    $this->render('expense');
	}

	public function editExpenseView()
	{
		$expense = $this->loadModel('expense');
		$this->editExpense = $expense->getExpense();
		$this->categoryName = $expense->getCategoryName($this->editExpense);
		$this->paymentMethod = $expense->getPayment($this->editExpense);
		$this->set('expenseCategories', $expense->
			getExpenseCategories());
		$this->set('paymentMethods', $expense->
			getPaymentMethods());
		$this->render('expense');
	}

	public function addExpenseCategories($expenseCategories)
	{
		$i=1; 
		foreach($this->get($expenseCategories) as $category) 
		{
			echo '<li><label class="form-check-label" for="category' . $i . '"><input class="form-check-input" type="radio" name="category" id="category' . $i . '"  value="' . $category['name'] . '"' . ($i == 1 ? "checked" : "") . '>' . $category['name'] . '</label></li>';
		$i++;
		}
	}

	public function editExpenseCategories($expenseCategories)
	{
		$i=1; 
		foreach($this->get($expenseCategories) as $category) 
		{
			echo '<li><label class="form-check-label" for="category' . $i . '"><input class="form-check-input" type="radio" name="category" id="category' . $i . '"  value="' . $category['name'] . '"' . ($this->categoryName['name'] == $category['name'] ? "checked" : "") . '>' . $category['name'] . '</label></li>';
		$i++;
		}
	}

	public function addPaymentMethods($paymentMethods)
	{
		$i=1; 
		foreach($this->get($paymentMethods) as $paymentMethod) 
		{
			echo '<li><label class="form-check-label" for="payment' . $i . '"><input class="form-check-input" type="radio" name="payment_method" id="payment' . $i . '"  value="' . $paymentMethod['name'] . '"' . ($i == 1 ? "checked" : "") . '>' . $paymentMethod['name'] . '</label></li>';
		$i++;
		}
	}

	public function editPaymentMethods($paymentMethods)
	{
		$i=1; 
		foreach($this->get($paymentMethods) as $paymentMethod) 
		{
			echo '<li><label class="form-check-label" for="payment' . $i . '"><input class="form-check-input" type="radio" name="payment_method" id="payment' . $i . '"  value="' . $paymentMethod['name'] . '"' . ($this->paymentMethod['name'] == $paymentMethod['name'] ? "checked" : "") . '>' . $paymentMethod['name'] . '</label></li>';
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