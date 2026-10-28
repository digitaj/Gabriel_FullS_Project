<?php
     session_start();
     require_once "user_guard.php";
    require_once "partials/navbar.php";
    require_once "partials/head.php";
    require_once "classes/User.php";
    require_once "classes/Property.php";

    $us = new User;
    $prop = new Property;
    $userdeets = $us->get_user($_SESSION["user_online"]);
    $roles = $us->get_roles();
    //$myProperties = $prop->fetch_properties_by_user($_SESSION['user_online']);
?>
        
    <section class="min-vh-100 d-flex align-items-center position-relative py-5 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Profile Header & Settings -->
                    <div class="glass-card p-4 p-md-5 mb-5">
                        <div class="text-center mb-5">
                            <div class="mb-3">
                                <div class="rounded-circle overflow-hidden bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width: 120px; height: 120px;">
<?php
    if(!$userdeets['profile_image']){
?>
                                    <i class="bi bi-person-fill display-3 text-muted"></i>
                                    <!-- Placeholder for user uploaded image -->
<?php
    }else{
?>
        <img src="<?php echo $userdeets['profile_image']; ?>" class="w-100 h-100 object-fit-cover" alt="Profile"> 
<?php
    }
?>
                              <!-- <img src="..." class="w-100 h-100 object-fit-cover" alt="Profile"> -->
                                </div>
                                <div class="d-flex justify-content-center">
                                    <form action="" enctype="multipart/form-data" id="profile_photo">
                                           <input type="file" class="form-control w-auto" id="profileImage" name="pix" accept="image/*">
                                    </form>
                                </div>
                            </div>
                            <h2 class="fw-bold">Edit Profile</h2>
                                 <p id="feedback"></p>
                        </div>

                        <form id="profileForm">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="firstName" class="form-label text-muted small fw-bold">First
                                        Name</label>
                                    <input type="text" name="firstname" class="form-control" id="firstName" value="<?php echo $userdeets["user_firstname"];  ?>">
                                </div>
                                <div class="col-md-12">
                                    <label for="lastName" class="form-label text-muted small fw-bold">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" id="lastName" value="<?php echo $userdeets["user_lastname"];  ?>">
                                </div>
                                 <div class="col-md-12">
                                    <label for="phoneNumber" class="form-label text-muted small fw-bold">Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control" id="phoneNumber" value="<?php echo $userdeets["user_phone"];  ?>">
                                </div>
                                 <div class="col-md-12">
                                    <label for="location" class="form-label text-muted small fw-bold">Role</label>
                                     <select class="form-select form-control" name="type" id="category">
                                        <option value="">Select Role</option>
                                        <?php
                                           foreach($roles as $role){
                                            ?>
                                                    <option value="<?php echo $role["id"]; ?>" <?php if($userdeets['role_id'] == $role['id']){echo 'selected';} ?>><?php echo $role["name"]; ?></option>
                                            <?php
                                           }
                                         ?>  
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label text-muted small fw-bold">Email Address</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $userdeets["user_email"];  ?>"
                                        disabled>
                                </div>

                               
                                <div class="col-12 text-end">
                                    <button id="btnprofile" name="btnprofile" class="btn btn-success px-4">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- 
    <section class="container-fluid py-5">
        <div class="container">
            <h2 class="mb-4">My Properties</h2>
            <div class="row">
                <?php if (!empty($myProperties)) {
                    foreach ($myProperties as $property) {
                        $propImages = $prop->fetch_property_images($property['pro_id']);
                        $first_image = !empty($propImages) && isset($propImages[0]['image_url']) ? trim($propImages[0]['image_url']) : '';
                        $display_image = (!empty($first_image) && file_exists('uploads/' . $first_image)) ? $first_image : 'img/homes.jfif';
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="uploads/<?php echo htmlspecialchars($display_image); ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="Property">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($property['pro_title']); ?></h5>
                            <p class="mb-1">&#8358; <?php echo number_format($property['pro_price']); ?></p>
                            <p class="mb-1"><?php echo htmlspecialchars($property['pro_size']); ?></p>
                            <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <?php }
                } else { ?>
                    <div class="col-12">
                        <div class="alert alert-warning">No properties uploaded yet.</div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section> -->

    <?php
        require_once "partials/footer.php";
    ?>
    <script src="assets/jquery.js"></script>
    <script>
        $(document).ready(function(){
            $("#btnprofile").click(function(event){

                event.preventDefault();
                let forms = document.getElementById('profileForm');// give id=profileform to your form
                let formdata = new FormData(forms);
                $.ajax({
                    url: "process/process_profile.php",
                    type: "POST",
                    data:formdata,
                    dataType:"json",
                    beforeSend:function(){
                        $("#btnprofile").html("Please wait...");
                    },
                    success:function(rsp){
                        $("#feedback").html(rsp.message);
                         $("#feedback").removeClass('alert alert-success alert-danger');
                        if(rsp.status){
                            $("#feedback").addClass('alert alert-success');
                        }else{
                            $("#feedback").addClass('alert alert-danger');
                        }
                    },
                    complete:function(){},
                    error:function(err){console.log(err)},
                    cache:false,
                    processData:false,
                    contentType:false,
                })
            });


            // we will add the file upload ajax
            $("#profileImage").change(function(){
                let photo = document.getElementById('profile_photo');
                let photodata = new FormData(photo);
                // make ajax call 
                $.ajax({
                    url:"process/process_upload.php",
                    type:"post",
                    data:photodata,
                    dataType:"json",
                    success:function(serverRsp){
                       $("#feedback").html(" ").removeClass("alert alert-danger");
                       if(serverRsp.status==true){
                            $(".rounded-circle").html("<img src ='" + serverRsp.message+"'>");
                            $("#profileImage").val("")
                       }else{
                            $("#feedback").html(serverRsp.message).addClass('alert alert-danger');
                       }
                       console.log(serverRsp);
                    },
                    error:function(err){console.log(err)}
                });
            });
        })
    </script>