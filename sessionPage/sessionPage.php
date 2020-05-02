<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" href="../css/sessionPage.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Сеанс</title>
</head>

<body>
    <?php
    include '../menu/menu.php';
    include("../connection.php");
    ?>

    <?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[1];

    $nm = "SELECT films.title, films.poster, date_format(sessions.date_session, '%d.%m.%Y'), time_format(sessions.date_session, '%H:%i') from sessions inner join films on sessions.ID_film=films.ID_film where sessions.ID_session='$url'";
    $result1 = mysqli_query($link, $nm) or die("Ошибка " . mysqli_error($link));
    echo "<div class='films_block'>";
    $row = mysqli_fetch_row($result1);
    echo "<div class='films' id='films''>";
    echo "<div class='phhoto'><img  src='../image/poster/$row[1].jpg' style='width:20%;'></div>";
    echo "<div class='info'>";
    echo "<p class='name'>" . $row[0] . "</p>";
    echo "<div class='category'>";
    echo "<p class='txt'>" . $row[2] ." ". $row[3] . "</p><br>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    $urlforcast = "https://api.openweathermap.org/data/2.5/forecast?q=Minsk&appid=afbbe64f43e833ea7ae6cf1e17ca1b9c";
    $json = file_get_contents($urlforcast);
    $data = json_decode($json, true);
    foreach ($data['list'] as $day => $value) {
        if ($value['dt_txt'] === $row[4]) {
            $weather = $value['weather'][0]['main'];
        }
    }
    // echo $weather;
    ?>
            Билеты типа пикник - 8 руб.
            <br>
            Билеты типа машина - 10 руб.

    <!-- стулья -->
    <form method="post">
        <div class='purchase'>

            <?php



            $spur = "SELECT distinct `ID_place` from `purchases` where `ID_session`='$url'";
            $purres = mysqli_query($link, $spur) or die("Ошибка " . mysqli_error($link));
            $rowsp = mysqli_num_rows($purres);
            $purchase = array();
            for ($k = 0; $k < $rowsp; ++$k) {
                $pur = mysqli_fetch_row($purres);
                $pu = explode(',', $pur[0]);
                $count = count($pu);
                for ($p = 0; $p < $count - 1; $p++) {
                    $purchase[] = $pu[$p];
                }
            }



            $queryRow = "SELECT distinct places.row from places";
            $resultRow = mysqli_query($link, $queryRow) or die("Ошибка " . mysqli_error($link));
            $rows = mysqli_num_rows($resultRow);
            echo "<div class='hall'>";
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($resultRow);

                $queryNumber = "SELECT distinct places.number, places.type, places.ID_place from places  where places.row='$row[0]'";
                $resultNumber = mysqli_query($link, $queryNumber) or die("Ошибка " . mysqli_error($link));
                $rowsNumber = mysqli_num_rows($resultNumber);
                echo "<div class='seats'>";
                for ($j = 0; $j < $rowsNumber; ++$j) {
                    $seat = mysqli_fetch_row($resultNumber);
                    if (in_array($seat[2], $purchase, true)) {
                        echo '<label class="checkbox-outer">';
                        echo '<input type="checkbox" disabled="disabled" >';
                         if ($seat[1]=='picnic') {
                        echo '<span class="checkbox-image-picnic-dis"></span></label>';
                        }
                        else
                        {
                            echo '<span class="checkbox-image-car-dis"></span></label>';
                        }

                    }
                    elseif ($weather=='Snow' || $weather=='Rain' || $weather=='Drizzle' || $weather=='Thunderstorm' && $seat[1]=='picnic') {
                        echo '<label class="checkbox-outer">';
                        echo '<input type="checkbox" disabled="disabled" >';
                        if ($seat[1]=='picnic') {
                        echo '<span class="checkbox-image-picnic-dis"></span></label>';
                        }
                        else
                        {
                            echo '<span class="checkbox-image-car-dis"></span></label>';
                        }
                    }
                    else {
                        echo '<label class="checkbox-outer">';
                        echo '<input type="checkbox" name="tickets[]" class="ticket-check" value=' . $seat[2] . '>';
                        if ($seat[1]=='picnic') {
                            echo '<span class="checkbox-image-picnic"></span></label>';
                        }
                        else
                        {
                            echo '<span class="checkbox-image-car"></span></label>';
                        }
                        
                    }
                }
                echo "<p class='numr'>$r</p>";
                echo "</div>";
            }
            // echo "<p class='screenn'>Экран</p>";
            // echo "<div class='screen'><img src='screen.png'></div>";
            echo "</div>";


            echo "<div class='inform'>";
            echo "<img src='costt.png'>";
            echo "<p class='cost'>Стоимость билета</p>";
            echo "<div id='price'></div>";
            // echo '<input type="submit" value="массив" id="mass"/>';
            echo '<input type="submit" value="Купить билет" name="sub" class="button" style="margin-right: 30px" />';
            echo "</div>";
            echo "</div>";
            echo "</form>";
            ?>

            <?php
            if (isset($_POST['sub'])) {
                if (!empty($_POST['tickets'])) {
                    $ID_user = $_SESSION['ID_user'];
                    if ($ID_user == "") {
                        echo "<script>;alert('Чтобы забронировать билет, необходимо авторизоваться'); location.href='http://localhost:83/OpenSpace/registration/registration.php';</script>;";
                        mysqli_close($link);
                    } else {
                        $querySeat = "SELECT places.ID_place, places.price from places";
                        $resultSeat = mysqli_query($link, $querySeat) or die("Ошибка " . mysqli_error($link));
                        $rowsSeat = mysqli_num_rows($resultSeat);
                        for ($l = 0; $l < $rowsSeat; ++$l) {
                            $rowSeat = mysqli_fetch_row($resultSeat);
                            foreach ($_POST['tickets'] as $ticketValue) {
                                if ($rowSeat[0] == $ticketValue) {
                                    $place .= $ticketValue;
                                    $place .= ",";
                                    $price += $rowSeat[1];
                                }
                            }
                        }

                        $queryUser = "SELECT users.discount from users where users.ID_user=$ID_user";
                        $resultUser = mysqli_query($link, $queryUser) or die("Ошибка " . mysqli_error($link));
                        $rowUser = mysqli_fetch_row($resultUser);

                        $price = $price - ($price * $rowUser[0] / 100);

                        if ($price >= 40) {
                            $present = 1;
                        } else {
                            $present = 0;
                        }


                        $queryBooked = "INSERT INTO purchases (ID_user, ID_session, ID_place, date_purchase, price_purchase, present) values('$ID_user', '$url', '$place', now(), '$price', '$present')";
                        $resultBooked = mysqli_query($link, $queryBooked) or die("Ошибка " . mysqli_error($link));
                        if ($resultBooked) {
                            $queryCount = "SELECT count(distinct purchases.ID_session) from purchases where purchases.ID_user=$ID_user";
                            $resultCount = mysqli_query($link, $queryCount) or die("Ошибка " . mysqli_error($link));
                            $rowCount = mysqli_fetch_row($resultCount);
                            if ($rowCount[0] == 5) {
                                $queryDiscount = "UPDATE users SET discount=5 where users.ID_user=$ID_user";
                                $resultDiscount = mysqli_query($link, $queryDiscount) or die("Ошибка " . mysqli_error($link));
                            }
                            echo "<script>;alert('Покупка успешно завершена');location.href='http://localhost:83/OpenSpace/registration/result_auth.php';</script>;"; 

                        }
                    }
                }
            }

            ?>
            <?php
            include '../footer/footer.php';
            ?>
     <script type="text/javascript">
const checkboxList = document.getElementsByClassName('ticket-check');
console.log(checkboxList);
for (var i = checkboxList.length - 1; i >= 0; i--) {
    checkboxList[i].addEventListener('click',(e)=>{
          console.log(e.target.value);
          const tickets=[];
          for (var i = checkboxList.length - 1; i >= 0; i--) {
              if (checkboxList[i].checked===true) {
                tickets.push(checkboxList[i].value);
              }
          }
        $.post('getPrice.php', {tickets})
                 .done(res => {
        document.getElementById("price").innerHTML = res;
    })
            })

}
</script>

     <script type="text/javascript">
    var expanded = false;

    function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
    }
    </script>
</body>

</html>