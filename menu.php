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
        $sql_select = "SELECT * FROM `files` WHERE user = '" . $login . "'";
        include ("bd.php");
        $result = mysql_query($sql_select, $db);
        $myrow = mysql_fetch_array($result);
        $file = $myrow['file_name'];
        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            empty($_POST['download']);
            exit;
        }
        else{
            echo "Вы не загрузили не одного файла";
        }
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