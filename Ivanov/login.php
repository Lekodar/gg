<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $password = $_POST['pas'];

    // Проверка логина и пароля в базе данных
    // Шифрование пароля для сохранения в базе данных
    // Проверка пароля с помощью password_verify 

    // Пример:
    $storedPassword = password_hash("1234", PASSWORD_DEFAULT);

    if(password_verify($password, $storedPassword) && $username == "Ad") {
        $_SESSION['username'] = $username;
        header('Location: admin.html');
        exit();
    } else {
        echo "Неверный логин или пароль";
    }
}
?>