<?php
	require __DIR__ .'/Faker_src/autoload.php';
	$faker = Faker\Factory::create("ru_RU");

	$id =  $_POST['check1'];
	$email =  $_POST['check2'];
	$fullname =  $_POST['check3'];
	$city =  $_POST['check4'];
	$address =  $_POST['check5'];
	$myself =  $_POST['check6'];
	
	echo $id, $email, $fullname, $city, $address, $myself;  	
?>