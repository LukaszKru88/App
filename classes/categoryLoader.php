<?php
include 'model/model.php';

class categoryLoader extends Model
{
	public function loadCategories($user_id, $category_type)
	{
		try
		{
	        $categories = $this->getCategories($user_id, 
			$category_type);
			$this->printCategoriesList($categories);
			$this->dbo->close();
		}
		catch(Exception $e)
		{
			$_SESSION['message'] = $e->getMessage();
		}
	}

	private function getCategories($user_id, $category_type)
	{
		switch($category_type){
			case 'incomes':
				$query="SELECT name 
						FROM incomes_category_assigned_to_users 
						WHERE user_id='$user_id'";	
				$print_prefferences = 0;
				break;
			case 'payment':
				$query="SELECT name 
						FROM payment_methods_assigned_to_users 
						WHERE user_id='$user_id'";
				$print_prefferences = 1;
				break;
			case 'expenses':
				$query="SELECT name 
						FROM expenses_category_assigned_to_users
						WHERE user_id='$user_id'";
				$print_prefferences = 2;
				break;
		}

		if($result = $this->dbo->query($query)){
			$result->fetch_all(MYSQLI_ASSOC);
			$categories = $result;	
			$categories = array($categories, $print_prefferences);	
			return $categories;
		} else {
			throw new exception('Błąd zapytania! Przepraszamy za niedogodności!');
		}
	}

	private function printCategoriesList($categories)
	{
		$i=1;
		foreach($categories[0] as $category)
		{
			echo '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="form-check-input" type="radio" name=' . ($categories[1] != 1 ? "category" : "payment_method") . ' id="exampleRadios' . $i . '"  value="' . $category['name'] . '"' . ($i == 1 ? "checked" : "") . '>' . $category['name'] . '</label></li>';									
			$i++;
		}
	}
}
