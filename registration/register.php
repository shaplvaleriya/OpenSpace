<?php
if (session_id()=='');
    session_start();
if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }

if (isset($_POST['username'])) { $username=$_POST['username']; if ($username =='') { unset($username);} }

if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

if (isset($_POST['confirmPassword'])) { $confirmPassword=$_POST['confirmPassword']; if ($confirmPassword =='') { unset($confirmPassword);} }

function clean($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

$email = clean($email);
$username = clean($username);
$password = clean($password);
$confirmPassword = clean($confirmPassword);

if(empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
    echo "<script>;alert('Все поля должны быть заполнены'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>;";
    mysqli_close($link);
}
    elseif(!preg_match("~[a-zA-Z\d]{5,}~", $username)) {
        echo "<script>alert('Некорректный логин.'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
        mysqli_close($link);
    }
    elseif(!preg_match("~[a-zA-Z\d]{6,}~", $password)) {
        echo "<script>alert('Некорректный пароль.'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
        mysqli_close($link);
    }
    elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)) {
        echo "<script>alert('Некорректный E-mail.'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
        mysqli_close($link);
    }
    elseif ($password == $confirmPassword) {

    include ('../connection.php');

$queryName ="SELECT ID_user FROM users WHERE name='$username'";
$resultName = mysqli_query($link, $queryName) or die("Ошибка " . mysqli_error($link));
$rowName = mysqli_fetch_row($resultName);

$queryEmail ="SELECT ID_user FROM users WHERE email='$email'";
$resultEmail = mysqli_query($link, $queryEmail) or die("Ошибка " . mysqli_error($link));
$rowEmail = mysqli_fetch_row($resultEmail);

    if (!empty($rowName[0]))
    {
        echo "<script>alert('Такой логин уже существует'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
        mysqli_close($link);
    }
    elseif (!empty($rowEmail[0])) {
        echo "<script>alert('Такой email уже существует'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
        mysqli_close($link);
    }
    else
    {
        $password=md5($password);

$queryReg ="INSERT INTO users (name, email, password) VALUES('$username','$email', '$password')";
$resultReg = mysqli_query($link, $queryReg) or die("Ошибка " . mysqli_error($link));

$query ="SELECT ID_user, name, role FROM users WHERE name='$username'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    if ($resultReg)
    {             
        $row = mysqli_fetch_row($result);
        $_SESSION['ID_user']=$row[0];
        $_SESSION['username']=$row[1];
        $_SESSION['role']=$row[2];

        include('result_auth.php');
    }
    else {
        echo "<script>alert('Ошибка, вы не зарегистрированы'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
        mysqli_close($link);
        }   
    }
}
else{
    echo "<script>alert('Пароли не совпадают'); location.href='http://localhost:83/OpenSpace/registration/registration.php'; $('#registration').attr('checked', true);</script>";
    mysqli_close($link);
}

?>
