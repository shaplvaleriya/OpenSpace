<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<title>OpenSpace</title>
		<link rel="stylesheet" type="text/css" href="../css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../css/food.css" />
	</head>
	<body>		
		<?php
		include '../menu/menu.php';
		?>
		<main>
			<div class="content-food">
				<div class="title"><h1>Еда и напитки</h1></div> 

<form method="POST">
	<div class="input">
	                    <div class="inputGroup">
                        <input type="radio" name="food" id="popcorn" value="popcorn" checked />
                        <label for="popcorn">Попкорн</label>
                    </div>

                       <div class="inputGroup">
                        <input type="radio" name="food" id="dessert" value="dessert"/>
                        <label for="dessert">Десерт</label>
                    </div>
                      <div class="inputGroup">
                        <input type="radio" name="food" id="drink" value="drink"/>
                        <label for="drink">Напитки</label>
                    </div>
                </div>
                    <div class="form-line"><hr size="1" align="center"></div>                 
</form>
</div>
   <?php include '../food/popcorn.php'; ?>


   <?php 
   // $answer=$_POST['food'];
   // if ($answer=="popcorn") {
   // 	include '../stock/stock.php';
   // }
   //  if ($answer=="dessert") {
   // 	echo "dessert";
   // }
   //     if ($answer=="drink") {
   // 	echo "dessert";
   // }
// if (isset($_POST['food'])) {
// 	switch ($_POST['food']) {
// 		case 'popcorn':
// 			echo "popcorn";
// 			break;
// 		case 'dessert':
// 			echo "dessert";
// 			break;
// 		case 'drink':
// 			echo "dring";
// 				break;
// 	}
// }
    ?>
		</main>
		<?php
		include '../footer/footer.php';
		?>
	</body>
</html>
