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

if (isset($_POST['register'])) {
    header("Location: index.php"); }

if (isset($_POST['login'])) {
$username = ($_POST['username']);
$password = ($_POST['password']);

    if (!isset($_POST['username']) || mb_strlen($_POST['username'], 'utf-8') < 4 || mb_strlen($_POST['username'], 'utf-8') > 50) {
       echo "Моля, въведете валидно потребителско име! <br>"; 
    }else if (!isset($_POST['password']) || mb_strlen($_POST['password'], 'utf-8') < 6 || mb_strlen($_POST['password'], 'utf-8') > 50 ) {
        echo "Моля, въведете валидна парола! <br>"; 
    }else{
$result = ("SELECT * FROM users WHERE username = '" . $username. "' and password = '" . ($password). "'");

header("Location: dashboard.php");
    }
}
unset($conn);
?>
<form method="post" >
<p>
			<label for="login">Моля, въведете данните си за вход в системата:</label>
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
			<input type="submit" value="Вход" name="login" />
		</p>
		<p>
		<label for="register"> Все още нямате акаунт?</label>
			<input type="submit" value="Регистрация" name="register" />
		</p>
</form>

</body>
</html>