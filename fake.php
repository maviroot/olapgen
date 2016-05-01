<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
	</head>
	<body>
		
		<?php
			echo "<p>This file is <b>", __FILE__, "</b></p>";

			require '../olapgen/Faker_src/autoload.php';

			$faker = Faker\Factory::create("ru_RU");
			$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
			$faker->addProvider(new Faker\Provider\ru_RU\Goods($faker));
			$faker->addProvider(new Faker\Provider\ru_RU\Ggroup($faker));

			require_once 'connection.php';	// подключаем скрипт
			mysqli_query($link, "set names utf8");

			for ($a=1; $a<7; $a++) {
				
				for ($b=0; $b < 10; $b++) {
					echo $randnum=$faker->numberBetween(1,10)," -число<br>";
					$randnum2=$faker->numberBetween(1,10);
					$randnum3=$faker->numberBetween(1,10);
					$randnum4=$faker->numberBetween(1,10);
					$randnum5=$faker->numberBetween(1,10);
					$txtrus=$faker->realText(50);
					$values = array();
					
				for ($c=0; $c < 10; $c++) {
					// get a random digit, but always a new one, to avoid duplicates
					$values []= $faker->unique()->numberBetween(1,20);
				}
					echo "<pre>";
				print_r($values);
				echo "</pre>";
					

					$query1 ="INSERT INTO city (city_name)
										VALUES ('$faker->city')";
					$query2 ="INSERT INTO contractor (contr_name, contr_address, contr_contact, contr_type, city_id)
										VALUES ('$faker->name', '$faker->address', '$faker->PhoneNumber', '$faker->boolean', $randnum )";
					$query3 ="INSERT INTO goods_group (gg_name, gg_desc)
										VALUES ('$faker->ggname', '$txtrus')";
					$query4 ="INSERT INTO goods (goods_name, goods_cost, goods_instock, gg_id)
										VALUES ('$faker->good', '$faker->randomFloat', '$faker->randomDigit', $randnum2)";
					$query5 ="INSERT INTO invoice (inv_type, inv_date, inv_totalprice, contr_id)
										VALUES ('$faker->boolean', '$faker->date', '$faker->randomFloat', $randnum)";
					$query6 ="INSERT INTO invoice_detail (quantity, good_id, invoice_id)
										VALUES ($randnum3, $randnum4, $randnum5)";

					echo "<br>", $a, "<br>";
					echo $b, "<br>";
					${'result'.$a} = mysqli_query($link, ${'query'.$a}) or die("Ошибка " . mysqli_error($link));
				}
			}
			
			$query7 = "SELECT inv_id, quantity*goods_cost FROM goods as t1, invoice_detail as t2, invoice as t3 WHERE t1.goods_id=t2.good_id AND t2.inv_det_id=t3.inv_id";
			$result7 = mysqli_query($link, $query7);
			
			while ($row = mysqli_fetch_array($result7, MYSQLI_NUM)) {
				$query8 ="UPDATE invoice SET inv_totalprice='{$row[1]}' WHERE inv_id='{$row[0]}'";
				$result8 = mysqli_query($link, $query8) or die("Ошибка " . mysqli_error($link));
			}

			mysqli_close($link);	// закрываем подключение
		?>
	</body>
</html>
