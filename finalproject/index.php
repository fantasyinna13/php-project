<?php 
session_start();
require('DBHelper.php');
$conn = DbHelper::GetConnection();
?>
<html>

<head>
</head>

<body>
<?php

$_SESSION["username"] = 'username';
$_SESSION["password"] = 'password';
$_SESSION["dropDowmRole"] = 'dropDownRole';

	$errors = array();

    if (isset($_POST['signIn'])) {
		header("Location: login.php"); }

	if (isset($_POST['register'])) {
		if (!isset($_POST['username']) || mb_strlen($_POST['username'], 'utf-8') < 4 || mb_strlen($_POST['username'], 'utf-8') > 50) {
			$errors[] = "Потребителкото име е невалидно!";
		}
		if (!isset($_POST['password']) || mb_strlen($_POST['password'], 'utf-8') < 6 || mb_strlen($_POST['password'], 'utf-8') > 50 || !isset($_POST['passwordAgain']) || $_POST['passwordAgain'] != $_POST['password']) {
			$errors[] = "Невалидна парола!";
		}
		if (!isset($_POST['firstName']) || mb_strlen($_POST['firstName'], 'utf-8') < 2 || mb_strlen($_POST['firstName'], 'utf-8') > 50) {
			$errors[] = "Невалидно име!";
		}
		if (!isset($_POST['lastName']) || mb_strlen($_POST['lastName'], 'utf-8') < 3 || mb_strlen($_POST['lastName'], 'utf-8') > 50) {
			$errors[] = "Невалидна фамилия!";
		}
		if (!isset($_POST['dropDownRole']) || mb_strlen($_POST['dropDownRole'], 'utf-8') < 3 || mb_strlen($_POST['dropDownRole'], 'utf-8') > 100) {
			$errors[] = "Невалидна роля!";
		}
try{

		if (count($errors) == 0) {
			
            $stm = $conn->prepare('INSERT INTO users(username, password,  firstName, lastName, dropDownRole) VALUES(?, ?, ?, ?, ?)');
            $stm->execute(array($_POST['username'], $_POST['password'],  $_POST['firstName'], $_POST['lastName'], $_POST['dropDownRole']));
			
			header("Location: login.php");
          
        }
}catch(PDOException $e){
    die("Възникна грешка: " . $e->getMessage()) ;
        }
	}
    
	unset($conn);

	if (count($errors) > 0) {
		?>
			<ul style="color: red;">
				<?php
				foreach ($errors as $e) {
					echo "<li>$e</li>";
				}
				?>
			</ul>
            <?php
		}
		?>




<form method="post" >
<p>
			<label for="register">Моля, въведете данните си за регистрация:</label>
	</p>
		<p>
			<label for="username">Потребителско име:</label>
			<input type="text" id="username" name="username"   />
		</p>
		<p>
			<label for="password">Парола:</label>
			<input type="password" id="password" name="password" />
		</p>
		<p>
			<label for="passwordAgain">Повторете паролата:</label>
			<input type="password" id="passwordAgain" name="passwordAgain" />
		</p>
		<p>
			<label for="firstName">Име:</label>
			<input type="text" id="firstName" name="firstName"  />
		</p>
		<p>
			<label for="lastName">Фамилия:</label>
			<input type="text" id="lastName" name="lastName"  />
		</p>
		<p>
		<label for="dropDownRole">Роля във фирмата:</label>
		<select name="dropDownRole" id="dropDownRole" size="1">
                <option value="junior">програмист - Junior</option>
                <option value="mid">програмист - Mid-level</option>
				<option value="senior">програмист - Senior</option>
				<option value="office">поддръжка офис</option>
                <option value="tech" >поддръжка - техническа част</option>
            </select>
		</p>
		<p>
			<input type="submit" value="Регистрация" name="register" />
		</p>
		<p>
		<label for="signIn">Вече имате акаунт?</label>
			<input type="submit" value="Вход" name="signIn" />
		</p>
</form>


</body>
</html>