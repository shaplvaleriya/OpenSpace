<?php if (session_id()=='')
session_start(); ?>
<?php
require "../../connection.php";
if ($_SESSION['ID_user']!=='') {

$ID_user = $_SESSION['ID_user'];
$tickets = $_POST['tickets'];
$sessionId = $_POST['sessionId'];


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


$queryBooked = "INSERT INTO purchases (ID_user, ID_session, ID_place, date_purchase, price_purchase, status_purchase, present) values('$ID_user', '$sessionId', '$place', now(), '$price', 'bought', '$present')";
$resultBooked = mysqli_query($link, $queryBooked) or die("Ошибка " . mysqli_error($link));

$spur = "SELECT distinct `ID_place` from `purchases` where `ID_session`='$sessionId'";
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
            echo '<input type="button" value="Купить билет" id="bought-tickets" name="sub" class="button"/>';
            echo "</div>";
            echo "</div>";
            echo "</form>";
        }
?>