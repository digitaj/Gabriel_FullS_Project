<?php
     session_start();
        require_once "classes/Property.php";
        
        $prop = new Property;
        $properties = $prop->fetch_all_properties();

        $userProperties = [];
        if (isset($_SESSION['user_online']) && is_numeric($_SESSION['user_online'])) {
            $userProperties = $prop->fetch_properties_by_user($_SESSION['user_online']);
        }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <style>
            .banner {
                height: 600px;
                background-color: lightblue;
                background-image: url("assets/img/sliderhome_1.jpg");
                background-size: cover;	
                 background-position: center;
                background-repeat: no-repeat;   
            }
            .overlay {
                        height: inherit;
                        background-color: rgba(0, 0, 0, 0.3);
                        
                        
                    }
            .txt{
                font-size: 60px;
                padding-top: 150px;
            }

             /* @media screen and (max-width:1024px) {
			       .container {
				       flex-wrap: wrap;
				   }
				   .container div {
				        width: 47%;
				   }
			  }
			  @media screen and (max-width:720px) {
			      .container {
				      flex-direction: column; 
				  }
				  .container div {
				      width: 100%;
				  }
			  } */
    </style>
     <?php 
           require_once "partials/navbar.php"; 
        ?>
</head>
<body>        

          <!-- banner section -->
            <section class="banner">
                     <div class="overlay">
                      <h1 class="text-center text-white txt">Discover a place <br>you will like to live</h1>
                        <form class="d-flex pt-5 inside" action="search.php" method="GET">
                            <input class="col-md-4 search" type="search" name="search" 
                            placeholder="Enter property name, address, neighborhood, city or state" aria-label="Search">
                            <button class="btn btn-success button ms-2" type="submit">Search</button>
                        </form>
                    <div>
            </section>
                   
         
  <section class="container-fluid">
            <div class="row mt-5 iterms justify-content-center">
                <div class="col-md-4 gap-4 d-flex flex-column">
                            <img src="assets/img/cuilture1.jfif" alt="Our cuilture" class="cuilture">
                </div>

                <div class="col-md-4 gap-4 d-flex flex-column">
                      <h1 class="text-center">Our Culture</h1>
                      <p class="iterms_1">At Lixurus Homes, our culture is 
                        more than a way of working—it is the foundation of our success. 
                        We live by values and vital behaviours that shape who we are and how we 
                        operate. Built on openness, collaboration, and accountability, our culture 
                        empowers us to deliver on our promises and achieve excellence.</p>        
                </div>
            </div>
    </section>
 
        <section class="container-fluid first_p mt-5">
                    <div class="row mt-5 iterms">
                        <div class="col-md-12">
                            <h2 class="text-center pt-5">Explore homes in Lixurus</h2>
                        </div>
                    </div>
                    <div class="row mt-5 iterms">
                        <div class="col-md-12 d-flex gap-4 flex-wrap justify-content-center">
                            <?php
                                if (count($properties) > 0) {
                                    ?>
                                    <?php
                                    foreach ($properties as $property) {
                                        $property_id = $property['pro_id'];
                                        $proimage = $prop->fetch_property_images($property_id);
                                        $first_image = '';
                                    //    echo "<pre>";
                                    //    print_r($proimage);
                                    //    echo "</pre>";
                                        if (!empty($proimage) && isset($proimage[0]['image_url'])) {
                                            $first_image = trim($proimage[0]['image_url']);
                                        }
                                        
                                    ?>
                                    <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="homes_1">
                                <div class="card p-0 cad" style="width: 18rem;">
                                        <img src="<?php echo htmlspecialchars($first_image); ?>" class="card-img-top w-100" alt="Property" style="height: 250px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($property['pro_title']);  ?></h5>
                                            <h4> &#8358; <?php echo htmlspecialchars($property['pro_price']);  ?></h4>
                                            <p><?php echo htmlspecialchars($property['pro_size']);  ?></p>
                                            <p><?php echo htmlspecialchars($property['pro_status']);  ?></p>
                                            <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="btn btn-primary button_1">View Property</a>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                    }
                                ?>
                                <?php } else{
                                    ?>
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading text-center">No Properties Found</h4>
                                        <p class="text-center">please try again later</p>
                            </div>
                                <?php     
                                }
                            ?>
                                
                        </div>
                    </div>   
                
                    
                        <?php if (!empty($userProperties)) { ?>
                        <div class="row mt-5 iterms">
                            <div class="col-md-12">
                                <h2 class="text-center">My Listings</h2>
                            </div>
                        </div>
                        <div class="row mt-4 iterms">
                            <div class="col-md-12 d-flex gap-4 flex-wrap justify-content-center">
                                <?php
                                foreach ($userProperties as $property) {
                                    $property_id = $property['pro_id'];
                                    $proimage = $prop->fetch_property_images($property_id);
                                    $first_image = '';
                                    if (!empty($proimage) && isset($proimage[0]['image_url'])) {
                                        $first_image = trim($proimage[0]['image_url']);
                                    }
                                    $display_image = (!empty($first_image) && file_exists($first_image)) ? $first_image : 'img/homes.jfif';
                                ?>
                                <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="homes_1">
                                    <div class="card p-0 cad" style="width: 18rem;">
                                        <img src="<?php echo htmlspecialchars($display_image); ?>" class="card-img-top w-100" alt="Property" style="height: 250px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($property['pro_title']); ?></h5>
                                            <h4> &#8358; <?php echo number_format($property['pro_price']); ?></h4>
                                            <p><?php echo htmlspecialchars($property['pro_size']); ?></p>
                                            <p><?php echo htmlspecialchars($property['pro_status']); ?></p>
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>   
        
                    <div class="row mt-5 iterms">
                        <div class="col-md-12">
                            <h2 class="text-center"></h2>    
                        </div>
                    </div>

                        <div class="row iterms">
                            <div class="col">
                                <h2 class="text-center"></h2> 
                            </div>          
                        </div>        
   </section>

        <section class="container-fluid mt-5 ">
                   <div class="row">
                        <div class="col">
                            <h1 class="text-center">
                                See how Lixurus can help
                            </h1>
                        </div>
                   </div>
            <div class="row parent offset-md-1">
                 <div class="col-md-3 land">
                    <img src="assets/img/buy.webp" alt="" class="by">
                      <h4 class="pt-3">Buy a home</h4>
                      <p>A real estate agent can provide you with a clear breakdown of costs so that can avoid surprise expense.</p>
                      <a href="#" class="btn btn-primary button_1">find home</a>
                 </div>
                 <div class="col-md-3 land">
                     <img src="assets/img/rent.webp" alt="" class="by">
                      <h4 class="pt-3">Rent a home</h4>
                      <p>We are creating a seamless online experince- from shopping on the largest rental network, to appying, to pay rent. </p>
                      <a href="#" class="btn btn-primary button_1">find rentals</a>
                 </div>
                 <div class="col-md-3 land">
                    <img src="assets/img/sell.webp" alt="" class="by">
                      <h4 class="pt-3">Sell a home</h4>
                      <p>No matter what path you take to sell your home, we can help you navigate to successfull sale.</p>
                      <a href="#" class="btn btn-primary button_1">Sell your home</a>
                 </div>
            </div>
      </section>
      

        <?php     
               require_once "partials/footer.php";
         ?>  
</body>
</html>           

       
        

