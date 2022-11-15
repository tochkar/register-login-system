<?php
function is_guest(){
    if(isset($_COOKIE['user']))
        if(!empty($_SESSION['user'])){
            return false;
        }
    return true;
}
?>

<?php if(is_guest()):?>
    <div id="cl3" style="display:">
        <button onclick="(document.getElementById('cl1').style.display=='') ? console.log('Определённый контент уже скрыт') : document.getElementById('cl1').style.display=''; document.getElementById('cl3').style.display='none'">Регистрация</button>

        <button onclick="(document.getElementById('cl2').style.display=='') ? console.log('Определённый контент уже скрыт') : document.getElementById('cl2').style.display=''; document.getElementById('cl3').style.display='none'">Авторизация</button>
    </div>
<?php else:?>
    <a> Добро пожаловать</a>
    <br>
    <a href="logout_autoriz.php">Logout</a>
<?php endif;?>


<html>
<head>
    <meta charset="utf-8">
    <title>Код</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="script.js"></script>
</head>
<body>
<div id="cl1" style="display: none" >

    <form> <!-- форма регистрации с якорями для ошибок из Ajax-->
        <input type='text' size='20' id='login' placeholder="Введите логин"><a id="res1"></a>
        <br>
        <input type='password' size='20' maxlength='20' id='password' placeholder="Введите пароль"><a id="res2"></a>
        <br>
        <input type='password' size='20' maxlength='20' id='password2' placeholder="Повторите пароль"><a id="res3"></a>
        <br>
        <input type='text' size='20' id='email' placeholder="Введите Email"><a id="res4"></a>
        <br>
        <input type='text' size='20' id='name' placeholder="Введите имя"><a id="res5"></a>
        <br>
        <input type='button' value='Зарегистрироваться' id='submit_registration' >
        <br>
    </form>
</div>

<div id="cl2" style="display: none" >
    <form> <!-- форма авторизации с якорями для ошибок из Ajax-->

        <input type='text' required="required" size='20' id='login1' placeholder="Введите логин"><a id="res11"></a>
        <br>
        <input type='password' required="required" size='20' maxlength='20' id='password1' placeholder="Введите пароль"><a id="res12"></a>
        <br>
        <input type='button' value='Авторизоваться' id='submit_enter' >
        <br>
    </form>
</div>
</body>
</html>