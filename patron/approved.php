<?php
session_start();
include('../includes/config.php');
include('../includes/filesproccess/headdropdown.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Basket</title>
    <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../style/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        /* Add this CSS to your stylesheet or in a style tag in the HTML */
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }
        /* Define animation for page fade in */
        @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
        }

        /* Apply animation to the main content */
        .main-content {
        animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include '../includes/topnav_patron.php'?>
    <div id="layoutSidenav">
        <?php include '../includes/sidenav_patron.php';?>
        <div id="layoutSidenav_content" class="main-content">
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
                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive" style="overflow: auto;">
                                            <div class="container-fluid px-4">
                                                <div class="row">
                                                    <div class="col">

                                                        <ol class="breadcrumb mb-4">
                                                        <div class="form-group">
                                                        
                                                        </div>
                                                        </ol>
                                                        <div class="card mb-3">
                                                            <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                                                                <i class="fas fa-table me-1"></i>
                                                                <select class="form-control" id="bk_cat" name="bk_cat" required onchange="redirectToPage()" style="width: 20%;">
                                                                    <option value="cart.php">My Basket</option>
                                                                    <option value="pending.php">Pending Request(s)</option>
                                                                    <option value="approved.php" selected>Approved</option>
                                                                    <option value="borrowed.php">Borrowed Books</option>
                                                                </select>
                                                            </div>
                                                            <div class="card-body">

                                                                <table id="dataTable" class="table table-bordered table-striped" style="font-size:15px">
                                                                    <thead style="font-size:20px">
                                                                        <tr>
                                                                            <th>Book Name</th>
                                                                            <th class="text-center" colspan="2">Action</th> <!-- Add colspan="2" to span two columns -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $query = mysqli_query($conn, "SELECT cart.*, book.bk_title, transaction.status 
                                                                                                                FROM cart 
                                                                                                                INNER JOIN book ON cart.ISBN = book.ISBN 
                                                                                                                LEFT JOIN transaction ON cart.ISBN = transaction.ISBN
                                                                                                                WHERE cart.user_id = '" . $_SESSION['user_id'] . "' 
                                                                                                                    AND (transaction.status IS NULL OR transaction.status = 'approved')
                                                                                                                    AND transaction.returned IS NULL
                                                                                                                ORDER BY cart.date_added DESC");
                                            
                                        
                                                                        while($row = mysqli_fetch_assoc($query)): ?>
                                                                            <tr>
                                                                                <td><?php echo $row['bk_title'];?></td>
                                                                                
                                                                                <td class="text-center">
                                                                                    <?php
                                                                                    if ($row['status'] == 'pending' || $row['status'] == 'approved') {
                                                                                    ?>
                                                                                        <a title="Cancel book" href="../includes/filesproccess/circulationProcess.php?canceliteminrequestbook=<?php echo $row['ISBN'] ?>">
                                                                                            <button type="button" class="btn btn-danger btn-sm delete">
                                                                                                <i class="fa fa-close"></i>
                                                                                            </button>
                                                                                        </a> 
                                                                                    <?php
                                                                                    } elseif ($row['status'] == '') {
                                                                                        // If status is 'approved' or any other status, display a disabled button or any other appropriate action
                                                                                    ?>
                                                                                        <a title="Remove book" href="../includes/filesproccess/circulationProcess.php?cancelbookincart=<?php echo $row['ISBN'] ?>">
                                                                                            <button type="button" class="btn btn-danger btn-sm delete">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </button>
                                                                                        </a> 
                                                                                    <?php
                                                                                    }else{
                                                                                        // If status is 'approved' or any other status, display a disabled button or any other appropriate action
                                                                                    ?>
                                                                                        
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    
                                                                                </td>

                                                                            </tr>
                                                                        <?php endwhile; ?>
                                                                    </tbody>

                                                                </table>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                </div>
            </main>
            <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable({
                        "paging": true, // Enable paging
                        "lengthChange": false, // Disable the "Show [X] entries" dropdown
                        "searching": false, // Disable search feature
                        "ordering": true, // Enable column sorting
                        "info": true, // Enable info display
                        "autoWidth": false, // Disable auto width calculation
                    });
                });
                
                function loadPage(url) {
                    $('.main-content').fadeOut('fast', function() {
                        $(this).load(url, function() {
                            $(this).fadeIn();
                        });
                    });
                }

                // Call loadPage() when the dropdown selection changes
                $('#bk_cat').change(function() {
                    var selectedPage = $(this).val();
                    loadPage(selectedPage);
                });
            </script>
            <script>
        // JavaScript function to redirect based on selected option
        function redirectToPage() {
            // Get the selected option's value
            var selectedPage = document.getElementById("bk_cat").value;
            // Redirect to the selected page
            window.location.href = selectedPage;
        }
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../style/js/datatables-simple-demo.js"></script>
</body>
</html>
