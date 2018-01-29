<?php 
    class Database {
        private $PDOLocal;
        private $server = "mysql:host=localhost;dbname=cars_crud";
        private $user = "root";
        private $pass = "";

        function connectDB(){
            try {
                $this->PDOLocal = new PDO($this->server,$this->user,$this->pass);
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function executeQuery($Query){
            try {
                $res = $this->PDOLocal->query($Query);
            } catch(PDOException $e){
                echo $e->getMessage();
            }    
        }
        function select($Query){
            try{
                $res = $this->PDOLocal->query($Query);
				$no_row=$res->rowCount();
				if($no_row > 0){
					while($Row = $res->fetch(PDO::FETCH_ASSOC)){
						$Data[] = $Row;
					}
				}else{
					$Data[] = null;
				}
                return $Data;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        function CloseDB()
        {
            try {
                $this->PDOLocal = NULL;
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>