<?php
    if(isset($_SESSION['admin_error'])){
        ?>
             <p class="alert alert-danger"><?php echo $_SESSION['admin_error']; ?></p>
        <?php  
        }
         unset($_SESSION['admin_error']);
        if(isset($_SESSION['admin_feedback'])){
        ?>
            <p class="alert alert-success"><?php echo $_SESSION['admin_feedback'] ?></p>
        <?php
         }
            unset($_SESSION['admin_feedback']);
        ?>
     

