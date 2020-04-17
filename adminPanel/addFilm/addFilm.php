<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <title>Добавить фильм</title>
    <link rel="stylesheet" href="../css/registration.css">
    </head>
    <body>
        <main>
            <form action="" method="POST">
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
                <input type="file">
                <br>
                <textarea name="description" id="" cols="20" rows="5"></textarea>
                <br>
                <input type="radio" name="voting" value="1">
                <input type="radio" name="voting" value="0">
                <br>
                <input type="submit" value="Добавить фильм">
            </form>
        </main>
    </body>
</html>

<?php
if (session_id()=='');
    session_start();
if (isset($_POST['title'])) { $email = $_POST['title']; if ($email == '') { unset($title);} }

if (isset($_POST['rating'])) { $rating=$_POST['rating']; if ($rating =='') { unset($rating);} }

if (isset($_POST['premiere'])) { $premiere=$_POST['premiere']; if ($premiere =='') { unset($premiere);} }

if (isset($_POST['duration'])) { $duration=$_POST['duration']; if ($duration =='') { unset($duration);} }

if (isset($_POST['voting'])) 
// function clean($value) {
//     $value = trim($value);
//     $value = stripslashes($value);
//     $value = strip_tags($value);
//     $value = htmlspecialchars($value);
//     return $value;
// }

// $email = clean($email);
// $username = clean($username);
// $password = clean($password);
// $confirmPassword = clean($confirmPassword);

// if(empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
//     echo "<script>;alert('Все поля должны быть заполнены'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>;";
//     mysqli_close($link);
// }
//     elseif(!preg_match("~[a-zA-Z\d]{5,}~", $username)) {
//         echo "<script>alert('Некорректный логин.'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//         mysqli_close($link);
//     }
//     elseif(!preg_match("~[a-zA-Z\d]{6,}~", $password)) {
//         echo "<script>alert('Некорректный пароль.'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//         mysqli_close($link);
//     }
//     elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)) {
//         echo "<script>alert('Некорректный E-mail.'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//         mysqli_close($link);
//     }
//     elseif ($password == $confirmPassword) {

//     include ('../connection.php');

// $queryName ="SELECT ID_user FROM users WHERE name='$username'";
// $resultName = mysqli_query($link, $queryName) or die("Ошибка " . mysqli_error($link));
// $rowName = mysqli_fetch_row($resultName);

// $queryEmail ="SELECT ID_user FROM users WHERE email='$email'";
// $resultEmail = mysqli_query($link, $queryEmail) or die("Ошибка " . mysqli_error($link));
// $rowEmail = mysqli_fetch_row($resultEmail);

//     if (!empty($rowName[0]))
//     {
//         echo "<script>alert('Такой логин уже существует'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//         mysqli_close($link);
//     }
//     elseif (!empty($rowEmail[0])) {
//         echo "<script>alert('Такой email уже существует'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//         mysqli_close($link);
//     }
//     else
//     {
//         $password=md5($password);

// $queryReg ="INSERT INTO users (name, email, password) VALUES('$username','$email', '$password')";
// $resultReg = mysqli_query($link, $queryReg) or die("Ошибка " . mysqli_error($link));

// $query ="SELECT ID_user, name, role FROM users WHERE name='$username'";
// $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

//     if ($resultReg)
//     {             
//         $row = mysqli_fetch_row($result);
//         $_SESSION['ID_user']=$row[0];
//         $_SESSION['username']=$row[1];
//         $_SESSION['role']=$row[2];

//         include('result_auth.php');
//     }
//     else {
//         echo "<script>alert('Ошибка, вы не зарегистрированы'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//         mysqli_close($link);
//         }   
//     }
// }
// else{
//     echo "<script>alert('Пароли не совпадают'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
//     mysqli_close($link);
// }

?>
