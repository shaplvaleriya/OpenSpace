<?php
require "../../connection.php";
$purchaseId = $_POST['purchaseId'];

$queryChange = "UPDATE purchases SET status_purchase='bought' where ID_purchase=$purchaseId";
$resultChange = mysqli_query($link, $queryChange) or die("Ошибка " . mysqli_error($link));

$select = "SELECT ID_user from purchases where ID_purchase=$purchaseId";
$result = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
$rowSelect = mysqli_fetch_row($result);
$queryCount = "SELECT count(distinct purchases.ID_session) from purchases where purchases.ID_user=$rowSelect[0] and purchases.status_purchase='bought' group BY purchases.ID_user";
$resultCount = mysqli_query($link, $queryCount) or die("Ошибка " . mysqli_error($link));
$rowCount = mysqli_fetch_row($resultCount);
if ($rowCount[0] == 5) {
    $queryDiscount = "UPDATE users SET discount=5 where users.ID_user=$rowSelect[0]";
    $resultDiscount = mysqli_query($link, $queryDiscount) or die("Ошибка " . mysqli_error($link));
}

$sessionId = $_POST['sessionId'];

$query = "SELECT purchases.ID_place, purchases.date_purchase, purchases.price_purchase, purchases.status_purchase, purchases.present, users.name, purchases.ID_purchase from purchases inner join users on purchases.ID_user=users.ID_user where purchases.ID_session=$sessionId and users.role='user'";
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
        echo "<h2>" . $column[5] . " <img src='../../image/checkmark.svg' width='32px'></h2>";
    } elseif ($column[3] == 'booked') {
        echo "<h2>" . $column[5] . " <img src='../../image/cross.svg'></h2>";
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
        echo "<div class='booked-bought'>";
        echo "<div purches_id='". $column[6] ."' class='bought'>";
        echo "Купить";
        echo "</div>";

        echo "</div>";
    }
    else
    {
        echo "<div class='booked-bought'>";
        echo "</div>";
    }
}

echo "</ul>";
echo '</div>';
?>
<script>$(document).ready(function() {
    console.log(123)
}
    const ticketList = $('.ticketList');
    const ticketListForms = ticketList[0].children;
        console.log(ticketListForms)

    for (let j = 1; j < ticketListForms.length; j+=2) {
        const form = ticketListForms[j].children[0];
        console.log(form)
        form.addEventListener('click', (e) => {
            console.log( sessionFilm[i].getAttribute('session'));
            console.log(form.getAttribute('purches_id'));
            $.post('changePurchase.php', {
                purchaseId: form.getAttribute('purches_id'),
                sessionId: sessionFilm[i].getAttribute('session')

            }).done(res => {
                document.getElementById("purchase").innerHTML = res;
            })
        })

    }
</script>
