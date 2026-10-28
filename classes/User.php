<?php
require_once "Db.php";

class User extends Db
{
    private $dbconn;

    public function __construct()
    {
        $this->dbconn = $this->connect();
    }

    public function check_email($email){
        try{
            $sql = "SELECT * FROM users WHERE user_email = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$email]);
            $total = $stmt->rowCount();
            return $total;
        }catch(PDOException $e){
            echo $e->getMessage();die();
            return false;
        }
    }

    public function save_filename($filename, $userid) {
        try{
            $sql="UPDATE users SET profile_image=? WHERE user_id=?";
            $stmt=$this->dbconn->prepare($sql);
            $res=$stmt->execute([$filename, $userid]);
            return $res;
        }catch(PDOException $e) {
            return false;
        }
    }

    public function update_profile($fname, $lastname, $phone, $role_id, $userid){
        try{
            $sql = "UPDATE users SET user_firstname=?, user_lastname=?, user_phone=?, role_id=? WHERE user_id =?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$fname, $lastname, $phone, $role_id, $userid]);
            return true;
        }catch(PDOException $e){
            echo $e->getMessage(); die();
            return false;
        }
    }

    public function get_user($userid){
        try{
            $sql = "SELECT * FROM users WHERE user_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$userid]);
            $deets = $stmt->fetch(PDO::FETCH_ASSOC);
            return $deets;
        }catch(PDOException $e){
            return false;
        }
    }

    public function get_roles(){
        try{
            $sql = "SELECT * FROM roles";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $deets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $deets;
        }catch(PDOException $e){
            return false;
        }
    }

    public function logout(){
        unset($_SESSION['user_online']);
        session_destroy();
    }

    public function login($email,$password){
        try{
            $sql = "SELECT * FROM users WHERE user_email=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$email]);
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            if($record){ //email is correct
                $stored_password = $record["user_password"];
                $check = password_verify($password, $stored_password);//true or false
                if($check){// return the the user's id in session
                    return $record['user_id'];
                }else{
                    $_SESSION['error'] = "Incorrect password";
                    return false;
                }
            }else{// the email coming from the form does not exist on the db
                $_SESSION['error'] = "Incorrect email address";
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }

    public function register_user($firstname, $lastname, $email, $phonenumber, $password, $role_id = 4){
        try{
            $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_phone, user_password, role_id) 
                VALUES(?,?,?,?,?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$firstname, $lastname, $email, $phonenumber, $hash, $role_id]);
            $usr_id = $this->dbconn->lastInsertId();
            return $usr_id;
        }catch(PDOException $e){
            return false;
        }
    }
}