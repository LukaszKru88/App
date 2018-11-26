<?php

include 'view/view.php';

class IncomeView extends View
{
	public function addIncomeView()
	{
		$incomeCategories = $this->loadModel('income');
		$this->set('incomeCategories', $incomeCategories->getIncomeCategories());
	    $this->render('income');
	}

	public function editIncomeView()
	{
		$income = $this->loadModel('income');
		$this->editIncome = $income->getIncome();
		$this->categoryName = $income->getCategoryName($this->editIncome);
		$this->set('incomeCategories', $income->getIncomeCategories());
		$this->render('income');
	}

	public function addIncomeCategories($incomeCategories)
	{
		$i=1; 
		foreach($this->get($incomeCategories) as $category) 
		{
			echo '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="form-check-input" type="radio" name="category" id="exampleRadios' . $i . '"  value="' . $category['name'] . '"' . ($i == 1 ? "checked" : "") . '>' . $category['name'] . '</label></li>';
		$i++;
		}
	}

	public function editIncomeCategories($incomeCategories)
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