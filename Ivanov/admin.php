<?php
        $username = "root";
        $password = "";
        $resp = array();
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        
            try {
                $dbcon = new PDO('mysql:host=localhost;dbname=Ivanov', $username, $password);
                $data = $dbcon->prepare('DELETE FROM `iva` WHERE id = :id');
                $data->execute(array('id' => $id));
        
                echo 'Строка под id = '.$id.' удалена';
            } catch (PDOException $e) {
                echo 'Error:'.$e->getMessage();
            }
        } else {
            $users = array();
        
            $dbcon = new PDO('mysql:host=localhost;dbname=Ivanov', $username, $password);
            $data = $dbcon->prepare('SELECT * FROM `iva`');
            $data->execute();
            $result = $data->fetchAll();
        
            if (count($result)) {
                foreach($result as $row) {
                    $users[] = $row;
                }
            }
        
            $resp['status'] = true;
            $resp['message'] = 'Ok';
            $resp['users'] = $users;
            echo json_encode($resp);
        }

?>