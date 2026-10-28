
<?php
        class Common
        {
                    public static function dataclean($dirty){
                        $clean = addslashes($dirty);
                        $clean = htmlentities($clean);
                        $clean = trim($clean);
                        return $clean;
                    }

                    public static function is_email($email){
                        $see = filter_var($email, FILTER_VALIDATE_EMAIL);

                        if ($see === false) {
                            return false;
                        }else{
                            return true;
                        }
                    }
        }

?>