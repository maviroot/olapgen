<?php
	$host = 'localhost'; // адрес сервера 
	$database = 'tets2'; // имя базы данных
	$user = 'olap'; // имя пользователя
	$password = 'arneus1993'; // пароль

	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
?>