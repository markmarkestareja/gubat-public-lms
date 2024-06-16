<?php
    session_start();
    include('../includes/config.php');

    include('../includes/filesproccess/headdropdown.php');
// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare the SQL query
    $userSettingQuery = "SELECT *, CONCAT(fname, ' ', mInitial, ' ', lname) AS fullname FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($userSettingQuery);

    if ($stmt) {
        // Bind parameters and execute the query
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();

        // Check if there's a result
        if ($result->num_rows > 0) {
            // Fetch the row
            $row = $result->fetch_assoc();
            // Close the statement
            $stmt->close();
        } else {
            // No result found, handle the case
            echo "No user found with ID: " . $user_id;
        }
    } else {
        // Error in preparing the statement
        echo "Error in preparing the statement: " . $conn->error;
    }
} else {
    // User is not logged in, redirect or handle the case
    header("Location: login.php");
    exit();
}
// Update Account
if (isset($_POST["updateAccount"])) {
    $user_ID = $_POST['user_ID'];
    $mInitial = $_POST['mInitial'];
    $lName = $_POST['lName'];
    $fName = $_POST['fName'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $b_date = $_POST['b_date'];
    $address = $_POST['address'];
    $contact_num = $_POST['contact_num'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];

    $query = "UPDATE users
                SET fName = ?, lName = ?, mInitial = ?, gender = ?, age = ?, b_date = ?, address = ?, 
                contact_num = ?, user_email = ?, user_pass = ?
                WHERE user_ID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssisssssi", $fName, $lName, $mInitial, $gender, $age, $b_date, $address, 
    $contact_num, $user_email, $user_pass, $user_ID);


    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['msg'] = "Account successfully updated";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "Failed to update account";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to account_settings.php
    header('location: account_settings.php');
    exit;
}
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Account Settings</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
    <?php include '../includes/topnav_patron.php'?>
        <div id="layoutSidenav">
        <?php include '../includes/sidenav_patron.php';?>
            <div id="layoutSidenav_content">
                <!-- Alert messages -->
                <?php if(isset($_SESSION['msg'])): ?>
                    <div id="alertMessage" class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['msg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    // Unset the session variable after displaying the message
                    unset($_SESSION['msg']);
                    unset($_SESSION['msg_type']);
                    ?>
                    <script>
                        // Automatically close the alert after 10 seconds
                        setTimeout(function(){
                            var alertMessage = document.getElementById('alertMessage');
                            alertMessage.remove();
                        }, 2000); // 10 seconds
                    </script>
                <?php endif; ?>
            <main>
                <div class="container-fluid px-4 d-flex justify-content-center">
                    <div>
                        <h1 class="mt-4 d-flex justify-content-center">Accounts Settings</h1>
                        <div class="card" style="width: 30rem;">
                            <div class="container-fluid px-4">
                                <div class="card-body">
                                    
                                <table class="table">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="row"><h5><strong>Library number: </strong></h5> </th>
                                            <td><h5><?php echo isset($row['lib_num']) ? $row['lib_num'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Name: </strong></h5> </th>
                                            <td><h5><?php echo isset($row['fullname']) ? $row['fullname'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><h5><strong>Age: </strong></h5> </th>
                                            <td><h5><?php echo isset($row['age']) ? $row['age'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Gender: </strong></h5> </th>
                                            <td><h5><?php echo isset($row['gender']) ? $row['gender'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Birthday: </strong></h5></th>
                                            <td><h5><?php echo isset($row['b_date']) ? date("F j, Y", strtotime($row['b_date'])) : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Address: </strong></h5></th>
                                            <td><h5><?php echo isset($row['address']) ? $row['address'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Contact Number: </strong></h5></th>
                                            <td><h5><?php echo isset($row['contact_num']) ? $row['contact_num'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Username: </strong></h5> </th>
                                            <td><h5><?php echo isset($row['user_email']) ? $row['user_email'] : "Unknown"; ?></h5></td>
                                        </tr>
                                        <tr>
                                            <th class="row"><h5><strong>Password: </strong></h5> </th>
                                            <td>
                                                    <span>
                                                        <?php 
                                                        $password = isset($row['user_pass']) ? $row['user_pass'] : "Unknown"; 
                                                        ?>
                                                        <span id="user_pass">
                                                            <?php echo str_repeat("*", strlen($password)); ?>
                                                        </span>
                                                    </span>
                                                    <button id="toggleBtn" onclick="togglePasswordVisibility()" style="position: absolute; right: 0; margin-right: 3rem;"><i class="fa fa-eye"></i></button>

                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAccount">
                                    Edit
                                </button>
                                <?php 
                                    include 'editAccount.php';
                                ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

                <!--End--->
                <?php include 'footer.php'; ?>
            </div>
        </div>
        <script>
            function togglePasswordVisibility() {
                var passwordField = document.getElementById("user_pass");
                var toggleBtn = document.getElementById("toggleBtn");
                if (passwordField.innerHTML.indexOf("*") !== -1) {
                    passwordField.innerHTML = "<?php echo $password; ?>";
                    toggleBtn.innerHTML = '<i class="fa fa-eye-slash i-sm"></i>';
                    toggleBtn.title = "Hide";
                } else {
                    passwordField.innerHTML = "<?php echo str_repeat("*", strlen($password)); ?>";
                    toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
                    toggleBtn.title = "Show";
                }
            }

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>
    </body>
</html>
