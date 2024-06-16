<?php
session_start();
include '../includes/config.php';
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
            <main>
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
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                        <!----Any Content Here----->
                    </ol>
                    <!---Library Books----->
                    <div class="card mb-4">
                        <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                            <i class="fas fa-table me-1"></i>
                            Requests
                        </div>
                        <!----DataTable (From: Library Books)---->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-striped" style="font-size:12px">
                                    <thead>
                                        <tr>
                                            <th>Issued ID</th>
                                            <th>Book Title</th>
                                            <th>Borrower's Name</th>
                                            <th>Request Date</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $user_id = $_SESSION['user_id'];
                                        $query = mysqli_query($conn, "SELECT transaction.ISBN, transaction.date_requested, 
                                            transaction.status, book.bk_title, book.location, transaction.user_ID,
                                            CONCAT(users.fName, ' ', users.mInitial, '. ', users.lName) AS fullname
                                            FROM transaction 
                                            INNER JOIN book ON transaction.ISBN = book.ISBN 
                                            INNER JOIN users ON transaction.user_ID = users.user_ID
                                            WHERE transaction.status = 'pending'
                                            ORDER BY transaction.date_requested DESC");

                                        while($row = mysqli_fetch_assoc($query)){?>
                                            <tr>
                                                <td><?php echo $row['ISBN'];?></td>
                                                <td><?php echo $row['bk_title'];?></td>
                                                <td><?php echo $row['fullname'];?></td>
                                                <td><?php echo date('M-d-Y', strtotime($row['date_requested']));?></td>
                                                <td><?php echo $row['location'];?></td>
                                                <td><?php echo $row['status'];?></td>
                                                <td>
                                                    <a href="../includes/filesproccess/circulationProcess.php?approverequest=<?php echo $row['ISBN'];?>&user_ID=<?php echo $row['user_ID']; ?>" 
                                                        class="btn btn-success col" title="Approve the request">Approve</a>
                                                    <a href="../includes/filesproccess/circulationProcess.php?cancelrequest=<?php echo $row['ISBN'];?>&user_ID=<?php echo $row['user_ID']; ?>" 
                                                        class="btn btn-danger col" title="Approve the request">Cancel</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!----DataTable (From: Library Books---->
                    </div>
                    <div class="card mb-4">
                        <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                            <i class="fas fa-table me-1"></i>
                            Another Table
                        </div>
                        <div class="card-body">
                            d
                        </div>
                    </div>
                </div>
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
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../style/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../style/assets/demo/chart-area-demo.js"></script>
    <script src="../style/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../style/js/datatables-simple-demo.js"></script>
</body>
</html>
