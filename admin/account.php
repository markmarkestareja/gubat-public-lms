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
        <title>Account Details</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/css/styles.css" rel="stylesheet" />
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
                        <h1 class="mt-4">Account Details</h1>
                        <ol class="breadcrumb mb-4">
                        <!----Any Content Here----->
                        </ol>
                        <!---Library Books----->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Library Books
                            </div>
                            <!----DataTable (From: Library Books---->
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-book">
                                      View Accounts
                                </button>
                              </div>
                               
                              <div class="card-body">
                                <table id="datatablesSimple" class="table table-bordered table-striped" style="font-size:10px">
                                    <thead>
                                        <tr>
                                            <th>Account Id</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>contact</th>
                                            <th>Book Title</th>
                                            <th>Book Author</th>
                                            <th>Serial Number</th>
                                            <th>Category Name ID</th>
                                            <th>Borrow Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Sample data
                                        $books = 
                                        [
                                            [
                                                "student_id"=> "S001",
                                                "full_name"=> "John Doe",
                                                "email_add"=> "john@example.com",
                                                "contact"=> "123-456-7890",
                                                "book_title"=>"Introduction to Programming",
                                                "book_author" => "Alice Smith",
                                                "serial_number" => "SN: 12345",
                                                "category_name_id" => "C001",
                                                "borrow_date" => "2023-08-15",
                                                "return_date" => "2023-08-30",
                                                "status" => "Borrowed"
                                            ],
                                            [
                                                "student_id" => "S002",
                                                "full_name" => "Jane Smith",
                                                "email_add" => "jane@example.com",
                                                "contact" => "987-654-3210",
                                                "book_title" => "Data Structures and Algorithms",
                                                "book_author" => "Bob Johnson",
                                                "serial_number" => "SN: 67890",
                                                "category_name_id" => "C002",
                                                "borrow_date" => "2023-08-10",
                                                "return_date" => "2023-08-25",
                                                "status" => "Returned"
                                            ],
                                            [
                                                "student_id" => "S003",
                                                "full_name" => "Michael Brown",
                                                "email_add" => "michael@example.com",
                                                "contact" => "555-555-5555",
                                                "book_title" => "Web Development Basics",
                                                "book_author" => "Carol Williams",
                                                "serial_number" => "SN: 24680",
                                                "category_name_id" => "C003",
                                                "borrow_date" => "2023-08-05",
                                                "return_date" => "2023-08-20",
                                                "status" => "Borrowed"
                                            ]
                                            // Add more book arrays as needed
                                        ];

                                                foreach ($books as $book) {
                                                    echo "<tr>";
                                                    echo "<td>{$book['student_id']}</td>";
                                                    echo "<td>{$book['full_name']}</td>";
                                                    echo "<td>{$book['email_add']}</td>";
                                                    echo "<td>{$book['contact']}</td>";
                                                    echo "<td>{$book['book_title']}</td>";
                                                    echo "<td>{$book['book_author']}</td>";
                                                    echo "<td>{$book['serial_number']}</td>";
                                                    echo "<td>{$book['category_name_id']}</td>";
                                                    echo "<td>{$book['borrow_date']}</td>";
                                                    echo "<td>{$book['return_date']}</td>";
                                                    echo "<td>{$book['status']}</td>";
                                                    echo '<td>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-book">
                                                                <i class="fa fa-add"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-book">
                                                            <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-book">
                                                            <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                        </tbody>
                                </table>
                            </div>
                            <!----DataTable (From: Library Books---->
                        </div>
                    </div>
                </main>
                <!--End--->
                <?php include 'footer.php'; ?>
            </div>
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
