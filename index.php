<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
?>
<html>
<head>
    <title>Главная страница</title>
</head>
<body>
<h2>Главная страница</h2>
<?php
// Проверяем, пусты ли переменные логина и id пользователя
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    print '
    <form action="testreg.php" method="post">
    <p>
    <label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>
    <p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
    <p>
    <input type="submit" name="submit" value="Войти">
    <br>
    <a href="reg.php">Зарегистрироваться</a> 
    </p></form>
    <br>
    ';
} else {

    // Если не пусты, то мы выводим ссылку
    echo "Вы вошли на сайт, как " . $_SESSION['login'] . ".<br>Поздравляю!<br><a href='menu.php'>Эта ссылка доступна только зарегистрированным пользователям</a>";
    print '<SCRIPT>
    someTimeout = 4000; // редирект через 4 секунды
    window.setTimeout("document.location=\'menu.php\';", someTimeout);
    </SCRIPT>';
}
?>
</body>
</html>