<?php  
    session_start();
    require_once "admin_guard.php";
    require_once "partials/admin_header.php";
    require_once "classes/Admin.php";

    $admin = new Admin;
    $properties = $admin->fetch_all_properties();
//     $property_id = $property['pro_id'];
//     $propertyimges = $admin->fetch_property_images($property_id);

//      $first_image = '';
//       echo "<pre>";
//    print_r($proimage);
//    echo "</pre>";
//     if (!empty($propertyimges) && isset($propertyimges[0]['image_url'])) {
//         $first_image = trim($propertyimges[0]['image_url']);
//     }
    
?>

    <!-- Main Content -->
    <main class="main-content">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 m-0 small">
                <li class="breadcrumb-item"><a href="index.html" class="text-decoration-none text-muted">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Properties</li>
            </ol>
        </nav>

        <!-- Top Header for Mobile & Desktop -->
        <header
            class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded glass-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h4 class="m-0 fw-bold text-secondary">Properties Overview</h4>
               
            </div>
            

            <!-- <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal"
                    data-bs-target="#addUserModal">
                    <i class="bi bi-plus-lg"></i> Add User
                </button>
            </div> -->
        </header>
          <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0" id="feedback"></p>
            </div>

        <?php
                // echo "<pre>";
                // print_r($properties);
                // echo "</pre>";
        ?>
        <!-- Users Table -->
        <div class="card border-0 shadow-sm glass-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 custom-table">
                        <thead class="bg-light">
                            <tr>
                                 <th>S/N</th>
                                <th>Property name</th>
                                <th>Property Price</th>
                                <th>Property Status</th>
                                <th>Property Date Added</th>
                                <th>Property Type</th>
                                <th>Listing Type</th>
                                <th>User Added Property</th>
                                <th>location</th>
                                 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                   $sn=1;
                                   foreach($properties as $property) {
                                    
                                ?>
                                      <!-- Sample Row 1 -->
                            <tr>
                               <td><?php echo $sn++; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['pro_title']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                                
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['pro_price']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['pro_status']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['created_at']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['property_type_name']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['listing_type_name']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                                
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['user_firstname'].' '.$property['user_lastname']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                                
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo $property['state_name']." ".$property['lga_name']; ?></div>
                                       
                                        </div>
                                    </div>
                                </td>
                            </tr>  
                                <?php
                                   }
                            ?>
                                                   
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </main>

    <?php
        require_once "partials/admin_footer.php";
    ?>