<?php
include 'model/model.php';

class RegisterModel extends Model
{

	public function registerAttempt()
	{
		try {
		    $registrationData = $this->getRegistrationData();
		    $this->checkRegistrationData($registrationData);
		    $this->addUserToDb($registrationData);
			$this->dbo->close();
		} catch (Exception $e) {
		    $_SESSION['message'] = $e->getMessage();
		}
	}

	private function getRegistrationData()
	{
	    //Sprawdzanie poprawności nicka
	    $nick = $_POST['nick'];
		if((strlen($nick) < 3) || (strlen($nick) > 20))
		    throw new exception('Nick musi posiadać od 3 do 20 znaków');

	    if(ctype_alnum($nick) == false)
		    throw new exception('Nick może skłądać się tylko z liter i cyfr (bez polskich znaków)!');

		//Sprawdzanie poprawności emaila
		$email = $_POST['email'];
		$emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);

		if((filter_var($emailSanitize, FILTER_VALIDATE_EMAIL) == false) || ($emailSanitize != $email))
		    throw new exception('Podaj poprawny adres email!');

		//Sprawdzanie poprawności haseł
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		if((strlen($password1) < 6) || (strlen($password1) > 20))
		    throw new exception('Hasło musi posiadać od 6 do 20 znaków!');

		if($password1 != $password2)
			throw new exception('Podane hasła różnią się od siebie! Podaj identyczne hasła.');

		$password_hash = password_hash($password1, PASSWORD_DEFAULT);

		//Sprawdzanie akceptacji regulaminu
		if(!isset($_POST['rules']))
			throw new exception('Musisz potwierdzić akceptację regulaminu.');

		//Sprawdzanie formularza CAPTCHA
		$secret_key="6Lfjf2kUAAAAAHBDrdNHotcoERxpinyPVQeZYvNp";
		$check=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
		
		$recaptcha_response=json_decode($check);
		
		if($recaptcha_response->success==false)
			throw new exception('Potwierdź, że nie jesteś botem!');

		$registrationData = array(
			'nick' => $nick,
			'email' => $email,
			'password' => $password_hash
		);

		return $registrationData;
	}

	private function checkRegistrationData($registrationData)
	{
		$nick = $registrationData['nick'];
		$email = $registrationData['email'];
		$password = $registrationData['password'];

		$this->checkEmailAdress($email);
		$this->checkNick($nick);
	}

	private function checkEmailAdress($email)
	{
		$result = $this->select('users', '*', "email = '$email'");
		if(!empty($result))
			throw new exception('Istnieje już konto przypisane do podanego adresu e-mail!');
	}

	private function checkNick($nick)
	{
		$result = $this->select('users', '*', "username = '$nick'");
		if(!empty($result))
			throw new exception('Istnieje już użytkownik o takim
					nicku!');
	}

	private function addUserToDb($registrationData)
	{
		$nick = $registrationData['nick'];
        $email = $registrationData['email'];
        $password = $registrationData['password'];

		$this->insertUser($nick, $email, $password);
		if($_SESSION['user_added'] == true){
		    $query = "SELECT id ";
			$query .= "FROM users WHERE username = '$nick'";

			if($result = $this->dbo->query($query)){
				$result = mysqli_fetch_assoc($result);
				$this->addDefaultCategories($result);
				$_SESSION['registration_approved'] = true;
			}
		} 
		else
			throw new Exception('Query error. Please try to register in other time!');
	}

    private function insertUser($nick, $email, $password){
        $query = "INSERT INTO users";
        $query .= " VALUES (NULL, '$nick', '$password', '$email')";

        if($this->dbo->query($query))
            $_SESSION['user_added'] = true;
        else
            throw new Exception('Query error. Please try to register in other time!');
    }

	private function addDefaultCategories($result)
	{
		$user_id = $result['id'];

		$paymentMethodQuery = "INSERT INTO payment_methods_assigned_to_users (user_id, name)
				SELECT u.id, p.name 
				FROM users u, payment_methods_default p 
				WHERE u.id='$user_id'";

		$expensesCategoryQuery = "INSERT INTO expenses_category_assigned_to_users (user_id, name) 
				SELECT u.id, e.name 
				FROM users u, expenses_category_default e
			  	WHERE u.id='$user_id'";

		$incomesCategoriesQuery = "INSERT INTO incomes_category_assigned_to_users (user_id, name) 
				SELECT u.id, i.name 
				FROM users u, incomes_category_default i 
				WHERE u.id='$user_id'";

		if(!$this->dbo->query($paymentMethodQuery) || 
			   !$this->dbo->query($expensesCategoryQuery) || 
			   !$this->dbo->query($incomesCategoriesQuery))
			throw new exception('Query error. Please try to register in other time!');
	}
}
