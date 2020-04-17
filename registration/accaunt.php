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
    ?>
<main>
<div class="content">
    <div class="left-part"> 
        <?php
        // echo "<div class='ticket'>";
        // echo "Мои билеты:";

        // $nm2 = "SELECT films.title, cinemas.title, halls.hall, seances.datetime, seats.seat, seats.row, seances.price, seances.IDS, purchase.IDSeat FROM users INNER JOIN purchase ON users.IDU=purchase.IDU INNER JOIN seances ON purchase.IDS=seances.IDS INNER JOIN films ON seances.IDF=films.IDF INNER JOIN halls ON seances.IDH=halls.IDH INNER JOIN cinemas ON halls.IDC=cinemas.IDC INNER JOIN seats ON purchase.IDseat=seats.IDSeat WHERE users.idu='$id' ORDER BY purchase.purchasedate";
        // $result2 = mysqli_query($link, $nm2) or die("Ошибка " . mysqli_error($link));
        // $rowss = mysqli_num_rows($result2);
        // for ($i = 0; $i < $rowss; ++$i) {
        //     $rows = mysqli_fetch_row($result2);
        //     echo "<br>";
        //     echo "<br>";
        //     echo "<span>Название фильма:</span> ";
        //     echo $rows[0];
        //     echo "<br>";
        //     echo "<span>Кинотеатр:</span> ";
        //     echo $rows[1];
        //     echo "<br>";
        //     echo "<span>Зал:</span> ";
        //     echo $rows[2];
        //     echo "<br>";
        //     echo "<span>Дата и время:</span> ";
        //     echo $rows[3];
        //     echo "<br>";
        //     echo "<span>Место:</span> ";
        //     echo $rows[4];
        //     echo "<br>";
        //     echo "<span>Ряд:</span> ";
        //     echo $rows[5];
        //     echo "<br>";
        //     echo "<span>Стоимость:</span> ";
        //     echo $rows[6];
        // }
        // echo '</div>';

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