<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
$response = array();
$dbUsername = "root";
$dbPassword = "";
if (isset($_GET["ActorId"])) {
    $response["status"] = true;
    $response["message"] = "OK";
    try {
        // Соединени с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=pr2', $dbUsername, $dbPassword);
        $data = $dbcon->prepare('SELECT * FROM `country` WHERE actor_id = :id');
        $data->execute(array("id" => $_GET["ActorId"]));

        $result = $data->fetchAll();
        if (count($result)) {
            //выводим результат
            foreach ($result as $row) {
                $Films[] = array(
                    "id" => $row["id"],
                    "Name" => $row["Name"],
                    "Released" => $row["Released"],
                    "Genre" => $row["Genre"],
                    "imgUrl" => $row["imgUrl"]
                );
            }
        } else {
            echo "Нет записей для вывода";
        }
    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }

    $response['Films'] = $Films;
} else {
    $Actors = array();
    try {
        // Соединени с БД
        $dbcon = new PDO('mysql:host=localhost;dbname=pr2', $dbUsername, $dbPassword);
        $data = $dbcon->prepare('SELECT * FROM `presidents`');
        $data->execute();

        $result = $data->fetchAll();
        if (count($result)) {
            foreach ($result as $row) {
                $Actors[] = $row;
            }
        } else {
            echo "Нет записей для вывода";
        }
    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
    $response["status"] = true;
    $response["message"] = "OK";
    $response["Actors"] = $Actors;        
}
echo json_encode($response);