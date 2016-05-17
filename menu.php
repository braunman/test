<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
</head>
<body>
<?php
session_start();

if ($_SESSION){
    $login = $_SESSION['login'];
    echo 'Вы вошли как - ' . $login;
    print "<br>
           <br>
           <form action=\"upload.html\" method=\"post\">
           <button type=\"submit\" name=\"upload\"> Загрузка файла </button>
           </form>
           <br>
           <form action=\"del.php\" method=\"post\">
           <button type=\"submit\" name=\"del\"> Удаление файла </button>
           </form>
           <br>
           <form method=\"post\">
           <button type=\"submit\" name=\"download\"> Скачать файл </button>
           </form>
           ";
    if (isset($_POST['download'])) {
        unlink($myrow['file_name']);
        $sql_del = "DELETE FROM `files` WHERE `user` =  '" . $login . "'";
        $result = mysql_query($sql_del, $db);
        echo "Файл удален";
        empty($_POST['del_but']);
        echo '<br><a href="menu.php">Вернутся в меню </a>';
    }
}
else{
    echo "Нужно войти как зарегестированый пользователь";
    print '<SCRIPT>
    someTimeout = 3000;
    window.setTimeout("document.location=\'index.php\';", someTimeout);
    </SCRIPT>';
}
?>
</body>
</html>