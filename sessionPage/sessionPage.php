<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" href="../css/sessionPage.css">
    <link rel="stylesheet" href="../css/media-quaries.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Сеанс</title>
</head>

<body>
    <?php
    include '../menu/menu.php';
    include("../connection.php");
    ?>
<div class="session-content">
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[1];

    $nm = "SELECT films.title, films.poster, date_format(sessions.date_session, '%d.%m.%Y'), time_format(sessions.date_session, '%H:%i'), sessions.date_session, films.age_limit,films.rating, group_concat(distinct genres.genre separator ', '), group_concat(distinct countries.country separator ', ') from films inner join sessions on sessions.ID_film=films.ID_film  inner join film_genre on films.ID_film=film_genre.ID_film inner join genres on film_genre.ID_genre=genres.ID_genre inner join film_country on films.ID_film=film_country.ID_film inner join countries on film_country.ID_country=countries.ID_country where sessions.ID_session='$url'";
    $result1 = mysqli_query($link, $nm) or die("Ошибка " . mysqli_error($link));
    // echo "<div class='films_block'>";
    $row = mysqli_fetch_row($result1);
    echo "<div class='films' id='films''>";
    echo "<div class='phhoto'><img  src='../image/poster/$row[1].jpg'></div>";

    echo "<div class='info'>";
        echo "<div class='session-name'>";
                    echo $row[0];
        echo "</div>";
        echo "<div class='film_info'>";
                    echo "".$row[5]."/".$row[6]."";
        echo "</div>";
        echo "<div class='film_info'>";
                    echo $row[7];
        echo "</div>";
        echo "<div class='film_info'>";
                    echo $row[8];
        echo "</div>";
        echo "<div class='film_date'>";
                    echo $row[2];
        echo "</div>";
        echo "<div class='film_date'>";
                    echo $row[3];
        echo "</div>";
    echo "</div>";

echo "<div class='weather'>";

    $urlforcast = "https://api.openweathermap.org/data/2.5/forecast?q=Minsk&units=metric&appid=afbbe64f43e833ea7ae6cf1e17ca1b9c";
    $json = file_get_contents($urlforcast);
    $data = json_decode($json, true);
    foreach ($data['list'] as $day => $value) {
        if ($value['dt_txt'] === $row[4]) {
            $degree = round($value['main']['temp'],0 );
        }
    }

     $urlforcast = "https://api.openweathermap.org/data/2.5/forecast?q=Minsk&appid=afbbe64f43e833ea7ae6cf1e17ca1b9c";
    $json = file_get_contents($urlforcast);
    $data = json_decode($json, true);
    foreach ($data['list'] as $day => $value) {
        if ($value['dt_txt'] === $row[4]) {
            $weather = $value['weather'][0]['main'];
        }
    }
 switch ($weather) {
                case 'Clouds':
                    echo "Облачно";
                    break;
                case 'Clear':
                    echo "Ясно";  
                    break;
                case 'Atmosphere':
                    echo "Атмосферно";
                    break;
                case 'Snow':
                    echo "Снег";
                    break;
                case 'Rain':
                    echo "Дождь";
                    break;
                case 'Drizzle':
                    echo "Изморось";
                    break;
                case 'Thunderstorm':
                    echo "Гроза";
                    break;
                default:
                    break;
            }
echo "<div class='degree'>";
echo "".$degree."°";
echo "</div>";
echo "</div>";
    echo "</div>";
    // echo "</div>";
    $urlforcast = "https://api.openweathermap.org/data/2.5/forecast?q=Minsk&appid=afbbe64f43e833ea7ae6cf1e17ca1b9c";
    $json = file_get_contents($urlforcast);
    $data = json_decode($json, true);
    foreach ($data['list'] as $day => $value) {
        if ($value['dt_txt'] === $row[4]) {
            $weather = $value['weather'][0]['main'];
        }
    }
    ?>
<hr size='1' class="session-line">
<h2>Типы мест</h2>
<div class="places">
    <div class="places-photo">
        <img src="picnic-unchecked.png" alt="">
    </div>
    <div class="places-info">
        <div class="places-name">Пикник</div>
        <div class="places-duration">Удобное место для небольшой компании. Обустроено неяркими лампами, мягкими пуфами и теплыми пледами.</div>
    </div>
    <div class="places-price">
        8,00 BYN
    </div>
</div>

<div class="places">
    <div class="places-photo places-photo-car">
        <img src="car-unchecked.png" alt="">
    </div>
    <div class="places-info">
        <div class="places-name">Машина</div>
        <div class="places-duration">Удобные места для двоих. Оснащены мягкими подушками и пледами. Можно использовать как багажник пикапа, так и салон автомобиля при плохих погодных условиях.</div>
    </div>
    <div class="places-price">
        10,00 BYN
    </div>
</div>
<hr size='1' class="session-line">

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
                    elseif (($weather=='Snow' || $weather=='Rain' || $weather=='Drizzle' || $weather=='Thunderstorm') && $seat[1]=='picnic') {
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
            echo "</div>";


            echo "<div class='inform'>";
            echo "<h2>Стоимость билета</h2>";
            echo "<div id='price'><p>Выбрано:</p> 0 билетов<br><p>Сумма заказа:</p>0 руб.;<br><br></div>";
            echo '<input type="submit" value="Купить билет" name="sub" class="button"/>';
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
                            echo "<script>;alert('Покупка успешно завершена');location.href='http://localhost:83/OpenSpace/registration/result_auth.php';</script>;"; 

                        }
                    }
                }
            }

            ?>
<hr size='1' class="session-line">
<div class="places">
    <div class="places-photo">
        <img src="picnic-checked.png" alt="">
    </div>
    <div class="places-info">
        <div class="places-duration">Мест выбрано</div>
    </div>
</div>

<div class="places">
    <div class="places-photo places-photo-car">
        <img src="picnic-disabled.png" alt="">
    </div>
    <div class="places-info">
        <div class="places-duration">Место забронирвоано, куплено или недоступно из-за погодных условий.</div>
    </div>
</div>
<hr size='1' class="session-line">

</div>


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