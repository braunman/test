<html>
<head>
    <title>Результат загрузки файла</title>
</head>
<body>
<?php
session_start();
if ($_FILES["filename"]["size"] > 1024 * 3 * 1024) {
    echo("Размер файла превышает три мегабайта");
    exit;
    }
// Проверяем загружен ли файл
if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
    $dir_path = './files/' . $_SESSION['login'];
    $file_path = $dir_path."/".$_FILES["filename"]["name"];
    $login = $_SESSION['login'];
    if (file_exists($dir_path) == FALSE) {
        $dir_created = mkdir($dir_path);
        if ($dir_created == 'FALSE') {
            exit('НЕ ВОЗМОЖНО СОЗДАТЬ ДИРЕКТОРИЮ' . $dir_path);
        }
    }
    if (file_exists($file_path) == False) {
        include("bd.php");
        move_uploaded_file($_FILES["filename"]["tmp_name"], $file_path);
        $date = date("d-m-Y H:i:s");
        $sql_req = "INSERT INTO `files`(`user`, `file_name`, `file_time`) VALUES ('$login','$file_path','$date')";
        $result = mysql_query($sql_req, $db);
        if ($result == 'TRUE') {
            echo "Файл загружен";
            print '<SCRIPT>
                   someTimeout = 3000; // редирект через 4 секунды
                   window.setTimeout("document.location=\'menu.php\';", someTimeout);
                   </SCRIPT>';
        } else {
            exit("Ошибка! Файл НЕ загружен.");
        }
    }
    else{echo 'Такой файл уже существует, если у вас новый файл то удалите старый';}
} else {
    echo("Ошибка загрузки файла");
}
?>
</body>
</html>