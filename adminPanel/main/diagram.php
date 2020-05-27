<?php 
include '../../connection.php';
$date=array(); 
$price=array();
for ($i=0; $i < 15; $i++) { 
$date_old=date("d-m-Y", strtotime("-".$i." day"));
array_push($date, $date_old);
	$select = "SELECT purchases.price_purchase from purchases inner join sessions on purchases.ID_session=sessions.ID_session where date_format(sessions.date_session, '%d-%m-%Y')='$date_old'";
	$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));

	$rows = mysqli_num_rows($result1);
			
	for ($j = 0; $j < $rows; ++$j) {
		$row = mysqli_fetch_row($result1);
		$sum_price+=$row[0];	
	}
		array_push($price, $sum_price);
		$sum_price=0;
}


$arrLabels = array("January","February","March","April","May","June","July");
$arrDatasets = array(array('label'=>'Выручка за день','data' => $price, 'backgroundColor' => array('#21409A','#21409A', '#21409A', '#21409A', '#21409A', '#21409A', '#21409A', '#21409A', '#21409A', '#21409A', '#21409A', '#21409A','#21409A', '#21409A', '#21409A')));

$arrReturn = array('labels' => $date, 'datasets' => $arrDatasets);

print (json_encode($arrReturn));
 ?>
