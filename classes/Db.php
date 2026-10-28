
<?php
require_once "Config.php";

class Db
{
        private $dbhost = DBHOST;
        private $dbname = DBNAME;
        private $dbuser = DBUSER;
        private $dbpass = DBPASS;
        
        

    public function connect(){
         //create dns 
            $dns = "mysql:host=$this->dbhost;dbname=$this->dbname;";
            
            //set option
            $option = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
        
            try{
               return new PDO ($dns, $this->dbuser, $this->dbpass, $option);
                
            }catch(PDOException $e){
                   // echo $e->getMessage();
                    return false;
            }
            catch(Exception $e){
                   // echo $e->getMessage();
                    return false;
            }
        }
}
?>