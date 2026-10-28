<?php
require_once "Config.php";

    class Db
    {

        private $dbhost = DBHOST;
          private $dbname = DBNAME;
          private $dbuser = DBUSER;
          private $dbpass = DBPASS;

          protected function connect(){
            $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $options = [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ];
            try{
                return new PDO($dsn,$this->dbuser,$this->dbpass,$options);
                echo "connected sucessfullly";
            }catch(PDOException $e){
               // return $e->getMessage();
               return false;
            }catch(Exception $e){
               //return $e->getMessage();
               return false;
            }
          }
        
    }
?>