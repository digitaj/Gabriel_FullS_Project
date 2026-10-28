<?php
session_start();
// if(isset($_SESSION['user_online'])){
//    header('location:index.php');
//    exit();
// }

require_once "partials/navbar.php";
?>
        <main class="container-fluid form">
                <div class="row mt-5 p-5 justify-content-center align-items-center">
                      <div class="col-12 col-md-5 card mt-4 form_1">
                             <h2 class="text-center mt-5">Welcome</h2>
                              <p class="text-muted text-center">Login to access your profile and schedule.</p>
                              <form action="process/process_login.php" method="post" class="card-body" novalidate>
                                  <?php
                                        require_once "partials/message.php";
                                   ?>
                                  <div class="row g-3">
                                              <div class="col-12">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" value="<?php echo $_GET['retuser'] ?? ''   ?>" name="email" class="form-control border-dark" id="email" placeholder="name@example.com" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control border-dark" id="password" placeholder="•••••••••••••" required>
                                        </div>
                                       <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                                                <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="remember">
                                                        <label class="form-check-label text-muted small" for="remember">
                                                            Remember me
                                                        </label>
                                                </div>
                                              <a href="#" class="text-danger small text-decoration-none">Forgot Password?</a>
                                        </div>
                                        <div class="col-12">
                                            <button name="btnlogin" class="btn btn-success w-100" type="submit">login</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="admin/login.php" target="_blank" class="btn btn-primary w-100">login As Admin</a>
                                        </div>
                                         <div class="col-12 text-center">
                                                 <p class="text-muted small mb-0">Don't have an account? <a href="register.php"
                                                 class="text-danger text-decoration-none">Register</a></p>
                                         </div>
                                  </div>
                               </form>

                         </div>

                         <div class="col-12 col-md-6 mt-4 mt-md-0">
                                     <img src="assets/img/cuilture1.jfif" alt="" class="img-fluid w-100 login_img mt-5">
                         </div>
                </div>
        </main>

       <?php
           require_once "partials/footer.php";
       ?>