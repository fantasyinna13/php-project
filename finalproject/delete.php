<?php
	require_once('DbHelper.php');
	$conn = DbHelper::GetConnection();
	$id = -1;
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	if(isset($_POST["yes"])) {
		$stm = $conn->prepare("DELETE FROM tickets WHERE id = ?");
		$stm->execute(array($id));
		header("Location: dashboard.php");
	} else if(isset($_POST["no"])) {
		header("Location: dashboard.php");
	}
	unset($conn);
?>
<html>
	<head>

    </head>
	<body>
		<form method="post">
			<label> Избраният ticket ще бъде изтрит. Желаете ли да продължите? </label>
			<input type="submit" name="yes" value="да" />
			<input type="submit" name="no" value="не" />
		</form>
	</body>
</html>