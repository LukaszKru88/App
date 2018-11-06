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
    		throw new exception('Fill the form to perform a login attempt.');
		else {
		    $user = $_POST['login'];
			$password = $_POST['password'];

			if(((strlen($user) < 3) || (strlen($user) > 20)) || (strlen($password) < 6) || (strlen($password) > 20))
				throw new exception('Data is invalid! Try again.');

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
			throw new exception('Query error. Please try to login in other time!');

		if($result->num_rows <> 1)
			throw new exception('Invalid user or password!');
		else{
			$row = mysqli_fetch_assoc($result);

			if(password_verify($password, $row['password'])){
				$_SESSION['is_logged'] =  true;
				$_SESSION['id'] =  $row['id'];
				$_SESSION['username'] =  $row['username'];
				$_SESSION['email'] = $row['email'];
			}
			else
			    throw new exception('Invalid user or password!');
		}
	}
}