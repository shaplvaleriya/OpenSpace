<?php if (session_id()=='')
session_start(); ?>
<?php
include '../menu/menu.php';
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<title>Форум</title>
	<link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../css/contact.css">
	<link rel="stylesheet" href="../css/media-quaries.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<!-- <main> -->
   <div class="banner-video">
     <video preload="auto" autoplay="true" loop="true" muted="muted">
		    <source src="../video/openSpace.mp4" type="video/mp4">
		</video>
   </div>
<div class="banner">
	<div class="banner-title">
	OpenSpace -</div> кинотеатр под открытым небом, прекрасное место для всех, кто желает расслабиться и насладиться вечером.
</div>

<div class="contact">
	<div class="contact-info">
            <h2>Контакты</h2>
            <p>
                Телефон: <a href="tel:+375293330055">+375 29 333 00 55</a>
            </p>
            <p>
                Адрес: г. Минск пр. Партизанский, 48
            </p>
            <p>
                E-mail: <a href="mailto:cinema.arena@silverscreen.by">cinema.arena@silverscreen.by</a><br>
            </p>
            <p>
                Время сеансов: с 18:00 до 00:00<br>
            </p>
	</div>
	<div class="contact-advertising">
            <video  controls >
                <source src="../video/advertising.mp4">
                Тег video не поддерживается вашим браузером. 
            </video>
	</div>
</div>
		<?php
		include '../footer/footer.php';
		?>
<!-- <div>
	<form>

		<input type="hidden" name="project_name" value="Openspace">
		<input type="hidden" name="admin_email" value="valeriyashaplyko@gmail.com">
		<input type="hidden" name="form_subject" value="Form Subject">

		<input type="text" name="Name" placeholder="You name..." required><br>
		<input type="text" name="E-mail" placeholder="You E-mail..." required><br>
		<input type="text" name="Phone" placeholder="You phone..."><br>
		<button>Send</button>

	</form>
	

</div>	 -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>
		$(document).ready(function() {

	//E-mail Ajax Send
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

});
	</script>
	<!-- </main> -->
</body>
</html>

