<?php
    require_once "Db.php";
    class Admin extends Db{

        private $dbconn;

        public function __construct(){
            $this->dbconn = $this->connect();
        }

        public function get_all_users(){
            try{
                $sql = "SELECT u.*, r.name as role_name FROM users u LEFT JOIN roles r ON u.role_id = r.id";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $users;
            }catch(PDOException $e){
                return false;
            }
        }

         public function get_states(){
        try{
            $sql = "SELECT * FROM states";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $deets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $deets;
        }catch(PDOException $e){
            return false;
        }
    }

     public function fetch_local_govt_by_state($state_id){
        try{
            $sql = "SELECT * FROM lgas WHERE state_id = ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$state_id]);
            $deets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $deets;
        }catch(PDOException $e){
            return false;
        }
       
     }

    // public function get_lgas($state_id = null){
    //     try{
    //         $sql = "SELECT * FROM lgas";
    //         if($state_id){
    //             $sql .= " WHERE state_id = ?";
    //         }
    //         $stmt = $this->dbconn->prepare($sql);
    //         if($state_id){
    //             $stmt->execute([$state_id]);
    //         }else{
    //             $stmt->execute();
    //         }
    //         $deets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $deets;
    //     }catch(PDOException $e){
    //         return false;
    //     }
    // }

    public function admin_upload_property($pro_title, $pro_desc, $pro_price, $pro_size, $admin_id, $property_type_id, $listing_type_id, $lga_id, $state_id){
        try{
            $sql = "INSERT INTO properties (pro_title, pro_description, pro_price, pro_size, admin_id, property_type_id, listing_type_id, lga_id, state_id) VALUES(?,?,?,?,?,?,?,?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$pro_title, $pro_desc, $pro_price, $pro_size, $admin_id, $property_type_id, $listing_type_id, $lga_id, $state_id]);
            $res = $this->dbconn->lastInsertId();
            return $res;
        } catch(PDOException $e){
            echo $e->getMessage();die();
            return false;
        }   
    }

    public function fetch_property_images($property_id){
        $sql = "SELECT * FROM property_images WHERE property_id = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$property_id]);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $images;
    }

     public function admin_upload_images($property_id, $image_url){
        try{
            $sql = "INSERT INTO property_images (property_id, image_url) VALUES (?,?)";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$property_id, $image_url]);
            $res = $this->dbconn->lastInsertId();
            return $res;
        }catch(PDOException $e){
            echo $e->getMessage();die();
            return false;
        }
    }

        public function fetch_all_properties(){
        $sql = "SELECT p.*, pt.name as property_type_name, lt.name as listing_type_name, s.state_name, l.lga_name, u.user_firstname, u.user_lastname, GROUP_CONCAT(pi.image_url) as images
                FROM properties p
                LEFT JOIN property_types pt ON p.property_type_id = pt.id
                LEFT JOIN listing_types lt ON p.listing_type_id = lt.id
                LEFT JOIN lgas l ON p.lga_id = l.lga_id
                LEFT JOIN states s ON l.state_id = s.state_id
                LEFT JOIN users u ON p.user_id = u.user_id
                LEFT JOIN property_images pi ON p.pro_id = pi.property_id
                GROUP BY p.pro_id";

        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        $file = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $file;
    }

    public function fetch_properties_by_listing_type($listing_type_id){
        try{
            $sql = "SELECT p.*, pt.name as property_type_name, lt.name as listing_type_name, s.state_name, l.lga_name, u.user_firstname, u.user_lastname, GROUP_CONCAT(pi.image_url) as images
                    FROM properties p
                    LEFT JOIN property_types pt ON p.property_type_id = pt.id
                    LEFT JOIN listing_types lt ON p.listing_type_id = lt.id
                    LEFT JOIN lgas l ON p.lga_id = l.lga_id
                    LEFT JOIN states s ON l.state_id = s.state_id
                    LEFT JOIN users u ON p.user_id = u.user_id
                    LEFT JOIN property_images pi ON p.pro_id = pi.property_id
                    WHERE p.listing_type_id = ?
                    GROUP BY p.pro_id";

            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$listing_type_id]);
            $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $properties;
        }catch(PDOException $e){
            return false;
        }
    }

    public function get_property_types(){
        try{
            $sql = "SELECT * FROM property_types";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $deets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $deets;
        }catch(PDOException $e){
            return false;
        }
    }

    public function get_listing_types(){
        try{
            $sql = "SELECT * FROM listing_types";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $deets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $deets;
        }catch(PDOException $e){
            return false;
        }
    }

        public function update_user_status($user_id, $status){
            try{
                $sql = "UPDATE users SET status = ? WHERE user_id = ?";
                $stmt = $this->dbconn->prepare($sql);
                $result = $stmt->execute([$status, $user_id]);
                return $result;
            }catch(PDOException $e){
                return false;
            }
        }

        public function admin_logout(){
            unset($_SESSION['admin_online']);
            session_destroy();
        }

        public function  admin_login($email, $password){
            try{
                $sql = "SELECT * FROM admins WHERE admin_email=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$email]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                if($data){
                     $stored_password = $data['admin_password'];
                    $chk = password_verify($password, $stored_password);
                    if($chk){
                        return $data['admin_id'];// return the admin Id,
                    }else{
                        $_SESSION['admin_error'] = "Invalid Password";
                        return false;
                    }

                }else{
                        $_SESSION['admin_error'] = "Invalid Email";
                        return false;
                    }
               

            }catch(PDOException $e){
                //echo $e->getMessage(); die();
                return false;
            }

        }

        public function get_admin($admin_id){
            try{
                $sql = "SELECT * FROM admins WHERE admin_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$admin_id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }catch(PDOException $e){
                return false;
            }
        }
    }

    //    $prop = new Admin;
    //  $proimage = $prop->fetch_property_images("40");
    //    //$properties = $prop->fetch_property_images("1");
    //      echo "<pre>";
    //            print_r($proimage);
    //      echo "</pre>";