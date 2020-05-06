<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <title>Аккаунт</title>
    <link rel="stylesheet" href="../css/registration.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../css/media-quaries.css">
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
echo "<ul>";
        $nm2 = "SELECT films.title, sessions.date_session, purchases.price_purchase, purchases.status_purchase, purchases.present, purchases.ID_place, purchases.present FROM users INNER JOIN purchases ON users.ID_user=purchases.ID_user INNER JOIN sessions ON purchases.ID_session=sessions.ID_session INNER JOIN films ON sessions.ID_film=films.ID_film WHERE users.ID_user='$ID_user' ORDER BY purchases.date_purchase";

        $result2 = mysqli_query($link, $nm2) or die("Ошибка " . mysqli_error($link));
        $rowss = mysqli_num_rows($result2);
        for ($i = 0; $i < $rowss; ++$i) {
            echo "<li class='accordion'>";
            echo "<input type='checkbox' checked>";
            echo "<i></i>";
            $t=$i+1;
            echo "<h2>Заказ №".$t."</h2>";
            $rows = mysqli_fetch_row($result2);
            echo "<p>";
            echo "<span>Название фильма:</span> ";
            echo $rows[0];
            echo "<br>";
            echo "<span>Дата и время:</span> ";
            echo $rows[1];
           
            echo "<br>";
            $seat = explode(',',$rows[5]);
            $count = count($seat);
            for ($p = 0; $p < $count - 1; $p++) {
                    $queryRow = "SELECT places.row, places.number, places.type from places where places.ID_place=$seat[$p]";
                    $resultRow = mysqli_query($link, $queryRow) or die("Ошибка " . mysqli_error($link));
                     $row = mysqli_fetch_row($resultRow);

                     echo "Ряд:";
                     echo $row[0];
                     echo "; место: ";
                     echo $row[1];
                     echo "; тип: ";
                     if ($row[2]=='car') {
                        echo "машина.";
                     }else{
                     echo "пикник.";}echo "<br>";
            }

            echo "<span>Стоимость:</span> ";
            echo $rows[2];
            echo "<br>";
            echo "<span>Cтатус:</span> ";
            if ($rows[3]=='booked') {
                echo "забронировано";
            }
            else
            {
                echo "куплено";
            } 
            echo "<br>";
            if ($rows[6]==1) {
                echo "Попкорн в подарок!";
            }
            echo "</p>";
            echo "</li>";           
        }
echo "</ul>";
        echo '</div>';

        ?>
    </div>
    <div class="right-part right-part-accaunt"> 
        <?php
        $ID_user = $_SESSION["ID_user"];
        include("../connection.php");
        $nm = "SELECT `name`, `email`, `discount`  FROM `users` WHERE `ID_user`='$ID_user'";
        $result1 = mysqli_query($link, $nm) or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_row($result1);
        echo "<div class='name'>";
        echo "<span>";
        echo $row[0];
        echo "</span>";
         echo "<br>";
        echo "<span>";
        // echo '</div>';
        // echo "<div>";
        echo $row[1];
        echo "</span>";
        echo '</div>';
        ?>
        <div class="discount">
        <h2>Ваша скидка</h2>
        <h1>
        <?php 
        echo $row[2]."%</h1>";
        echo '<br>';
        echo '<a href="../stock/stock.php">Узнайте как получать бонусы и скидки</a></div>';
        echo "<div>";
        echo '<a href="../registration/auth_out.php">Выйти</a>';
        echo '</div>';
        ?> 
    </div>
</div>
</main>
</body>

</html>