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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Circulation</title>
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
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
    <?php include '../includes/topnav.php'?>
        <div id="layoutSidenav">
            <?php include '../includes/sidenav.php';?>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Circulation -  Check Out</h1>
                        <ol class="breadcrumb mb-4">
                        <!----Any Content Here----->
                        </ol>

                        <!----Content: CRUD Operations ------->
                        <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-danger">Check Out</button>
                            <button class="btn btn-primary">Check In</button>
                            <button class="btn btn-success">Renew</button>
                            <button class="btn btn-danger">Hold</button>
                            <button class="btn btn-primary">Clear Hold</button>
                            <button class="btn btn-success">Lost</button>
                            <button class="btn btn-warning">Policies</button>
                        </div>


                        <form class="form-inline" action="checkout.php"   name="form1" >
						    <div class="form-group">
							<label for="demo-inline-inputmail"> &nbsp; Enter a patron name or number:  </label> &nbsp;
							<input type="term" placeholder="" id="term" name="term" AUTOFOCUS   class="form-control"  >
						    </div>
						    &nbsp; <button class="btn btn-primary  btn-xl  " type="submit">Submit</button>
						    <br><br>&nbsp;
                        </form>


                        <!---Checking Out To Patron----->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Checking Out to Patron:
                            </div>
                            <!----DataTable (From: Library Books---->
                              <div class="table-responsive">
                              <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Book Name</th>
                                            <th>Member Name</th>
                                            <th>Pick Up Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!----Retrive Data------>
                                        </tbody>
                                </table>
                            </div>
                            <!----DataTable (From: Library Books---->
                        </div>

                        <!---Item Checked Out----->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Item Checked Out:
                            </div>
                            <!----DataTable (From: Library Books---->
                              <div class="table-responsive">
                              <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Book ID</th>
                                            <th>Full Name</th>
                                            <th>Borrowed Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-----Retrive Data----->
                                    </tbody>
                                </table>
                            </div>
                            <!----DataTable (From: Library Books---->
                        </div>
                    </div>
                </main>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>
    </body>
</html>
