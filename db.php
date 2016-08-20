<?php

	/**
	 * 
	 * php get data from mysql then render to html
	 * 
	 * 1 connect to database (host, port, username, password, dbname)
	 * 2 send sql to database (select, insert, update, delete)
	 * 3 fetch result from database(array or object)
	 * 4 close database connection
	 * 5 render data to html
	 * 
	 * mysqli (procedure | object)
	 * pdo (prepared statement)
	 * */
	$conn = mysql_connect("localhost","root","root");
	// $conn2 = mysql_connect("122.222.222.2","root","root");
	mysql_select_db("hr",$conn);
	// var_dump($_GET);
	$search = isset($_GET['search']) ? $_GET['search'] : "";
	$rs = mysql_query("select * from employees where first_name like '%:search%'", $conn);
	bindparam("search", $search);
	// $data = mysql_fetch_array($rs);
	// $data = mysql_fetch_assoc($rs);
	$items = [];
	while($row = mysql_fetch_assoc($rs)){
		$items[] = $row;
	}
	// $data = mysql_fetch_row($rs);
	// var_dump($items);
	mysql_close($conn);

?>
<style>
table tr:hover{
	background-color: #999;
}
table tr td{
	border:1px solid #333;
}
</style>
<form action="" method="get">
<input type="text" name="search" value="<?php echo $search; ?>">
<input type="submit" value="Search" />
</form>
<table>
<?php foreach($items as $item) { ?>
<tr>
<td><?php echo $item['EMPLOYEE_ID']; ?></td>
<td><?php echo $item['FIRST_NAME']; ?></td>
<td><?php echo $item['LAST_NAME']; ?></td>
<td><?php echo $item['SALARY']; ?></td>
</tr>
<?php } ?>
</table>
