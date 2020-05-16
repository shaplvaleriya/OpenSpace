<?php
require "../../connection.php";
$sessionId = $_POST['sessionId'];

$query = "SELECT purchases.ID_place, purchases.date_purchase, purchases.price_purchase, purchases.status_purchase, purchases.present, users.name, purchases.ID_purchase from purchases inner join users on purchases.ID_user=users.ID_user where purchases.ID_session=$sessionId";
$request = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($request);

echo "<div class='ticket'>";
echo "<ul class='ticketList'>";

for ($i = 0; $i < $rows; ++$i) {
    $column = mysqli_fetch_row($request);
    echo "<li class='accordion'>";
    echo "<input type='checkbox' checked>";
    echo "<i></i>";
    if ($column[3] == 'bought') {
        echo "<h2>" . $column[5] . " Типа галочка</h2>";
    } elseif ($column[3] == 'booked') {
        echo "<h2>" . $column[5] . " Типа крестик</h2>";
    }
    echo "<p>";

    $seat = explode(',', $column[0]);
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
        if ($row[2] == 'car') {
            echo "машина.";
        } else {
            echo "пикник.";
        }
        echo "<br>";
    }
    echo "<span>дата покупки:</span> ";
    echo $column[1];
    echo "<br>";


    echo "<span>Цена:</span> ";
    echo $column[2];
    echo "<br>";
    if ($column[4] == 1) {
        echo "Попкорн в подарок!";
    }

    echo "</p>";
    echo "</li>";
    if ($column[3] == 'booked') {
        echo "<div purches_id=" . $column[6] . ">";
        echo "Куплено";
        echo "</div>";
    }
}

echo "</ul>";
echo '</div>';


// if (isset($_POST['changeStatus'])) {
//     echo 'wefwef';
//     if (isset($_POST['status'])) {
//         $status = $_POST['status'];
//         if ($status == '') {
//             unset($status);
//         }
//     }

//     $queryChange = "UPDATE purshase SET status_purchase='bought' where ID_purchase=$voting";

//     $resultChange = mysqli_query($link, $queryChange) or die("Ошибка " . mysqli_error($link));
// }
