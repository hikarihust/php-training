<?php
	include("connection.php");
	
	$keyword = (string)$_POST['keywords'];
	$limit   = (int)$_POST['limit'];

	$sql = "SELECT `id`, `name` FROM `products` WHERE `status`=1 AND `name` LIKE '%{$keyword}%'
			ORDER BY `order` ASC, `name` ASC
			LIMIT $limit";

	$result = mysqli_query($link, $sql);
	$books = array();
	while($row = mysqli_fetch_assoc($result)) {
		$books[] = $row;
	}

	echo $bookOjb = json_encode($books);