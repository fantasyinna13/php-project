<?php 
require('DBHelper.php');
$conn = DbHelper::GetConnection();
?>
<html>

<head>
</head>

<body>

<?php

if (isset($_POST['Back'])) {
    header("Location: dashboard.php"); }

	$errors = array();


	if (isset($_POST['add'])) {
		if (!isset($_POST['title']) || mb_strlen($_POST['title'], 'utf-8') < 4 || mb_strlen($_POST['title'], 'utf-8') > 100) {
			$errors[] = "Заглавието е невалидно!";
		}
		if (!isset($_POST['ticket']) || mb_strlen($_POST['ticket'], 'utf-8') < 6 || mb_strlen($_POST['ticket'], 'utf-8') > 500 ) {
			$errors[] = "Невалиден ticket!";
		}
		if (!isset($_POST['visibleFor']) || mb_strlen($_POST['visibleFor'], 'utf-8') < 1 || mb_strlen($_POST['visibleFor'], 'utf-8') > 50) {
			$errors[] = "Моля, изберете валиден запис!";
		}
		if (!isset($_POST['refersTo']) || mb_strlen($_POST['refersTo'], 'utf-8') < 1 || mb_strlen($_POST['refersTo'], 'utf-8') > 50) {
			$errors[] = "Моля, изберете валиден запис!";
		}
try{

		if (count($errors) == 0) {
			
            $stm = $conn->prepare('INSERT INTO tickets(title, ticket, visibleFor, refersTo) VALUES(?, ?, ?, ?)');
            $stm->execute(array($_POST['title'], $_POST['ticket'],  $_POST['visibleFor'], $_POST['refersTo']));
			
			header("Location: dashboard.php");
          
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



<form method="post" enctype="multipart/form-data" >
<p>
			<label for="ticket">Добяване на нов ticket:</label>
	</p>
		<p>
			<label for="title">Заглавие:</label>
			<input type="text" id="title" name="title"   />
		</p>
		<p>
			<label for="ticket">Ticket:</label>
			<input type="text" id="ticket" name="ticket" />
		</p>
		<p>
		<label for="visibleFor">Видим за:</label>
		<select name="visibleFor" id="visibleFor" size="1">
                <option value="me">за мен</option>
                <option value="everyone">за всички</option>
            </select>
		</p>
        <p>
		<label for="refersTo">Отнася се за:</label>
		<select name="refersTo" id="refersTo" size="1">
                <option value="office">офис поддръжка</option>
                <option value="tech">техническа поддръжка</option>
            </select>
		</p>
		<p>
			<input type="submit" value="Добавяне" name="add" />
		</p>
        <p>
			<input type="submit" value="Отказ" name="Back" />
		</p>
      
</form>


</body>

</html>