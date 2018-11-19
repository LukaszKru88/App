<?php

include 'view/view.php';

class EditIncomeView extends View
{
	public function index()
	{
		$income = $this->loadModel('editIncome');
		$this->editIncome = $income->getIncome();
		$this->categoryName = $income->getCategoryName($this->editIncome);
		$this->set('incomeCategories', $income->getIncomeCategories());
		$this->render('editIncome');
	}

	public function printIncomeCategories($incomeCategories)
	{
		$i=1; 
		foreach($this->get($incomeCategories) as $category) 
		{
			echo '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="form-check-input" type="radio" name="category" id="exampleRadios' . $i . '"  value="' . $category['name'] . '"' . ($this->categoryName['name'] == $category['name'] ? "checked" : "") . '>' . $category['name'] . '</label></li>';
		$i++;
		}
	}

	public function printAmount()
	{
		echo $this->editIncome['amount'];
	}

	public function printDate()
	{
    	echo $this->editIncome['date']; 
	}

	public function printComment()
	{
		echo $this->editIncome['comment'];
	}
}