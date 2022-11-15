<?php
class dbUsers
{
public $login;
public $email;
public $md5password;
public $name;
public $id;

    function checkUserForAutorization($login, $md5password)
    {
        $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $dom->load("file.xml"); // Загружаем XML-документ из файла в объект DOM
        $users = $dom->documentElement; // Получаем корневой элемент
        $childs = $users->childNodes; // Получаем дочерние элементы у корневого элемента
        /* Перебираем полученные элементы */
        for ($i = 0; $i < $childs->length; $i++) {
            $user = $childs->item($i); // Получаем следующий элемент из NodeList
            $lp = $user->childNodes; // Получаем дочерние элементы у узла "user"
            $loginDb = $lp->item(1)->nodeValue; // Получаем значение узла "login"
            $md5passwordDb = $lp->item(3)->nodeValue; // Получаем значение узла "password"
            $name = $lp->item(4)->nodeValue; // Получаем значение узла "name"
            if ($loginDb == $login) {
                if ($md5passwordDb == $md5password) {
                    return 2; //пароль и логин верны можно куку и сессию создать
                } else {
                    return 1; // логин верен пароль нет
                }
            } elseif($i == $childs->length -1) {
                return 0; // такого логина не существует
            }
        }
    }

    function checkLoginForRegistration($login)
    {
        $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $dom->load("file.xml"); // Загружаем XML-документ из файла в объект DOM
        $root = $dom->documentElement; // Получаем корневой элемент
        $childs = $root->childNodes; // Получаем дочерние элементы у корневого элемента
        /* Перебираем полученные элементы */
        for ($i = 0; $i < $childs->length; $i++) {
            $user = $childs->item($i); // Получаем следующий элемент из NodeList
            $lp = $user->childNodes; // Получаем дочерние элементы у узла "user"
            $loginDb = $lp->item(1)->nodeValue; // Получаем значение узла "login"
            if ($loginDb == $login) {
                return 1; //такой логин уже существует
            }
            elseif($i == $childs->length -1) {
                return 0; // такого логина не существует
            } //пользователя с таким логином нет
        }
    }

    function checkEmailForRegistration($email)
    {
        $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $dom->load("file.xml"); // Загружаем XML-документ из файла в объект DOM
        $root = $dom->documentElement; // Получаем корневой элемент
        $childs = $root->childNodes; // Получаем дочерние элементы у корневого элемента
        /* Перебираем полученные элементы */
        for ($i = 0; $i < $childs->length; $i++) {
            $user = $childs->item($i); // Получаем следующий элемент из NodeList
            $lp = $user->childNodes; // Получаем дочерние элементы у узла "user"
            $emailDb = $lp->item(2)->nodeValue; // Получаем значение узла "email"
            if ($emailDb == $email) {
                return 1; // пользователя с такой почтой уже существует
                }
            elseif($i == $childs->length -1) {
                return 0; // такого логина не существует
            }
        }
    }

    function CheckDB(){ //проверка наличия узла(тега)в файле = проверка на наличие зарегистрированных пользователей
        $dom = new domDocument(); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $dom->load('file.xml');

        $tag = $dom->getElementsByTagName('login')->item(0);
        if ($tag != '') {
            return 1; // База не пуста
        } else {
            return 0; //База пуста
        }
    }
    //переменную $dom = new domDocument можно вынести в переменные класса чтоб не дублировать и передавать ее в функции
    function CreateNewUserInClinDB($id, $login, $email, $md5password, $name){ //создание файла если он пустой в логин и пароль добавлять введенные
        $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $root = $dom->createElement("users"); // Создаём корневой элемент
        $dom->appendChild($root);
        $user = $dom->createElement("user"); // Создаём узел "user"
        $id = $dom->createElement("id", $id); // Создаём узел "id" с данными внутри
        $login = $dom->createElement("login", $login); // Создаём узел "login" с данными внутри
        $email = $dom->createElement("email", $email); // Создаём узел "email" с данными внутри
        $password = $dom->createElement("password", $md5password); // Создаём узел "password" с данными внутрии
        $name = $dom->createElement("name", $name); // Создаём узел "name" с данными внутри
        $user->appendChild($id); // Добавляем в узел "user" узел "id"
        $user->appendChild($login); // Добавляем в узел "user" узел "login"
        $user->appendChild($email);// Добавляем в узел "user" узел "email"
        $user->appendChild($md5password);// Добавляем в узел "user" узел "password"
        $user->appendChild($name);// Добавляем в узел "user" узел "name"
        $root->appendChild($user); // Добавляем в корневой узел "users" узел "user"
        $dom->save("file.xml"); // Сохраняем полученный XML-документ в файл
    }

    function addNewUser($id, $login, $email, $md5password, $name){ //добавляем запись в начало файла
        $dom = new domDocument("1.0", "utf-8"); // Создаём объект XML-документ версии 1.0 с кодировкой utf-8
        $dom->load("file.xml");

        $xpath = new DOMXPath ($dom);
        $root = $xpath->query ('//users');
        $next = $xpath->query ('//users/user');
        $new_user = $dom->createElement ('user');
        $new_id = $dom->createElement ('id', $id);
        $new_login = $dom->createElement ('login', $login);
        $new_email = $dom->createElement ('email', $email);
        $new_password = $dom->createElement ('password', $md5password);
        $new_name = $dom->createElement ('name', $name);
        $new_user->appendChild ($new_id);
        $new_user->appendChild ($new_login);
        $new_user->appendChild ($new_email);
        $new_user->appendChild ($new_password);
        $new_user->appendChild ($new_name);
        $root->item(0)->insertBefore($new_user, $next->item(0));
        $dom->save("file.xml");
    }

    }