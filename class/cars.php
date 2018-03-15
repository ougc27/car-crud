<?php
    error_reporting(E_ALL ^ E_NOTICE);
    require_once 'database.php';
    header("Content-type:application/json");
  	
	extract($_POST);

    try {
        $db = new Database(); 
        $db->connectDB();
        switch($action){
            case "create": 
				$db->executeQuery(
					"INSERT INTO car(name, model, color)
					VALUES('$name', '$model', '$color')");
				$data = $db->select("SELECT * FROM car");
        		echo json_encode($data);
			break;
				
            case "update": 
				$db->executeQuery(
					"UPDATE car
					 SET name = '$name', model = '$model', color = '$color'
					 WHERE id = '$id'");
				
				$data = $db->select("SELECT * FROM car");
        		echo json_encode($data);
            break;
				
			case "delete": 
				$db->executeQuery("DELETE FROM car WHERE od = '$id'");
				$data = $db->select("SELECT * FROM car");
        		echo json_encode($data);
			break;
			case "select":
				$data = $db->select("SELECT * FROM car");
        		echo json_encode($data);
			break;
        }

        $db->CloseDB();
       
    } catch(Exception $e){
        echo json_encode($e->getMessage());
    }
?>