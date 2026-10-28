<?php
   session_start();
?>

<?php require_once "partials/head.php"; ?>
   <?php require_once "partials/navbar.php"; ?>
    
        <main class="container-fluid form">
                <div class="row mt-5 pt-5 justify-content-center align-items-center">
                     <div class="col-12 col-md-5 text-center mb-4 mb-md-0">
                         <img src="assets/img/img-removebg-preview.png" alt="Register" class="img-fluid w-100 login_img">
                    </div>
                      <div class="col-12 col-md-5 card mt-4 form_1">
                             <h2 class="text-center mt-5">Register</h2>
                               <?php
                                require_once "partials/message.php";
                              ?>
                              <form action="process/process_register.php" method="post" class="card-body" novalidate>
                                <div class="row g-3">
                                       <div class="col-12 col-sm-6">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname" required>
                                        </div>

                                          <div class="col-12 col-sm-6">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" required>         
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="number" name="phone_number" class="form-control" id="phone_number" required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="•••••••••••" required>
                                            
                                        </div>
                                        <div class="col-12 mt-4">
                                       <div class="form-check">
                                             <input class="form-check-input" type="checkbox"
                                                  value="" id="invalidCheck" required>
                                                <label class="form-check-label text-muted small" for="invalidCheck">
                                                    I agree to the <a href="#" class="text-primary text-decoration-none">Terms
                                                        and
                                                        Conditions</a> and <a href="#"
                                                        class="text-primary text-decoration-none">Privacy Policy</a>.
                                                </label>
                                            </div>
                                         </div>
                                        <div class="mb-3">
                                            <button name="btnreg" class="btn btn-primary col-12" type="submit">Register</button>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                                <p class="text-muted small">Already have an account? <a href="login.php"
                                            class="text-primary text-decoration-none">Login</a></p>
                                        </div>
                                    </div>       
                               </form>
                         </div>
                </div>
        </main>

       
        <?php
            require_once "partials/footer.php";
        ?>