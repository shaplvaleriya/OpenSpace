<?php if (session_id()=='');
    session_start(); ?>
<?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <title>Добавить фильм</title>
    <link rel="stylesheet" href="../css/adminPanel.css">
    </head>
    <body>
<div class="modal" id="modal-ok">
    <div class="modal-result">
        <button id="out1">X</button>
        <div class="modal-text">
            Фильм изменен
        </div>
        <button id="ok1">OK</button>
    </div>
</div>
<?php
include '../adminMenu/adminMenu.php';
include '../../connection.php';
?>
        <main>
             <h2>Редактирование фильма</h2>
            <?php 
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[1];
$select = "SELECT distinct films.title, films.rating, films.premiere, films.duration, films.age_limit, films.poster, films.description, films.ID_film from films where films.ID_film='$url'";
$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result1);
             ?>
            <div class="form-add-film" >

            <form action="" method="POST" enctype='multipart/form-data' class="add-film">
                 <p>Название фильма:</p>
                <?php echo '<input type="text" name="title" value="'.$row[0].'">' ?>
                <div class="film-figures">
                <div>
                <p>Рейтинг:</p>
                <?php echo '<input type="number" min="0" max="10" step="0.1" name="rating" value="'.$row[1].'">'?>
                </div>
                <div><p>Длительность:</p>
                <?php echo '<input type="text" name="duration" value="'.$row[3].'">' ?>
                </div>
            <div><p>Возраст:</p> 
                <?php echo '<input type="text" name="age_limit" value="'.$row[4].'">' ?>
                </div>
            <div><p>Дата премьеры:</p>
                <?php echo ' <input type="date" name="premiere" value="'.$row[2].'">' ?>
               </div>
            </div>
            <div class="genre-country">
            <div>
                <p>Выберите жанры:</p>
<?php
                $selectG = "SELECT `ID_genre`, `genre` FROM `genres`";
                $resultG = mysqli_query($link, $selectG) or die("Ошибка " . mysqli_error($link));
                $rowsG = mysqli_num_rows($resultG);
            
                for ($i = 0; $i < $rowsG; ++$i) {
                    $rowG = mysqli_fetch_row($resultG);

                    $selectFG = "SELECT ID_genre from film_genre where ID_film='$url' and ID_genre='$rowG[0]'";
                    $resultFG = mysqli_query($link, $selectFG) or die("Ошибка " . mysqli_error($link));
                    $rowFG = mysqli_fetch_row($resultFG);
                    if (!empty($rowFG)) {
                    echo "<div>";
                    echo '<input type="checkbox" name="genres[]" value=' . $rowG[0] . ' checked>';
                    echo $rowG[1];
                    echo "</div>";
                    }
                    else{
                        echo "<div>";
                    echo '<input type="checkbox" name="genres[]" value=' . $rowG[0] . '>';
                    echo $rowG[1];
                    echo "</div>";
                    }
                    
                }
?>
    </div>
     <div>
<p>Выберите страны:</p>
    <?php
                 $selectC = "SELECT `ID_country`, `country` FROM `countries`";
                $resultC = mysqli_query($link, $selectC) or die("Ошибка " . mysqli_error($link));
                $rowsC = mysqli_num_rows($resultC);
            
                for ($i = 0; $i < $rowsC; ++$i) {
                    $rowC = mysqli_fetch_row($resultC);
                    $selectFC = "SELECT ID_country from film_country where ID_film='$url' and ID_country='$rowC[0]'";
                    $resultFC = mysqli_query($link, $selectFC) or die("Ошибка " . mysqli_error($link));
                    $rowFC = mysqli_fetch_row($resultFC);
                    if (!empty($rowFC)) {
                     echo "<div>";
                    echo '<input type="checkbox" name="countries[]" value=' . $rowC[0] . ' checked>';
                    echo $rowC[1];
                     echo "</div>";
                }
                else
                {
                    echo "<div>";
                    echo '<input type="checkbox" name="countries[]" value=' . $rowC[0] . '>';
                    echo $rowC[1];
                     echo "</div>";     
                }
}
                ?>
                </div>
        </div>
            <div class="description">
            <p>Описание:</p>   
                <textarea name="description" id="" cols="20" rows="5" >
                    <?php 
                    echo $row[6]; ?>
                </textarea>
                </div>
                <br>
                <div class="add-button">

                <input type="submit" value="Редактировать фильм" name="changeFilm" class="button"></div>
            </form>
        </main>
    </body>
         <script type="text/javascript">
document.getElementById('out1').addEventListener('click', ()=>{
  location.href='http://localhost:83/OpenSpace/adminPanel/filmList/filmList.php';;
})
document.getElementById('ok1').addEventListener('click', ()=>{
   location.href='http://localhost:83/OpenSpace/adminPanel/filmList/filmList.php';;
})
document.getElementById('modal').addEventListener('click', ()=>{
location.href='http://localhost:83/OpenSpace/adminPanel/filmList/filmList.php';;
})

</script>
</html>


<?php


if(isset($_POST['changeFilm']))
{
if (isset($_POST['title'])) { $title = $_POST['title']; if ($title == '') { unset($title);} }

if (isset($_POST['rating'])) { $rating=$_POST['rating']; if ($rating =='') { unset($rating);} }

if (isset($_POST['premiere'])) { $premiere=$_POST['premiere']; if ($premiere =='') { unset($premiere);} }

if (isset($_POST['duration'])) { $duration=$_POST['duration']; if ($duration =='') { unset($duration);} }

if (isset($_POST['age_limit'])) { $age_limit=$_POST['age_limit']; if ($age_limit =='') { unset($age_limit);} }

if (isset($_POST['description'])) { $description=$_POST['description']; if ($description =='') { unset($description);} }
if (isset($_POST['genres'])) { $genres=$_POST['genres']; if ($genres =='') { unset($genres);} }

if (isset($_POST['countries'])) { $countries=$_POST['countries']; if ($countries =='') { unset($countries);} }


if(empty($title) || empty($rating) || empty($premiere) || empty($duration) || empty($age_limit) || empty($description) || empty($genres) || empty($countries)) {
    echo "<script>;alert('Все поля должны быть заполнены'); location.href='http://localhost:83/OpenSpace/adminPanel/changeFilm/changeFilm.php?".$url."';</script>;";
    mysqli_close($link);
    }
    elseif(!preg_match("/^[\d]{1,3}$/", $duration)) {
        echo "<script>alert('Некорректная длительность.'); location.href='http://localhost:83/OpenSpace/adminPanel/changeFilm/changeFilm.php?".$url."';</script>";
        mysqli_close($link);
    }
        elseif(!preg_match("/^[\d]{1,2}\+$/", $age_limit)) {
        echo "<script>alert('Некорректное возрастное ограничение.'); location.href='http://localhost:83/OpenSpace/adminPanel/changeFilm/changeFilm.php?".$url."';</script>";
        mysqli_close($link);
    }
    else
    {
            $queryChange ="UPDATE films SET title='$title', rating='$rating', premiere='$premiere', duration='$duration', age_limit='$age_limit', description='$description' where ID_film=$url";
            
            $resultChange = mysqli_query($link, $queryChange) or die("Ошибка " . mysqli_error($link));
                if ($resultChange)
                {
                $delete = "DELETE from film_genre where ID_film=$url";
                $resultDelete = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                $deleteC = "DELETE from film_country where ID_film=$url";
                $resultDeleteC = mysqli_query($link, $deleteC) or die("Ошибка " . mysqli_error($link));

                foreach ($_POST['genres'] as $genreValue) {
                $queryAddGenre ="INSERT INTO film_genre (ID_film, ID_genre) VALUES('$url', '$genreValue')";
                $resultAddGenre = mysqli_query($link, $queryAddGenre) or die("Ошибка " . mysqli_error($link));
                }

                foreach ($_POST['countries'] as $countryValue) {
                $queryAddCountry ="INSERT INTO film_country (ID_film, ID_country) VALUES('$url', '$countryValue')";
                $resultAddCountry = mysqli_query($link, $queryAddCountry) or die("Ошибка " . mysqli_error($link));
                }
        echo "<script>;
            $('#modal-ok').css('display', 'flex');
        </script>;";
                }
                else {
                echo "<script>alert('Ошибка, фильм не изменен'); location.href='http://localhost:83/OpenSpace/adminPanel/changeFilm/changeFilm.php?".$url."';</script>";
                mysqli_close($link);
        }
    }

}

?>