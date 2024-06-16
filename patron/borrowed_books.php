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
        <title>Borrowed Books</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../style/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

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
        </style>

    </head>
    <body class="sb-nav-fixed">
    <?php include '../includes/topnav_patron.php'?>
        <div id="layoutSidenav">
        <?php include '../includes/sidenav_patron.php';?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Borrowed Books</h1>
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
                                        <th>Date Borrowed</th>
                                        <th>Due Date</th>
                                        <th>Time Remaining</th>
                                        <th>Request Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $user_id = $_SESSION['user_id'];

                                        $query = mysqli_query($conn, "SELECT transaction.ISBN, transaction.date_borrowed, 
                                                                        transaction.due_date, 
                                                                        transaction.status, book.bk_title, transaction.user_ID,
                                                                        CONCAT(users.fName, ' ', users.mInitial, '. ', users.lName) AS fullName 
                                                                        FROM transaction 
                                                                        INNER JOIN book ON transaction.ISBN = book.ISBN 
                                                                        INNER JOIN users ON transaction.user_ID = users.user_ID
                                                                        WHERE transaction.user_ID = '".$_SESSION['user_id']."' 
                                                                        AND transaction.status = 'borrowed'
                                                                        ORDER BY transaction.date_requested DESC");

                                        while($row = mysqli_fetch_assoc($query)){?>
                                            <tr>
                                                <td><?php echo $row['ISBN'];?></td>
                                                <td><?php echo $row['bk_title'];?></td>
                                                <td><?php echo date("F j, Y", strtotime($row['date_borrowed']));?></td>
                                                <td><?php echo date("F j, Y", strtotime($row['due_date']));?></td>
                                                <td> 
                                                    <?php
                                                        $dueDate = strtotime($row['due_date']);
                                                        $currentDate = time();
                                                        $timeRemaining = $dueDate - $currentDate;

                                                        if ($timeRemaining > 0) {
                                                            $days = floor($timeRemaining / (60 * 60 * 24));
                                                            $hours = floor(($timeRemaining % (60 * 60 * 24)) / (60 * 60));
                                                            $minutes = floor(($timeRemaining % (60 * 60)) / 60);

                                                            echo "$days days, $hours hours, $minutes minutes remaining";
                                                        } else {
                                                            echo '<span style="color: red;">Overdue</span>';
                                                            $updateQuery = "UPDATE transaction SET remark = 'Overdue' WHERE ISBN = '{$row['ISBN']}'";
                                                            mysqli_query($conn, $updateQuery);
                                                        }
                                                    ?> </td>
                                            </tr>
                                        <?php } 
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
