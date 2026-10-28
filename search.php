<?php
session_start();
require_once "partials/head.php";
require_once "partials/navbar.php";
require_once "classes/Property.php";

$prop = new Property;
$properties = [];
$search_term = '';
$listing_type = null;
$state_id = null;
$lga_id = null;

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search_term = trim($_GET['search']);
}

if (isset($_GET['listing_type']) && is_numeric($_GET['listing_type'])) {
    $listing_type = $_GET['listing_type'];
}

if (isset($_GET['state']) && is_numeric($_GET['state'])) {
    $state_id = $_GET['state'];
}

if (isset($_GET['lga']) && is_numeric($_GET['lga'])) {
    $lga_id = $_GET['lga'];
}

// If no search term but listing type specified, show all properties of that type
if (empty($search_term) && $listing_type) {
    $properties = $prop->fetch_properties_by_listing_type($listing_type);
} elseif (!empty($search_term) || $state_id || $lga_id) {
    $properties = $prop->search_properties($search_term, $state_id, $lga_id, $listing_type);
} else {
    // Default: show all properties
    $properties = $prop->fetch_all_properties();
}
$state_id = $_GET["state_id"] ?? null;
$states = $prop->get_states();
$lgas = $prop->fetch_local_govt_by_state($state_id);
$listing_types = $prop->get_listing_types();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "partials/head.php"; ?>
    <style>
        .banner {
            height: 500px;
            background-color: lightblue;
            background-image: url("img/sliderhome.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .overlay {
            height: inherit;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .search-form {
            padding: 20px 0;
            background-color: #f8f9fa;
        }
        .search-title {
            font-size: 36px;
            margin: 0;
        }
    </style>
</head>
<body>
    <?php require_once "partials/navbar.php"; ?>

    <section class="banner">
        <div class="overlay">
            <h1 class="text-white search-title">Search Properties</h1>
        </div>
    </section>

    <section class="search-form">
        <div class="container">
            <form action="search.php" method="GET" class="row g-3 justify-content-center">
                <div class="col-12 col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Property name, description, or location" value="<?php echo htmlspecialchars($search_term); ?>">
                </div>
                <div class="col-12 col-md-2">
                    <select name="listing_type" class="form-select">
                        <option value="">All Types</option>
                        <?php foreach($listing_types as $type): ?>
                            <option value="<?php echo $type['id']; ?>" <?php echo ($listing_type == $type['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($type['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <select name="state" class="form-select" id="state-select">
                        <option value="">All States</option>
                        <?php foreach($states as $state): ?>
                            <option value="<?php echo $state['state_id']; ?>" <?php echo ($state_id == $state['state_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($state['state_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <select name="lga" class="form-select" id="lga-select">
                        <option value="">All LGAs</option>
                        <?php foreach($lgas as $lga): ?>
                            <option value="<?php echo $lga['lga_id']; ?>" data-state="<?php echo $lga['state_id']; ?>" 
                            <?php echo ($lga_id == $lga['lga_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($lga['lga_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-2">
              <button class="btn btn-success w-100 button" type="submit">Search</button>

                </div>
            </form>
        </div>
    </section>

    <main class="container-fluid first_p pt-3">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">
                    <?php
                    if (!empty($search_term)) {
                        echo "Search Results for: " . htmlspecialchars($search_term);
                    } elseif ($listing_type) {
                        $type_name = '';
                        foreach($listing_types as $type) {
                            if ($type['id'] == $listing_type) {
                                $type_name = $type['name'];
                                break;
                            }
                        }
                        echo htmlspecialchars($type_name) . " Properties";
                    } else {
                        echo "All Properties";
                    }
                    ?>
                </h2>

                <?php if (count($properties) > 0): ?>
                    <div class="row mt-4 justify-content-center">
                        <?php foreach ($properties as $property): ?>
                            <?php
                            $property_id = $property['pro_id'];
                            $proimage = $prop->fetch_property_images($property_id);
                            $first_image = '';
                            if (!empty($proimage) && isset($proimage[0]['image_url'])) {
                                $first_image = trim($proimage[0]['image_url']);
                            }
                            ?>
                            <div class="col-md-3 mt-4 d-flex justify-content-center">
                                <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="homes_1">
                                    <div class="card p-0 cad" style="width: 18rem; max-width: 100%;">
                                        <img src="<?php echo htmlspecialchars($first_image); ?>" class="card-img-top w-100" alt="Property" style="height: 250px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($property['pro_title']); ?></h5>
                                            <h4> &#8358; <?php echo number_format($property['pro_price']); ?></h4>
                                            <p><?php echo htmlspecialchars($property['pro_size']); ?></p>
                                            <p><?php echo htmlspecialchars($property['pro_status']);  ?></p>
                                            <p><?php echo htmlspecialchars($property['listing_type_name']); ?></p>
                                            <a href="property_details.php?id=<?php echo $property['pro_id']; ?>" class="btn btn-primary w-100 button_1">View Details</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center" role="alert">
                        <h4 class="alert-heading">No Properties Found</h4>
                        <p>Please try different search criteria.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php require_once "partials/footer.php"; ?>

    <script>
        // Filter LGAs based on selected state
        document.getElementById('state-select').addEventListener('change', function() {
            const stateId = this.value;
            const lgaSelect = document.getElementById('lga-select');
            const lgaOptions = lgaSelect.querySelectorAll('option');

            lgaOptions.forEach(option => {
                if (stateId === '' || option.getAttribute('data-state') === stateId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });

            // Reset LGA selection if state changes
            lgaSelect.value = '';
        });

        // Trigger on page load if state is pre-selected
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('state-select').dispatchEvent(new Event('change'));
        });
    </script>
</body>
</html>