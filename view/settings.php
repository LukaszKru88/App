<?php

include 'view/view.php';

class SettingsView extends View
{
	public function index(){
		$this->render('settings');
	}

	public function getCategories(){
		$categories = $this->loadModel('settings');
		$result = $categories->getCategories();
		$categories = $this->printCategories($result);
		$suggestedCategories = $this->printSuggestedCategories($result);
		$rows = array(
			'categories' => $categories,
			'suggestedCategories' => $suggestedCategories
		);

		return(json_encode($rows));
	}

	private function printCategories($result) {
		if($result->num_rows > 0){
			$i=1; 
			$rows = "";
			foreach($result as $row) 
			{
				$rows .= '<li><label class="form-check-label" for="exampleRadios' . $i . '"><input class="manageCategory form-check-input" type="radio" name="category" id="exampleRadios' . $i . '" value="' . $row['name'] . '">' . $row['name'] . '</label></li>';
				$i++;
			}
			return($rows);
		} else {
			exit("Nie ma kategorii do wyświetlenia");
		}
	}

	private function printSuggestedCategories($result) {
		if($result->num_rows > 0){
			$i=1; 
			$rows = "";
			foreach($result as $row) 
			{
				$rows .= '<option class="suggestion" value="' . $row['name'] . '">' . $row['name'] . '</option>';
				$i++;
			}
			return($rows);
		} else {
			exit("Nie ma kategorii do wyświetlenia");
		}
	}
}
