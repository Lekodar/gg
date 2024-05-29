<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];
$sender = $_POST['sender'];
$sogl = $_POST['sogl'];

$dbUsername = 'root';
$dbPassword = '';

if (is_string($name) && is_string($message)) {
    if (strlen($phone) == 11 && isset($sender)) {
        if (isset($email)) {
            try {
                $dbcon = new PDO('mysql:host=localhost;dbname=Ivanov', $dbUsername, $dbPassword);
            } catch (PDOException $e) {
                die("Ошибка" . $e->getMessage());
            }
            $sql = "INSERT INTO iva (name, phone, email, message, sender, sogl) VALUES (:name, :phone, :email, :message, :sender, :sogl)";
            $stmt = $dbcon->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':sender', $sender);
            $stmt->bindParam(':sogl', $sogl);

            try {
                $stmt->execute();
                echo "Запрос отправлен";
            }catch (PDOException $e) {
                echo 'Запрос не отправлен' . $e->getMessage()."\n";
                echo $sql;
            }
        }else {
            echo "Не введен Email";
        }
    }else {
        echo "Не введён город или телефон";
    }
}else {
    echo "Не верно записанно имя или сообщение";
} 
