
<?php
   session_start();
   require_once "user_guard.php";
    require_once "partials/head.php";
   require_once "partials/navbar.php";
    require_once "classes/Property.php";

   $pro = new Property;
   $state_id = $_GET["state_id"] ?? null;
   $sta = $pro->get_states();
   $cat = $pro->get_listing_types();
   $type = $pro->get_property_types();
    if($state_id){
         $lgas = $pro->fetch_local_govt_by_state($state_id);
    } else {
         $lgas = [];
    }
    
?>


    
        <main class="container-fluid form">
                <div class="row mt-5 pt-5 justify-content-center align-items-center">
                     <div class="col-12 col-md-5 text-center mb-4 mb-md-0">
                         <img src="assets/img/img-removebg-preview.png" alt="Upload Properties" class="img-fluid w-100 login_img">
                    </div>
                      <div class="col-12 col-md-5 card mt-4 form_1">
                             <h2 class="text-center mt-5">Upload Properties</h2>
                             <?php
                                require_once "partials/message.php";
                              ?>
                              <form action="process/process_upload_properties.php" method="post" class="card-body" enctype="multipart/form-data">
                                <div class="row g-3">
                                       <div class="col-12">
                                            <label for="title" class="form-label">Properties Title</label>
                                            <input type="text" name="title" class="form-control" id="title" required>
                                        </div>

                                          <div class="col-12">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control" id="price" required>         
                                        </div>

                                        <div class="col-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="Description" class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="size" class="form-label">Size</label>
                                            <input type="text" name="size" class="form-control" id="size" required>
                                        </div>
                                   <div class="col-12">
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
                                   <div class="col-12">
                                        <label for="location" class="form-label text-muted small fw-bold">Location</label>
                                        <select class="form-select form-control" name="lga" id="lga">
                                            
                                            <?php
                                            foreach($lgas as $lga){
                                                ?>
                                                        <option value="<?php echo $lga["lga_id"]; ?>"><?php echo $lga["lga_name"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                   </div>
                                     <div class="col-12">
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
                               
                                        <div class="col-12">
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
                                        <div class="col-12">
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

                // document.addEventListener('DOMContentLoaded', function(){
                //     var stateSelect = document.getElementById('state');
                //     var lgaSelect = document.getElementById('lga');

                //     if(stateSelect && lgaSelect){
                //         stateSelect.addEventListener('change', function(){
                //             var selectedState = this.value;
                //             lgaSelect.value = '';
                //             Array.from(lgaSelect.options).forEach(function(option){
                //                 if(option.value === ''){
                //                     option.style.display = 'block';
                //                     return;
                //                 }
                //                 var optionState = option.getAttribute('data-state');
                //                 if(selectedState && optionState !== selectedState){
                //                     option.style.display = 'none';
                //                 } else {
                //                     option.style.display = 'block';
                //                 }
                //             });
                //         });
                //     }
                // });
        </script>

        <?php
            require_once "partials/footer.php";
        ?>