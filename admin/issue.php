<?php
    session_start();
    include '../includes/config.php'; // Assuming this file contains your database connection
    include 'process.php';
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
        <title>Issue</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
        <link href="../style/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include '../includes/topnav.php'?>


        <div id="layoutSidenav">
            <!---SideBar---->
            <?php include '../includes/sidenav.php';?>
            <div id="layoutSidenav_content">
            <!---Main from Charts ref:----->
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

                <!-- End of alert messages -->
            <main><br>
                
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#issueBook">
            Add Transaction 
        </button>
    <?php include 'issueBookbyAdmin.php'; ?>
        
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                    <i class="fas fa-table me-1"></i>
                                Books Borrowed
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <div class="table-responsive">
                                    <table id="dataTable" class="table table-bordered table-striped" style="font-size:12px">
                                        <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Book Name</th>
                                            <th>Borrower Name</th>
                                            <th>Borrowed Date</th>
                                            <th>Due Date</th>
                                            <th>Notes</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $user_id = $_SESSION['user_id'];

                                        $query = mysqli_query($conn, "SELECT transaction.ISBN, transaction.date_borrowed, 
                                                                        transaction.due_date, transaction.note,
                                                                        transaction.status, book.bk_title, transaction.user_ID,
                                                                        CONCAT(users.fName, ' ', users.mInitial, '. ', users.lName) AS fullName 
                                                                        FROM transaction 
                                                                        INNER JOIN book ON transaction.ISBN = book.ISBN 
                                                                        INNER JOIN users ON transaction.user_ID = users.user_ID
                                                                        WHERE transaction.status = 'borrowed'
                                                                        ORDER BY transaction.date_requested DESC");

                                        while ($row = mysqli_fetch_assoc($query)) { ?>
                                            <tr>
                                                <td><?php echo $row['ISBN']; ?></td>
                                                <td><?php echo $row['bk_title']; ?></td>
                                                <td><?php echo $row['fullName']; ?></td>
                                                <td><?php echo date('M-d-Y', strtotime($row['date_borrowed'])); ?></td>
                                                <td><?php echo date('M-d-Y', strtotime($row['due_date'])); ?></td>
                                                <td><?php echo $row['note']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $dueDate = strtotime($row['due_date']);
                                                    $currentDate = time();
                                                    if ($currentDate >= $dueDate) {
                                                        echo '<span style="background-color: red; color: white; padding: 5px; border-radius: 5px;">OVERDUE</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <a title = "Return the book"href="../includes/filesproccess/circulationProcess.php?returnborrowedbook=<?php echo $row['ISBN'];?>&user_ID=<?php echo $row['user_ID']; ?>" 
                                                            class="btn btn-primary col">Return</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php include 'issueBookbyAdmin.php';?>
</main>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "paging": true // Enable paging
                });
            }); 
        </script>
                <!--End--->
                <?php include 'footer.php'; ?>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="../style/assets/demo/chart-pie-demo.js"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>
    </body>
</html>
