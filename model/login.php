<?php
include 'model/model.php';

class LoginModel extends Model{

	public function loginAttempt()
	{
	    try{
	        $credentials = $this->getCredentials();
	        $this->checkUserCredentials($credentials);
	        //$this->dbo->close();
	    } catch(Exception $e){
	    	$_SESSION['message'] = $e->getMessage();
	    }
	}

	private function getCredentials()
	{
		if($_POST['login'] == "" && $_POST['password'] == "")
    		throw new Exception('Wypełnij formularz aby się zalogować');
		else {
		    $user = $_POST['login'];
			$password = $_POST['password'];

			if(((strlen($user) < 3) || (strlen($user) > 20)) || (strlen($password) < 6) || (strlen($password) > 20))
				throw new exception('Niewłaściwy login lub hasło');

			$user = $this->dbo->real_escape_string($user);
			$password = $this->dbo->real_escape_string($password);

			$credentials = array(
				'user' => $user,
				'password' => $password
			);

			return $credentials;
		}
	}

	private function checkUserCredentials($credentials)
	{
		$user = $credentials['user'];
		$password = $credentials['password'];

		$query = "SELECT * ";
		$query .= "FROM users WHERE username = '$user'";

		if(!$result = $this->dbo->query($query))
			throw new exception('Błąd zapytania. Prosimy o próbę zalogowania w innym terminie.');

		if($result->num_rows <> 1)
			throw new exception('Niewłaściwy login lub hasło!');
		else{
			$row = mysqli_fetch_assoc($result);

			if(password_verify($password, $row['password'])){
				$_SESSION['is_logged'] =  true;
				$_SESSION['id'] =  $row['id'];
				$_SESSION['username'] =  $row['username'];
				$_SESSION['email'] = $row['email'];
			}
			else
			    throw new exception('Niewłaściwy login lub hasło!');
		}
	}
}