<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<title>OpenSpace</title>
    <link rel="stylesheet" href="../css/registration.css">
	</head>
	<body>		
		<?php
		include '../menu/menu.php';
		?>
		<main>
		<div class="content">
      <form action="" method="POST">
  
          <div class="input">
          <div class="inputGroup">
            <input type="radio" name="f" id="reg" value="popcorn" onchange="changeSignUp(this)"/>
            <label for="re"g>registr</label>
          </div>
          <div class="inputGroup">
            <input type="radio" name="f" id="aut" value="dessert" onchange="changeLogin(this)"/>
            <label for="aut">autoris</label>
          </div>
        </div>
        <div class="form-line">
          <hr size="1" align="center">
        </div>
</form>
      <div class="content-registration">

        <form action="register.php" method="post" class="left-part">
            <div class="form-logo">
              <img src="../image/logo.png" alt="">
            </div>


            <div>
              <input type="text" name="username" required placeholder="Логин">
              <input type="text" name="email" required placeholder="E-mail">
              <input type="password" name="pass" placeholder="Пароль">
              <input type="password" name="passw" placeholder="Подтверждение пароля">
            </div>
              <input type="submit" name="submit" class="button" value="Зарегистрироваться">
        </form>
        <div class="right-part">
            <h2>
              Присоединяйтесь к OpenSpace
            </h2>
            <p>Получайте скидки на билеты, попкорн и
              напитки, особые акции и предложения,
              эксклюзивные презентации и даже
              подарки ко дню Рождения!</p>

        </div>
      </div>
      <div class="content-authorization content-authorization-open">
          <form action="auth_in.php" method="post" class="left-part">
            <div class="form-logo">
              <img src="../image/logo.png" alt="">
            </div>
            <div>
              <input type="text" name="username" placeholder="Логин">
              <input type="password" name="pass" placeholder="Пароль">
            </div>
            <input type="submit" name="submit" class="button" value="Войти">
          </form>
          
        <div class="right-part">          
          <h2>
              Присоединяйтесь
              к OpenSpace
            </h2>
            <p>Получайте скидки на билеты, попкорн и
              напитки, особые акции и предложения,
              эксклюзивные презентации и даже
              подарки ко дню Рождения!</p>        
        </div>
      </div>
      </div>
    </div>
		</main>
		<?php
		// include '../footer/footer.php';
		?>
	</body>
    <script>
    var sing = document.querySelector('.content-authorization');
    var popup = document.querySelector('.content-registration');

    function changeLogin(slider) {
      if (slider.value = 2) {
        popup.classList.remove('content-registration-open');
        sing.classList.add('content-authorization-open');
      }
    };

    function changeSignUp(slider) {
      if (slider.value = 1) {
        sing.classList.remove('content-authorization-open');
        popup.classList.add('content-registration-open');
      }
    };
  </script>
</html>
