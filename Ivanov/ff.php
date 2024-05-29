<?php

echo "jdfvvjfsjvsvjvs";

    $response = array();
    $dbUsername = "root";
    $dbPassword = "";

if (isset($_GET["id"])) {
    $response["status"] = true;
    $response["message"] = "OK";

    $countries = array();
    
    try {
        //соединение с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=countries', $dbUsername, $dbPassword);
        $data = $dbcon->prepare('SELECT * FROM `countries`');
        $data->execute();
        

        $result = $data->fetchAll();

        if (count($result)) {
            //выводим результат
            foreach ($result as $row) {
                $countries[] = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "population" => $row["population"],
                    "imgUrl" => $row["imgUrl"],
                    "square" => $row["square"],
                    "capital" => $row["capital"],
                    "yearOfFoun" => $row["yearOfFoun"]
                );
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
} else {
    
}

echo json_encode($response);
?>