<?php if (session_id()=='');
    session_start();
 ?><?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <title>Добавить фильм</title>
    </head>
    <body>
        <main>
            <h2>Добавить фильм</h2>
            <form action="" method="POST" enctype='multipart/form-data'>
                <table>
                <tr><td>Название фильма:</td> <td><input type="text" name="title" placeholder="Название фильма"></td>
<td rowspan="5">Выберите жанры:
     <?php
                $select = "SELECT `ID_genre`, `genre` FROM `genres`";
                $result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
                $rows = mysqli_num_rows($result1);
            
                for ($i = 0; $i < $rows; ++$i) {
                    $row = mysqli_fetch_row($result1);
                    echo "<div>";
                    echo '<input type="checkbox" name="genres[]" value=' . $row[0] . '>';
                    echo $row[1];
                    echo "</div>";
                }
    ?>
</td>
<td rowspan="5">Выберите страны:
    <?php
                 $selectC = "SELECT `ID_country`, `country` FROM `countries`";
                $resultC = mysqli_query($link, $selectC) or die("Ошибка " . mysqli_error($link));
                $rowsC = mysqli_num_rows($resultC);
            
                for ($i = 0; $i < $rowsC; ++$i) {
                    $rowC = mysqli_fetch_row($resultC);
                     echo "<div>";
                    echo '<input type="checkbox" name="countries[]" value=' . $rowC[0] . '>';
                    echo $rowC[1];
                     echo "</div>";
                }
                ?>
</td>
                </tr>
                <tr><td>Рейтинг:</td> <td><input type="number" min="0" max="10" step="0.1" name="rating" value="5"></td></tr>
                <tr><td>Дата премьеры:</td> <td><input type="date" name="premiere"></td></tr>
                <tr><td>Длительность:</td> <td><input type="text" name="duration" placeholder="Длительность"></td>
                </tr>
                <tr><td>Возрастное ограничение:</td> <td><input type="text" name="age_limit" placeholder="Возрастное ограничение"></td></tr>
                <tr><td>Постер:</td> <td><input type="file" name="poster"></td></tr>
                <tr><td>Описание:</td> <td><textarea name="description" id="" cols="20" rows="5"></textarea></td></tr>
                <tr><td>NotForVoting<input type="radio" name="voting" value="0" checked></td><td>ForVoting<input type="radio" name="voting" value="1"></td>
                </tr>
               
                </table>
                <br>
                <input type="submit" value="Добавить фильм" name="addFilm" class="button">
            </form>
        </main>
    </body>
</html>


<?php
if(isset($_POST['addFilm']))
{
if (isset($_POST['title'])) { $title = $_POST['title']; if ($title == '') { unset($title);} }

if (isset($_POST['rating'])) { $rating=$_POST['rating']; if ($rating =='') { unset($rating);} }

if (isset($_POST['premiere'])) { $premiere=$_POST['premiere']; if ($premiere =='') { unset($premiere);} }

if (isset($_POST['duration'])) { $duration=$_POST['duration']; if ($duration =='') { unset($duration);} }

if (isset($_POST['age_limit'])) { $age_limit=$_POST['age_limit']; if ($age_limit =='') { unset($age_limit);} }

if (isset($_POST['description'])) { $description=$_POST['description']; if ($description =='') { unset($description);} }

if (isset($_POST['voting'])) { $voting=$_POST['voting']; if ($voting =='') { unset($voting);} }
if (isset($_POST['genres'])) { $genres=$_POST['genres']; if ($genres =='') { unset($genres);} }

if (isset($_POST['countries'])) { $countries=$_POST['countries']; if ($countries =='') { unset($countries);} }

if (isset($_FILES['poster'])) { $poster = $_FILES['poster']; if ($poster == '') { unset($poster);} }

echo $poster['name'];

echo $_FILES['poster']['type'];
if (!empty($_FILES['poster']['name'])) {
if ($_FILES['poster']['type']!= 'image/jpeg') echo 'Не верный тип изображения'; 
if ($_FILES['poster']['size']> 50000000000) echo 'Размер изображения слишком большой'; 
$Image=imagecreatefromjpeg($_FILES['poster']['tmp_name']);
$Size = getimagesize($_FILES['poster']['tmp_name']);
$Tmp = imagecreatetruecolor(800, 1100);
imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 800, 1100, $Size[0], $Size[1]);

 $l="SELECT max(ID_film) FROM films";
            $result3 = mysqli_query($link, $l) or die("Ошибка " . mysqli_error($link));
             $rows = mysqli_num_rows($result3);
    for ($i = 0; $i < $rows; ++$i) {
        $row = mysqli_fetch_row($result3);
        $id_new_post=$row[0];
    }
$Download = '../../image/poster/'.$id_new_post;
imagejpeg($Tmp, $Download.'.jpg');
imagedestroy($Image);
imagedestroy($Tmp);
}



if(empty($title) || empty($rating) || empty($premiere) || empty($duration) || empty($age_limit) || empty($description) || empty($genres) || empty($countries)) {
    echo "<script>;alert('Все поля должны быть заполнены'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>;";
    mysqli_close($link);
    }
    elseif(!preg_match("/^[\d]{1,3}$/", $duration)) {
        echo "<script>alert('Некорректная длительность.'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
        mysqli_close($link);
    }
        elseif(!preg_match("/^[\d]{1,2}\+$/", $age_limit)) {
        echo "<script>alert('Некорректное возрастное ограничение.'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
        mysqli_close($link);
    }
    else
    {
        $queryTitle ="SELECT ID_film FROM films WHERE title='$title'";
        $resultTitle = mysqli_query($link, $queryTitle) or die("Ошибка " . mysqli_error($link));
        $rowTitle = mysqli_fetch_row($resultTitle);
        if (!empty($rowTitle[0]))
        {
            echo "<script>alert('Такой фильм уже существует'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
            mysqli_close($link);
        }
        else
        {
            $queryAdd ="INSERT INTO films (title, rating, premiere, duration, age_limit, poster, description, voting) VALUES('$title', '$rating', '$premiere', '$duration', '$age_limit', '$id_new_post', '$description', '$voting')";
            $resultAdd = mysqli_query($link, $queryAdd) or die("Ошибка " . mysqli_error($link));
                if ($resultAdd)
                {
                $queryID ="SELECT ID_film FROM films WHERE title='$title'";
                $resultID = mysqli_query($link, $queryID) or die("Ошибка " . mysqli_error($link));
                $rowID = mysqli_fetch_row($resultID);   
                foreach ($_POST['genres'] as $genreValue) {
                $queryAddGenre ="INSERT INTO film_genre (ID_film, ID_genre) VALUES('$rowID[0]', '$genreValue')";
                $resultAddGenre = mysqli_query($link, $queryAddGenre) or die("Ошибка " . mysqli_error($link));
                }

                foreach ($_POST['countries'] as $countryValue) {
                $queryAddCountry ="INSERT INTO film_country (ID_film, ID_country) VALUES('$rowID[0]', '$countryValue')";
                $resultAddCountry = mysqli_query($link, $queryAddCountry) or die("Ошибка " . mysqli_error($link));
                }

                echo "<script>alert('фильм добавлен'); location.href='http://localhost:83/OpenSpace/adminPanel/filmList/filmList.php';</script>";
                mysqli_close($link);
                }
                else {
                echo "<script>alert('Ошибка, фильм не добавлен'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
                mysqli_close($link);
                } 
        }
    }

}

?>