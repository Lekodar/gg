<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
$response = array();
$dbUsername = "root";
$dbPassword = "";
if (isset($_GET["countryId"])) {
    $response["status"] = true;
    $response["message"] = "OK";
    try {
        // Соединени с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=pr1', $dbUsername, $dbPassword);
        $data->execute(array("id" => $_GET["countryId"]));

    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
} else {
    $countries = array();
    try {
        // Соединени с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=pr1', $dbUsername, $dbPassword);
        $data = $dbcon->prepare('SELECT * FROM `countries`');
        $data->execute();

        $result = $data->fetchAll();
        if (count($result)) {
            foreach ($result as $row) {
                $countries[] = $row;
            }
        } else {
            echo "Нет записей для вывода";
        }
    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
    $response["status"] = true;
    $response["message"] = "OK";
    $response["countries"] = $countries;        
}
echo json_encode($response);