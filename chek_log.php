<?php
include("DB_function.php");

$error_msg = 0;

if(empty($_POST['login'])){
    echo '<br><div id="130"><font color="red"> Введите логин! </font></div>';
    $error_msg++;
}
if(empty($_POST['password'])){
    echo '<br><div id="140"><font color="red">Введите пароль!</font></div>';
    $error_msg++;
}

$login = $_POST['login'];
$password = $_POST['password'];
$md5password = md5($password);

if($error_msg == 0) {
    $user = new dbUsers($login, $md5password);
    $newUser = $user->checkUserForAutorization($login, $md5password);

    if($newUser == 0){
        echo '<div id="131"><font color="red">Пользователь с таким логином не найден!</font></div>';
    }
    elseif ($newUser == 1){
        echo '<div id="141"><font color="red">Неверный пароль!</font></div>';
        }
    elseif ($newUser == 2){
        echo "1";
    }

}
function is_guest(){
    if(isset($_COOKIE['user']))
        if(!empty($_SESSION['user'])){
            return false;
        }
    return true;
}


