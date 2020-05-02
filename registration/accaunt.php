<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <title>Аккаунт</title>
    <link rel="stylesheet" href="../css/registration.css">
</head>

<body>
    <?php
        include("../menu/menu.php");
            include("../connection.php");
    ?>
<main>
<div class="content">
    <div class="left-part"> 
        <?php
        $ID_user = $_SESSION["ID_user"];
        echo "<div class='ticket'>";
        echo "Мои билеты:";

        $nm2 = "SELECT films.title, sessions.date_session, purchases.price_purchase, purchases.status_purchase, purchases.present, purchases.ID_place FROM users INNER JOIN purchases ON users.ID_user=purchases.ID_user INNER JOIN sessions ON purchases.ID_session=sessions.ID_session INNER JOIN films ON sessions.ID_film=films.ID_film WHERE users.ID_user='$ID_user' ORDER BY purchases.date_purchase";

        $result2 = mysqli_query($link, $nm2) or die("Ошибка " . mysqli_error($link));
        $rowss = mysqli_num_rows($result2);
        for ($i = 0; $i < $rowss; ++$i) {
            $rows = mysqli_fetch_row($result2);
            echo "<br>";
            echo "<br>";
            echo "<span>Название фильма:</span> ";
            echo $rows[0];
            echo "<br>";
            echo "<span>Дата и время:</span> ";
            echo $rows[1];
            echo "<br>";
            echo "<span>Стоимость:</span> ";
            echo $rows[2];
            echo "<br>";
            echo "<span>статус:</span> ";
            echo $rows[3];            
            // echo "<span>Место:</span> ";
            // echo $rows[4];
            // echo "<br>";
            // echo "<span>Ряд:</span> ";
            // echo $rows[5];
            // echo "<br>";
        }
        echo '</div>';

        ?>
    </div>
    <div class="right-part"> 
        <?php
        $ID_user = $_SESSION["ID_user"];
        include("../connection.php");
        $nm = "SELECT `name`, `email` FROM `users` WHERE `ID_user`='$ID_user'";
        $result1 = mysqli_query($link, $nm) or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_row($result1);
        ?>
        <?php echo $row[0];?>
        <?php
        echo $row[1];
        echo '<br>';
        echo '<a href="../registration/auth_out.php"><p class="out">Выйти</p></a>';
        ?> 
    </div>
</div>
</main>
</body>

</html>