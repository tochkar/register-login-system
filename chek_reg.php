<?php
include("DB_function.php");

$error_msg = 0;

if(empty($_POST['login'])){
    echo '<br><div id="111"><font id="111" color="red"> Введите логин! </font></div>';
    $error_msg++;
}
if(!preg_match("/^\w{3,}$/", $_POST['login'])){
    echo '<br><div id="112"><font id="112" color="red"> В поле "Логин" введены недопустимые символы! Только буквы, цифры и подчеркивание!</font></div>';
    $error_msg++;
}
if(empty($_POST['password'])){
    echo '<br><div id="113"><font id="113" color="red">Введите пароль!</font></div>';
    $error_msg++;
}
if(!preg_match("/\A(\w){6,20}\Z/", $_POST['password'])) {
    echo '<br><div id="114"><font id="114" color="red">Пароль слишком короткий! Пароль должен быть не менее 6 символов! </font></div>';
    $error_msg++;
}
if(empty($_POST['password2'])) {
    echo '<br><div id="115"><font id="115" color="red">Введите подтверждение пароля!</font></div>';
    $error_msg++;
}
if($_POST['password'] != $_POST['password2']) {
    echo '<br><div id="116"><font id="116" color="red">Введенные пароли не совпадают!</font></div>';
    $error_msg++;
}
if(empty($_POST['email'])) {
    echo '<br><div id="117"><font id="117" color="red">Введите E-mail! </font></div>';
    $error_msg++;
}
if(!preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $_POST['email'])) {
    echo '<br><div id="118"><font id="118" color="red">E-mail имеет недопустимий формат! Например, name@gmail.com! </font></div>';
    $error_msg++;
}
if(empty($_POST['name'])) {
    echo '<br><div id="119"><font color="red"> Введите Имя! </font></div>';
    $error_msg++;
}

$login = $_POST['login'];
$password = $_POST['password'];
$md5password = md5($password);
$password2 = $_POST['password2'];
$email = $_POST['email'];
$name = $_POST['name'];
$id = md5($login);

if($error_msg == 0) {
    $user = new dbUsers($id, $login, $email, $md5password, $name);
    $checkLogin = $user->checkLoginForRegistration($login);
    $checkEmail = $user->checkEmailForRegistration($email);

    //$errorMsg2 = 0;
    if($checkLogin > 0){
        echo '<div id="120"><font color="red">Пользователь с таким логином уже зарегистрирован</font></div>';
        //$errorMsg2 = 1;
    }
    elseif ($checkEmail > 0) {
        echo '<div id="121"><font color="red">Пользователь с таким e-mail уже зарегистрирован</font></div>';
        //$errorMsg2 = 2;
        }
    else {
            if($user->CheckDB() > 0){
                $user->addNewwUser($id, $login, $email, $md5password, $name);
            }
            else {
                $user->CreateNewUserInClinDB($id, $login, $email, $md5password, $name);
            }
            echo '5';
        }
}


