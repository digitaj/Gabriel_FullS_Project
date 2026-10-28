<?php  
    session_start();
    require_once "admin_guard.php";
    require_once "partials/admin_header.php";
    require_once "classes/Admin.php";

    $admin = new Admin;
    $users = $admin->get_all_users();

    
?>

    <!-- Main Content -->
    <main class="main-content">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 m-0 small">
                <li class="breadcrumb-item"><a href="index.html" class="text-decoration-none text-muted">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>

        <!-- Top Header for Mobile & Desktop -->
        <header
            class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded glass-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h4 class="m-0 fw-bold text-secondary">User Management</h4>
               
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
                // print_r($users);
                // echo "</pre>";
        ?>
        <!-- Users Table -->
        <div class="card border-0 shadow-sm glass-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 custom-table">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width: 50px;">
                                   S/N
                                </th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                   $sn=1;
                                   foreach($users as $user) {
                                ?>
                                      <!-- Sample Row 1 -->
                            <tr>
                                <td class="ps-4">
                                    <?php echo $sn++; ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initials bg-primary bg-opacity-10 text-primary me-3"><?php echo substr($user['user_firstname'], 0, 1); echo substr($user['user_lastname'], 0, 1); ?></div>
                                        <div>
                                            <div class="fw-bold"><?php echo $user['user_firstname']. " " . $user['user_lastname']; ?></div>
                                            <div class="small text-muted"><?php echo $user['user_email']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill"><?php echo $user['role_name']; ?></span>
                                </td>
                                <td>
                                    <?php if ($user['status'] == 'active') { ?>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Active</span>
                                    <?php } elseif ($user['status'] == 'inactive') { ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">Inactive</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill"><?php echo $user['status']; ?></span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $user['created_at']; ?></td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <?php if ($user['status'] == 'active') { ?>
                                            <button class="btn btn-sm btn-outline-danger disable-user" data-user-id="<?php echo $user['user_id']; ?>" data-bs-toggle="tooltip" title="Disable">
                                                <i class="bi bi-x-circle"></i> Disable
                                            </button>
                                        <?php } elseif ($user['status'] == 'inactive') { ?>
                                            <button class="btn btn-sm btn-outline-success enable-user" data-user-id="<?php echo $user['user_id']; ?>" data-bs-toggle="tooltip" title="Enable">
                                                <i class="bi bi-check-circle"></i> Enable
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-outline-danger disable-user" data-user-id="<?php echo $user['user_id']; ?>" data-bs-toggle="tooltip" title="Disable">
                                                <i class="bi bi-x-circle"></i> Disable
                                            </button>
                                            <button class="btn btn-sm btn-outline-success enable-user" data-user-id="<?php echo $user['user_id']; ?>" data-bs-toggle="tooltip" title="Enable">
                                                <i class="bi bi-check-circle"></i> Enable
                                            </button>
                                        <?php } ?>
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

    <script src="assets/jquery.js"></script>
    <script>
        $(document).ready(function(){
            $('.disable-user').click(function(){
                var userId = $(this).data('user-id');
                updateUserStatus(userId, 'inactive');
            });

            $('.enable-user').click(function(){
                var userId = $(this).data('user-id');
                updateUserStatus(userId, 'active');
            });

            function updateUserStatus(userId, status) {
                $.ajax({
                    url: 'process_update_status.php',
                    type: 'POST',
                    data: { user_id: userId, status: status },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            $("#feedback").html(data.message);
                            $("#feedback").removeClass('alert alert-success');
                            $("#feedback").addClass('alert alert-success');
                            location.reload();
                        } else {
                            alert('Error updating user status');
                        }
                    },
                    error: function() {
                        alert('Error updating user status');
                    }
                });
            }
        });                  
    </script>

    <?php
        require_once "partials/admin_footer.php";
    ?>