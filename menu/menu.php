<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/pater.css">
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/media-quaries.css">
	<title>OpenSpace</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<header>
        <nav>
            <div class="nav-logo">
                <img src="../image/logo.png" class='logo' alt="">
            </div>
            <div class="nav-content">
                <div class="nav-list">
                    <ul>
                        <li><a href="#" data-hover="Главная">Главная</a></li>
                        <li id="poster"><a href="../poster/poster.php" data-hover="Афиша">Афиша</a></li>
                        <li id="stock"><a href="../stock/stock.php" data-hover="Акции">Акции</a></li>
                        <li id="food"><a href="../food/food.php" data-hover="Еда и напитки">Еда и напитки</a></li>
                        <li><a href="#" data-hover="Контакты">Контакты</a></li>
                    </ul>
                </div>
                <div class="nav-signIn">
                    <a class='pater' id='signInModal' href='../registration/registration.php' data-hover="ВОЙТИ" >
                        <div class='pater_text'>ВОЙТИ</div>
                        <svg class='pater__deco' width='300' height='240' viewBox='0 0 1000 800'>
                            <path fill='#764098' d='M27.4,171.8C73,42.9,128.6,1,128.6,1s0,0,0,0c58.5,0,368.3,0.3,873.2,0.8c38.5,211,42.1,373.5,38.9,476.7c-2.5,80.3-10.6,174.9-76.7,247.8c-15.1,16.6-37.4,41.2-72.8,53.9c-92.4,33.1-173-50.8-283.9-99.4c-224.3-98.4-334.9,51.4-472.2-45.6C-6.3,535.2-14.5,290.6,27.4,171.8z'/>
                        </svg>
                        <p class='pater__desc'>
                            ВОЙТИ
                            <br><br>Войдите в свой аккаунт, чтобы заказать билет
                        </p>
                    </a>
                </div>
            </div>
        </nav>
        <div class="hamburger" id="hamburger-1">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </header>
    <script src="../js/hamburger.js"></script>
    <script src="../js/header.js"></script>