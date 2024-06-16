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
        <title>Request Books</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
    <?php include '../includes/topnav.php'?>
        <div id="layoutSidenav">
        <?php include '../includes/sidenav_patron.php';?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Requested Books</h1>
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
                              <div class="card-body">
                                <table id="example3" class="table table-bordered table-striped" style="font-size:12px">
                                <thead>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>Book Name</th>
                                        <th>Date Requested</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php //May inayos
                                            $user_id = $_SESSION['user_id'];

                                            $query = mysqli_query($conn, "SELECT transaction.ISBN, transaction.date_requested, 
                                                                            transaction.status, book.bk_title FROM transaction 
                                                                            INNER JOIN book ON transaction.ISBN = book.ISBN 
                                                                            WHERE transaction.user_id = '" . $_SESSION['user_id'] . "'
                                                                            AND (transaction.status = 'pending' OR transaction.status = 'approved')
                                                                            ORDER BY transaction.date_requested DESC");


                                            while($row = mysqli_fetch_assoc($query)){?>
                                                <tr>
                                                    <td><?php echo $row['ISBN'];?></td>
                                                    <td><?php echo $row['bk_title'];?></td>
                                                    <td><?php echo date("F j, Y", strtotime($row['date_requested']));?></td>
                                                    <td><?php echo $row['status'];?></td>
                                                    <td>
                                                        <a href="../includes/processes.php?canceliteminrequestbook=<?php echo $row['ISBN'] ?>" 
                                                            class="btn btn-danger col">Cancel</a>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } //to here
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
