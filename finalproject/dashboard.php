<?php 

require('DBHelper.php');
$conn = DbHelper::GetConnection();
?>
<html>

<head>
</head>

<body>



<?php
 


if (isset($_POST['addTicket'])) {
    header("Location: newTicket.php"); }


$conn = DbHelper::GetConnection();
		$stm = $conn->query("SELECT * FROM tickets");
		$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
		unset($conn);
        ?>


<form method="post" >
<p>
		<label for="addTicket">Добавяне на нов ticket:  </label>
			<input type="submit" value="Добавяне" name="addTicket" /> 
            <label  <ul style="color: red;" > Само за програмисти! </font> </label>
           
		</p>

</form>

<style>
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
}
</style>
<table>
		<tr>
			<th>Заглавие</th>
			<th>Ticket</th>
			<th>Видим за:</th>
			<th>Отнася се за:</th>
		</tr>
		<?php
			foreach($rows as $r) {
			?>
				<tr>
					<td><?=$r["title"]?></td>
					<td><?=$r["ticket"]?></td>
					<td><?=$r["visibleFor"]?></td>
                    <td><?=$r["refersTo"]?></td>
                   
					<td>
						<a href="newTicket.php?id=<?=$r["id"]?>">Редакция</a>
            </td>
            <td>
						<a href="delete.php?id=<?=$r["id"]?>">Изтриване</a>
					</td>
                   
				</tr>
			<?php
			}
		?>
	</table>


   

</body>
</html>