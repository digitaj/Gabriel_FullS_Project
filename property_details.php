 <?php
    session_start();
    require_once "partials/head.php";
    require_once "partials/navbar.php";
    require_once "classes/Property.php";
    
    $prop = new Property;
    
    $property_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $property = $prop->fetch_property_by_id($property_id);
    
    // if (!$property) {
    //     // Property not found, redirect or show error
    //     header("location: index.php");
    //     exit();
    // }
    
      //  echo "<pre>";
      //  print_r($property);
      //  echo "</pre>";

    // Fetch all images for the property
    $propertyImages = $prop->fetch_property_images($property_id);
    
    // Set image variables for carousel
    $image1 = $image2 = $image3 = 'img/homes.jfif'; // default
    if (!empty($propertyImages)) {
        $image1 = $propertyImages[0]['image_url'];
       
        if (isset($propertyImages[1])) {
            $image2 = $propertyImages[1]['image_url'];
        }
       
        if (isset($propertyImages[2])) {
            $image3 = $propertyImages[2]['image_url'];
        }
    }

?>


 <main class="container-fluid first_p pt-3 mt-5">
                 <div class="row">
                       <div class="col-md-12 mt-5 text-center">
                              <h1>Property Details</h1>
                       </div>
                 </div>
                 <div class="row">
                      <div class="col-md-10 offset-md-1">
                              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <img src="<?php echo $image1; ?>" class="d-block w-100" alt="...">
                                      </div>
                                      <div class="carousel-item">
                                        <img src="<?php echo $image2; ?>" class="d-block w-100" alt="...">
                                      </div>
                                      <div class="carousel-item">
                                        <img src="<?php echo $image3; ?>" class="d-block w-100" alt="...">
                                      </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="visually-hidden">Next</span>
                                    </button>
                                  </div>
                      </div>
                 </div>
      
              <div class="row">
                    <div class="col-md-6 offset-md-1 mt-5">
                                 <h3 class="text-center"><?php echo htmlspecialchars($property['pro_title']); ?></h3>
                                 <p class="text-center mt-5"><?php echo htmlspecialchars($property['pro_description']);  ?></p>  
                                 
                                   <div class="row iterms justify-content-center">
                                             <div class="card justify-content-center mt-5" style="width: 25rem;">
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Price: &#8358; <?php echo number_format($property['pro_price']); ?></strong></li>
                                        <li class="list-group-item"><strong>Property type: </strong><?php echo htmlspecialchars($property['property_type_name']); ?></li>
                                        <li class="list-group-item"><strong>Status: </strong><?php echo htmlspecialchars($property['pro_status']); ?></li>
                                        <li class="list-group-item"><strong>Location: </strong><?php echo htmlspecialchars($property['state_name'] . ', ' . $property['lga_name']); ?></li>
                                        <li class="list-group-item"><strong>Size: </strong><?php echo htmlspecialchars($property['pro_size']); ?></li>
                                        <li class="list-group-item"><strong>Date: </strong><?php echo htmlspecialchars($property['created_at']); ?></li>
                                      </ul>
                                    </div>
                                   </div>
                                  
                    </div>
                     <div class="col-md-4">
                          <div class="right mt-5" style="height: 500px; background-color:white;">
                                   <h4 class="p-5">Contact Agent Or Home Owner</h4>
                                   <div class="rounded-circle overflow-hidden bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width: 120px; height: 120px;">
                                         <i class="bi bi-person-fill display-3 text-muted"></i>
                                   </div>     
                                     <p class="mt-3 text-center"><strong><?php echo htmlspecialchars($property['user_firstname'] . ' ' . $property['user_lastname']); ?></strong></p>
                                     <p class="mt-3 text-center"><strong><?php echo htmlspecialchars($property['user_phone']); ?></strong></p>
                                     <p class="mt-3 text-center"><strong><?php echo htmlspecialchars($property['user_email']); ?></strong></p>
                                     <p class="mt-3 text-center"><strong><?php echo htmlspecialchars($property['role_name'] ?? 'Owner'); ?></strong></p>
                          </div>
                     </div>
              </div>
        </main>
        <footer class="container-fluid mt-5">
            <div class="row">
                <div class="col justify-content-center">
                     <h4  class="text-center">Check out a neighborhood</h4>
                   <form action="#" method="post" class="d-flex inside">
                    <input class="col-md-4 search" type="search" placeholder="Enter an address, neighborhood, city or state" aria-label="Search"> 
                </form>
                </div>
            </div>
            <hr class="mt-5">
            <div class="row">
                  <div class="col">
                    <h5 class="text-center">About Lixurus Recommendations</h5>
                    <p class="text-center">Recommendations are based on your location and search activity, such as the homes you've viewed and saved and the filters you've used. We use 
                        this information to bring similar homes to your attention, so you don't miss out.</p>
                  </div>
            </div>

               
              <hr class="mt-5">

              <div class="row footer1 offset-md-2 gap-5">
                <div class="col-md-2 cool">
                     <p><strong>RealEstate Market</strong></p>
                </div>
                <div class="col-md-2 cool">
                     <p><strong>Popular Rentals Homes</strong></p>
                </div>
                <div class="col-md-2 cool">
                     <p><strong>Popular Sale Homes</strong></p>
                </div>
                <div class="col-md-2 cool">
                     <p><strong>For Professional</strong></p>
                </div>
              </div>
             <div class="row footer mt-5">
                  <div class="col d-flex justify-content-center">
                      <img src="img/footer.png" alt="footer" class="footer_img ">
                  </div>
             </div>
        </footer>

        

        
<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>