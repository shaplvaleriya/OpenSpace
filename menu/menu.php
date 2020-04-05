<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/pater.css">
	<title>OpenSpace</title>
</head>
<header id='hed'>
	<div class="header_content content content--fixed">
		<nav>
			<ul class="snip1135">
				<li><img src="../image/logo.png" class='logo' alt=""></li>
				<li id="index"><a href="../main/index.php" data-hover="Главная">Главная</a></li>
				<li id="poster"><a href="../poster/poster.php" data-hover="Афиша">Афиша</a></li>
				<li id="cinemaPage"><a href="../cinemaPage/cinemaPage.php" data-hover="Кинотеатры">Кинотеатры</a></li>
				<li id="contactPage"><a href="../contactPage/contactPage.php" data-hover="Контакты">Контакты</a></li>
			</ul>
		</nav>
			<?php
					echo "<a class='pater' id='signInModal' href='../register/reg.php'>";
				echo "<div class='pater_text'>Войти</div>";
			echo "<svg class='pater__deco' width='300' height='240' viewBox='0 0 1000 800'>
				<path fill='#764098' d='M27.4,171.8C73,42.9,128.6,1,128.6,1s0,0,0,0c58.5,0,368.3,0.3,873.2,0.8c38.5,211,42.1,373.5,38.9,476.7c-2.5,80.3-10.6,174.9-76.7,247.8c-15.1,16.6-37.4,41.2-72.8,53.9c-92.4,33.1-173-50.8-283.9-99.4c-224.3-98.4-334.9,51.4-472.2-45.6C-6.3,535.2-14.5,290.6,27.4,171.8z'/>
			</svg>";
					echo "<p class='pater__desc'>";
			echo 'Войти';
			echo "<br><br>Войдите в свой аккаунт, чтобы заказать билет";
			echo "</p>";
				echo "</a>";
				
			?>

	</div>
</header>