<?php
session_start();
$login = $_SESSION['login'];
$sql_select = "SELECT * FROM `files` WHERE user = '" . $login . "'";
include("bd.php");
$result = mysql_query($sql_select, $db);
$myrow = mysql_fetch_array($result);
//echo count($myrow);
print "<br>Вы вошли как -  {$login}";
if (count($myrow) != 1) {
    print "
<br>Вы загрузили файл {$myrow['file_name']} в {$myrow['file_time']}<br><br>
После нажатия кнопки удалить файл удаляется безвозвратно
<form method='POST'>
<input type='submit' name='del_but' value='Удалить'>
</form>";
} else {
    print "<br>Ни один файл не был загружен";
}


if (isset($_POST['del_but'])) {

    unlink($myrow['file_name']);
    $sql_del = "DELETE FROM `files` WHERE `user` =  '" . $login . "'";
    $result = mysql_query($sql_del, $db);
    echo "Файл удален";
    empty($_POST['del_but']);
    echo '<br><a href="menu.php">Вернутся в меню </a>';
}
?>