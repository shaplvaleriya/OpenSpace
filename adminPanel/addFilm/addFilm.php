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
            <form action="" method="POST" enctype='multipart/form-data'>
                <input type="text" name="title" placeholder="Название фильма">
                <br>
                <input type="number" min="0" max="10" step="0.1" name="rating" value="5">
                <br>
                <input type="date" name="premiere">
                <br>
                <input type="text" name="duration" placeholder="Длительность">
                <br>
                <input type="text" name="age_limit" placeholder="Возрастное ограничение">
                <br>
                <input type="file" name="poster">
                <br>
                <textarea name="description" id="" cols="20" rows="5"></textarea>
                <br>
                <input type="radio" name="voting" value="1">
                <input type="radio" name="voting" value="0" checked>
                <br>
                <input type="submit" value="Добавить фильм" name="addFilm">
            </form>
        </main>
    </body>
</html>


<?php
if (session_id()=='');
    session_start();

if(isset($_POST['addFilm']))
{
if (isset($_POST['title'])) { $title = $_POST['title']; if ($title == '') { unset($title);} }

if (isset($_POST['rating'])) { $rating=$_POST['rating']; if ($rating =='') { unset($rating);} }

if (isset($_POST['premiere'])) { $premiere=$_POST['premiere']; if ($premiere =='') { unset($premiere);} }

if (isset($_POST['duration'])) { $duration=$_POST['duration']; if ($duration =='') { unset($duration);} }

if (isset($_POST['age_limit'])) { $age_limit=$_POST['age_limit']; if ($age_limit =='') { unset($age_limit);} }

if (isset($_POST['description'])) { $description=$_POST['description']; if ($description =='') { unset($description);} }

if (isset($_POST['voting'])) { $voting=$_POST['voting']; if ($voting =='') { unset($voting);} }

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

    // $files=glob('../image/poster/*', GLOB_ONLYDIR);
    // foreach ($files as $num => $Dir) {
    //     $Num++;
    //     $Count=sizeof(glob($Dir.'/*.*'));
    //     if ($Count<250) {
    //         $Download = $Dir.'/'.$id_new_post;
    //         break;
    //     }
    // }
    // echo "hk";
$Download = '../../image/poster/'.$id_new_post;
imagejpeg($Tmp, $Download.'.jpg');
imagedestroy($Image);
imagedestroy($Tmp);
}



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
            echo "<script>alert('Такой фильм уже существует'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
            mysqli_close($link);
        }
        else
        {
            $queryAdd ="INSERT INTO films (title, rating, premiere, duration, age_limit, poster, description, voting) VALUES('$title', '$rating', '$premiere', '$duration', '$age_limit', '$id_new_post', '$description', '$voting')";
            $resultAdd = mysqli_query($link, $queryAdd) or die("Ошибка " . mysqli_error($link));
                if ($resultAdd)
                {             
                echo "<script>alert('фильм добавлен'); location.href='http://localhost:83/OpenSpace/adminPanel/addFilm/addFilm.php';</script>";
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