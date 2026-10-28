<?php
session_start();
require_once "partials/navbar.php";
require_once "partials/head.php";
require_once "classes/Property.php";

$prop = new Property;
$listing_types = $prop->get_listing_types();

// Get Sell listing type ID (assuming ID 3 is Sell, adjust if needed)
$sell_id = 1;
$properties = $prop->fetch_properties_by_listing_type($sell_id);

// Fetch properties uploaded by the current user
$userProperties = [];
if (isset($_SESSION['user_online']) && is_numeric($_SESSION['user_online'])) {
    $userProperties = $prop->fetch_properties_by_user($_SESSION['user_online']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "partials/head.php"; ?>
    <style>
        .banner {
            height: 550px;
            background-color: lightblue;
            background-image: url("assets/img/sell_homes.jpg");
            background-size: cover;		   
        }
       .overlay {
			    height: inherit;
				background-color: rgba(0, 0, 0, 0.3);
			 }
            .txt{
                font-size: 60px;
                padding-top: 150px;
            }
    </style>
  
      
        <main>
            <section class="banner">
                <div class="overlay">
                      <h1 class="text-center text-white txt">Sell Homes</h1>
                <form class="d-flex pt-5 inside" action="search.php" method="GET">
                    <input class="col-md-4 search" type="search" placeholder="Enter an address, neighborhood, city or state" aria-label="Search">
                            <button class="btn btn-success button ms-2" type="submit">Search</button>
                    
                </form>
                <div>
            </section>
        </main>

        <main class="container-fluid first_p pt-3">
              <div class="row">
                    <div class="col-md-12">
                            <div class="row mt-5 justify-content-center">
                                    <?php
                                    foreach ($properties as $property) {
                                        $property_id = $property['pro_id'];
                                            $proimage = $prop->fetch_property_images($property_id);
                                            $first_image = '';
                                        // echo "<pre>";
                                        //    print_r($proimage);
                                        // echo "</pre>";
                                            if (!empty($proimage) && isset($proimage[0]['image_url'])) {
                                                $first_image = trim($proimage[0]['image_url']);
                                            }
                                    ?>    
                                    <div class="property-card mt-4 d-flex justify-content-center" style="width: 18rem; margin: 0 10px;">
                                                <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="homes_1">
                                                <div class="card p-0 cad" style="width: 18rem;">
                                                        <img src="<?php echo htmlspecialchars($first_image); ?>" class="card-img-top w-100" alt="Property" style="height: 250px;">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo htmlspecialchars($property['pro_title']); ?></h5>
                                                            <h4> &#8358; <?php echo number_format($property['pro_price']); ?></h4>
                                                            <p><?php echo htmlspecialchars($property['pro_size']); ?></p>
                                                            <p><?php echo htmlspecialchars($property['pro_status']);  ?></p>
                                                                <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="btn btn-primary col-12 button_1">View Details</a>
                                                        </div>
                                                    </div>
                                                </a>
                                        </div> 
                                    <?php } ?>     
                            </div>    
                    </div>
            
              </div>
        </main>

       <?php
            require_once "partials/footer.php";
       ?>