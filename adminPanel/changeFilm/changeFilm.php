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
    <link rel="stylesheet" href="../css/registration.css">
    </head>
    <body>
        <main>
            <?php 
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[1];
$select = "SELECT distinct films.title, films.rating, films.premiere, films.duration, films.age_limit, films.poster, films.description, films.ID_film from films where films.ID_film='$url'";
$result1 = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result1);
             ?>
            <form action="" method="POST" enctype='multipart/form-data'>
                <?php echo '<input type="text" name="title" value="'.$row[0].'">' ?>
                <br>
                <?php echo '<input type="number" min="0" max="10" step="0.1" name="rating" value="'.$row[1].'">'?>
                <br>
                <?php echo ' <input type="date" name="premiere" value="'.$row[2].'">' ?>
                <br>
                Длительность
                <?php echo '<input type="text" name="duration" value="'.$row[3].'">' ?>
                <br>
                Возрастное ограничение
                <?php echo '<input type="text" name="age_limit" value="'.$row[4].'">' ?>
                <br>
                <textarea name="description" id="" cols="20" rows="5" >
                    <?php 
                    echo $row[6]; ?>
                </textarea>
                <br>
                <input type="submit" value="Редактировать фильм" name="changeFilm">
            </form>
        </main>
    </body>
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


if(empty($title) || empty($rating) || empty($premiere) || empty($duration) || empty($age_limit) || empty($description)) {
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
            echo "<script>alert('Такой название уже существует'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
            mysqli_close($link);
        }
        else
        {
            $queryChange ="UPDATE films SET title='$title', rating='$rating', premiere='$premiere', duration='$duration', age_limit='$age_limit', description='$description' where ID_film=$url";
            
            $resultChange = mysqli_query($link, $queryChange) or die("Ошибка " . mysqli_error($link));
                if ($resultChange)
                {             
                echo "<script>alert('фильм изменен'); location.href='http://localhost:83/OpenSpace/adminPanel/filmList/filmList.php';</script>";
                mysqli_close($link);
                }
                else {
                echo "<script>alert('Ошибка, фильм не изменен'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
                mysqli_close($link);
            } 
        }
    }

}

?>