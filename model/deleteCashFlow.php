<?php

include 'model/model.php';

class deleteCashFlowModel extends Model
{
	public function delete($id) 
	{
        try{
	        $query = "DELETE FROM $_GET[type] WHERE id='$id'";

	        if(!$result = $this->dbo->query($query)){
				throw new exception('Błąd zapytania! Przepraszamy za niedogodności!');
			}
		} catch (Exception $e) {
			$_SESSION['message'] = $e->getMessage();
		}
	}
}