
<?php
    if(isset($_SESSION['error'])){
        ?>
             <p class="alert alert-danger"><?php echo $_SESSION['error']; ?></p>
        <?php  
        }
         unset($_SESSION['error']);
        if(isset($_SESSION['feedback'])){
        ?>
            <p class="alert alert-success"><?php echo $_SESSION['feedback'] ?></p>
        <?php
         }
            unset($_SESSION['feedback']);
  ?>
     

