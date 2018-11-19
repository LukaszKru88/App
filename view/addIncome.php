<?php

include 'view/view.php';

class AddIncomeView extends View
{
	public function index()
	{
		$incomeCategories = $this->loadModel('addIncome');
		$this->set('incomeCategories', $incomeCategories->getIncomeCategories());
	    $this->render('addIncome');
	}

		public function printIncomeCategories($incomeCategories)
	{
		$i=1; 
		foreach($this->get($incomeCategories) as $category) 
		{
			echo '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="form-check-input" type="radio" name="category" id="exampleRadios' . $i . '"  value="' . $category['name'] . '"' . ($i == 1 ? "checked" : "") . '>' . $category['name'] . '</label></li>';
		$i++;
		}
	}
}