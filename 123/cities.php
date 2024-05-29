<?php
$response = array();
$dbUsername = "root";
$dbPassword = "";
if (isset($_GET["countryId"])) {
    $response["status"] = true;
    $response["message"] = "OK";

    try {
        //соединение с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=pr1', $dbUsername, $dbPassword);
        $data = $dbcon->prepare('SELECT * FROM `cities` WHERE country_id = :id');
        $data->execute(array("id" => $_GET["countryId"]));

        $result = $data->fetchAll();

        if (count($result)) {
            //выводим результат
            foreach ($result as $row) {
                $cities[] = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "population" => $row["population"],
                    "imgUrl" => $row["imgUrl"],
                    "lon" => $row["lon"],
                    "lat" => $row["lat"],
                    "country_id" => $row["country_id"]
                );
            }
        } else {
            echo "Нет записей для вывода";
        }

    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }

    $response["cities"] = $cities;
} else {
    $countries = array();
    try {
        //соединение с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=pr1', $dbUsername, $dbPassword);
        $data = $dbcon->prepare('SELECT * FROM `countries`');
        $data->execute();

        $result = $data->fetchAll();

        if (count($result)) {
            //выводим результат
            foreach ($result as $row) {
                $countries[] = $row["Name"];
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

