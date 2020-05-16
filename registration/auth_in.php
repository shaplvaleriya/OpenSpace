<?php
if (session_id()=='');
    session_start();

include ('../connection.php');
if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } 
if (isset($_POST['password'])) { $pass=$_POST['password']; if ($password =='') { unset($password);} }

function clean($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

$username = clean($username);
$password = clean($password);


$query ="SELECT ID_user, name, password, role FROM users WHERE name='$username'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$row = mysqli_fetch_row($result);


if (empty($row[1]))
    {
        echo "<script>alert('Введенный вами логин неверный'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#authorization').attr('checked', true);</script>";
        mysqli_close($link);
    }
   else {
        if ($row[2]==md5($password)) {
        $_SESSION['ID_user']=$row[0];
        $_SESSION['username']=$row[1];
        $_SESSION['role']=$row[3];

if ($row[3]=='admin') {
    echo "<script>location.href='http://localhost:83/OpenSpace/adminPanel/filmList/filmList.php';</script>";
        mysqli_close($link);
}
elseif ($row[3]=='cashier') {
      echo "<script>location.href='http://localhost:83/OpenSpace/cashierPanel/cashierBought/cashierBought.php';</script>";
        mysqli_close($link);
    }
else
{
    include('result_auth.php');
}
    }

         else {
        echo "<script>alert('Введенный вами пароль неверный'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#authorization').attr('checked', true);</script>";
        mysqli_close($link);
        }
    }
?>


