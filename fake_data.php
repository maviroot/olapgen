<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<tr>
			<th>Название</th>
			<th>Сумма</th>
			<th>Доля</th>
			<th>Доля2</th>
		</tr>

		<?php
			error_reporting( E_ERROR );
			require_once 'php/connection.php';
			mysqli_query($link, "set names utf8");
			$query1 = "SELECT t3.goods_name, sum(quantity)*t3.goods_cost
									FROM invoice as t1, invoice_detail as t2, goods as t3
									WHERE t2.invoice_id = t1.inv_id AND t1.inv_type = 1 AND t2.good_id = t3.goods_id
									GROUP BY good_id
									ORDER BY SUM( quantity ) * t3.goods_cost DESC";
			$result1 = mysqli_query($link, $query1) or trigger_error(mysqli_error($link));

			while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) {
					$rows[] = $row[1];
					$rows_txt[] = $row;
			}

			$row_cnt = mysqli_num_rows($result1);
		
			for ($i = 0; $i < $row_cnt; $i++) {
				$part[] = ($rows[$i]*100)/array_sum($rows);
				$part1[] = $part1[$i-1]  + $part[$i];
				echo '<tr>';
				echo '<td>' . $rows_txt[$i][0] . '</td>';
				echo '<td>', number_format($rows_txt[$i][1], 0, ',', ' '), '</td>';
				echo '<td>', number_format($part[$i], 2),  '</td>';
				echo '<td>', number_format($part1[$i], 2), '</td>';
				echo '</tr>';
			}
			
			echo $randomTimestamp = date("d-m-Y", mktime(0,0,0,rand(2016,2016),rand(1,31),rand(1,12)));
			
		?>


	</table>
	
		
</body>
</html>
