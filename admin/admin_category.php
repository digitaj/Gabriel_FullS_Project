<?php  
    session_start();
    require_once "admin_guard.php";
    require_once "partials/admin_header.php";
    require_once "classes/Admin.php";
   
    

    $admin = new Admin;
    $state_id = $_GET["state_id"] ?? null;
    $sta = $admin->get_states();
    $lgas = $admin->fetch_local_govt_by_state($state_id);
    $cat = $admin->get_listing_types();
    $type = $admin->get_property_types();
    
    
?>

    <!-- Main Content -->
   <main class="container-fluid form">
                <div class="row mt-3 pt-5 justify-content-center">
                    
                      <div class="col-md-6 card mt-2 form_1 offset-md-3">
                             <h2 class="text-center mt-5">Add Category</h2>
                               <?php
                                require_once "../partials/message.php";
                              ?>
                              <form action="process/process_admin_addcategory.php" method="post" class="card-body" enctype="multipart/form-data">
                                <div class="row g-3">
                                       <div class="col-sm-12">
                                            <label for="title" class="form-label">Properties Title</label>
                                            <input type="text" name="title" class="form-control" id="title" require>
                                        </div>

                                          <div class="col-sm-12">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control" id="price" require>         
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="Description" class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="size" class="form-label">Size</label>
                                            <input type="text" name="size" class="form-control" id="phone_number" require>
                                        </div>
                                   <div class="col-md-12">
                                        <label for="state" class="form-label text-muted small fw-bold">State</label>
                                        <select class="form-select form-control" name="state" id="state">
                                            <option value="">Select State</option>
                                            <?php
                                            foreach($sta as $state){
                                                ?>
                                                        <option value="<?php echo $state["state_id"]; ?>"><?php echo $state["state_name"]; ?></option>
                                                <?php
                                            }
                                            ?>  
                                        </select>
                                   </div>
                                   <div class="col-md-12">
                                        <label for="location" class="form-label text-muted small fw-bold">Location</label>
                                        <select class="form-select form-control" name="lga" id="lga">
                                            <option value="">Select LGA</option>
                                            <?php
                                            foreach($lgas as $lga){
                                                ?>
                                                        <option value="<?php echo $lga["lga_id"]; ?>" data-state="<?php echo $lga["state_id"]; ?>"><?php echo $lga["lga_name"]; ?></option>
                                                <?php
                                            }
                                            ?>  
                                        </select>
                                   </div>
                                     <div class="col-md-12">
                                        <label for="category" class="form-label text-muted small fw-bold">Listing Type</label>
                                        <select class="form-select form-control" name="category" id="category">
                                            <option value="">Select Listing Type</option>
                                            <?php
                                            foreach($cat as $cate){
                                                ?>
                                                        <option value="<?php echo $cate["id"]; ?>"><?php echo $cate["name"]; ?></option>
                                                <?php
                                            }
                                            ?>  
                                        </select>
                                   </div>
                               
                                        <div class="col-md-12">
                                        <label for="type" class="form-label text-muted small fw-bold">Property Type</label>
                                        <select class="form-select form-control" name="type" id="type">
                                            <option value="">Select Property Type</option>
                                            <?php
                                            foreach($type as $protype){
                                                ?>
                                                        <option value="<?php echo $protype["id"]; ?>"><?php echo $protype["name"]; ?></option>
                                                <?php
                                            }
                                            ?>  
                                        </select>
                                   </div>
                                        <div class="col-sm-12">
                                            <label for="upload" class="form-label">Upload Images</label>
                                            <input type="file" name="images[]" id="dp" accept="images/png, images/jpeg, images/jpg" multiple>  
                                        </div>
                                        <div class="col-12 mt-4">
                                        <div class="mb-3">
                                            <button name="btnupload" class="btn btn-success col-12">Upload</button>
                                        </div>
                                    </div>       
                               </form>
                         </div>
                </div>
        </main>

        
               <script src="assets/jquery.js"></script>
        <script>
            $(function(){
                $("#state").change(function(){
                    var selected = $(this).val();
                     
                    $("#lga").load("process/fetch_lgas.php?state_id=" +selected)
                })  

          })
        </script>

    <?php
        require_once "partials/admin_footer.php";
    ?>