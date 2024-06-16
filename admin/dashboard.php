<?php
    session_start();

    include '../includes/config.php'; // Assuming this file contains your database connection

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: ../index.php");
        exit();
    }

    if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
        echo "<script>alert('Hello, administrator');</script>";
        unset($_SESSION['login_success']); // Clear the session variable after displaying the alert
    }

    // Check if the user is an administrator based on the "type" column
    if (isset($_SESSION['username'])) {
        $userEmail = $_SESSION['username'];

        // Assuming you have a function to sanitize user input to prevent SQL injection
        $sanitizedUserEmail = mysqli_real_escape_string($conn, $userEmail);

        $query = "SELECT * FROM users WHERE user_email = '$sanitizedUserEmail' AND type = 'Administrator'";
        $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Add more administrator-specific content as needed
    } else {
        // Redirect back to ../index.php if not an administrator
        header("Location: ../index.php");
        exit();
    }
    }else {
        // Redirect back to login.php if the username is not set in the session
        header("Location: ../index.php");
        exit(); 
    }
?>
<!-- Rest of your dashboard.php content -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <title>Dashboard</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
            <!-- Bootstrap -->
        <!-- jQuery (necessary for Bootstrap’s JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="../style/js/bootstrap.min.js"></script>
        <script src="../style/js/bootstrap.bundle.min.js"></script>
        <link href="../style/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/css/styles.css" rel="stylesheet" />
 	    <!--Morris Chart CSS -->

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
        <?php include '../includes/topnav.php'?>
        <div id="layoutSidenav">
            <!---->
            <?php include '../includes/sidenav.php'?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Library Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Books
                                <?php
                                    $query = "SELECT SUM(stock) AS totalStocks FROM book";
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);

                                        $totalStocks = $row['totalStocks'];
                                    } else {
                                        $totalStocks = "Error retrieving data";
                                    }
                                ?>
                            <h4 class="mb-0"><?php echo $totalStocks; ?></h4> 
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="../admin/book.php">
                                    <i class="fas fa-book"></i> Book
                                </a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Patrons

                            <?php
                                $query = "SELECT COUNT(*) AS totalPatrons FROM users WHERE type='Patron'";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);

                                    $totalPatrons = $row['totalPatrons'];
                                } else {
                                    $totalPatrons = "Error retrieving data";
                                }
                            ?>
                            <h4 class="mb-0"><?php echo $totalPatrons; ?></h4> <!---Count Data------>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="../admin/patron.php">
                                    <i class="fas fa-user"></i> Accounts
                                </a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Issued Book

                            <?php
                                $query = "SELECT COUNT(*) AS totalIssuedBooks FROM transaction WHERE status='borrowed'";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);

                                    $totalIssuedBooks = $row['totalIssuedBooks'];
                                } else {
                                    $totalIssuedBooks = "Error retrieving data";
                                }
                            ?>
                            <h4 class="mb-0"><?php echo $totalIssuedBooks; ?></h4> <!---Count Data------>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="../admin/issue.php">
                                    <i class="fas fa-exclamation-triangle"></i> Issued
                                </a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Over Due
                                <?php
                                // Get the current date
                                $currentDate = date('Y-m-d');

                                // Query to count overdue books
                                $query = "SELECT COUNT(*) AS totalDueBooks FROM transaction WHERE status='borrowed' AND due_date < '$currentDate'";
                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);

                                    $totalDueBooks = $row['totalDueBooks'];
                                } else {
                                    $totalDueBooks = "Error retrieving data";
                                }
                                ?>
                                <h4 class="mb-0"><?php echo $totalDueBooks; ?></h4> <!---Count Data------>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="overdue.php">
                                    <i class="fas fa-exclamation-triangle"></i> Over Due
                                </a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </main>

               <!--End--->
                <!--If, need footer, create include 'footer.php';--->
            </div>
        </div>
        <?php
            include 'footer.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>
    </body>
</html>
