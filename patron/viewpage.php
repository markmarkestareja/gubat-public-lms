<?php
session_start();
include('../includes/config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../login.php");
    exit; // Stop further execution
}

// Initialize variables
$title = "Book Details";
$summary = "Summary Not Available";
$description = "Description Not Available";

// Check if ISBN is provided in the URL
if (isset($_GET['ISBN'])) {
    $ISBN = $_GET['ISBN'];
    
    // Fetch book details from the database
    $query = "SELECT * FROM book WHERE ISBN = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $ISBN);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        // Redirect to a page indicating that the book was not found
        header("Location: book_not_found.php");
        exit;
    }
} else {
    // Redirect to a page indicating that the ISBN was not provided
    header("Location: ISBN_not_provided.php");
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
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <title>Book View</title>
        <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
            <!-- Bootstrap -->
        <!-- jQuery (necessary for Bootstrap’s JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="../style/js/bootstrap.min.js"></script>
        <script src="../style/js/bootstrap.bundle.min.js"></script>
        <link href="../style/css/bootstrap.min.css" rel="stylesheet">
        <link href="../style/css/styles.css" rel="stylesheet" />
 	    <!--Morris Chart CSS -->

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

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
    <div class="container mt-4">
        <div class="row">
            <!-- First Column - Book Image -->
            <div class="col-md-4">
                <a href="<?php echo isset($book['image_url']) ? '../images/bookimg/' . $book['image_url'] : 'path/to/default/image.jpg'; ?>" class="zoom">
                    <img src="<?php echo isset($book['image_url']) ? '../images/bookimg/' . $book['image_url'] : 'path/to/default/image.jpg'; ?>" alt="Book Image" 
                        class="img-fluid rounded" style="width: 500px; height: 600px object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 1);">
                </a>
            </div>

            <!-- Second Column - Book Details -->
            <div class="col-md-8">
                <h1><?php echo $book['bk_title']; ?></h1>
                <h5><em><?php echo $book['subtitle']; ?></em></h5>

                <h6>by <?php echo $book['author'] ?></h6>

                
                <p class="font-italic font-weight-bold text-danger"><?php echo $book['bk_cat']; ?></p>

                <div class="description">
                    <p><?php echo $book['description']; ?></p>
                </div>

                <!-- Read More Button -->
                <p class="short-description"><?php echo substr($book['description'], 0, 250); ?>...<button class="btn btn-link read-more-btn" style="text-decoration: none;"><em><small>Read More</small></em></button></p>
                

                
                <p>
                    <div class="card bg-light border rounded">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Book Details</h5>
                            <hr>
                            <div class="row">
                                <!-- Publication Information -->
                                <div class="col-md-6">
                                    
                                    <ul class="list-unstyled">
                                        <li>ISBN: <?php echo $book['ISBN']; ?></li>
                                        <li>Edition: <?php echo $book['edition']; ?></li>
                                        <li>Available Copies: <?php echo $book['copies']; ?></li>
                                        
                                    </ul>

                                </div>
                                <!-- Additional Information -->
                                <div class="col-md-6">
                                    <h5 class="mb-3">Publication Information</h5>
                                    <ul class="list-unstyled">
                                        <li>Publisher: <?php echo $book['publisher']; ?></li>
                                        <li>Publication Date: <?php echo date("F j, Y", strtotime($book['pub_date'])); ?></li>
                                        <li>Published in: <?php echo $book['published_in']; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </p>
                

                
                <div class="container mt-4">
                    <a href="book.php" class="btn btn-primary me-md-3 mb-3 mb-md-0" title="Go Back"><i class="fas fa-arrow-left"></i></a>
                    
                    <a href="../includes/filesproccess/circulationProcess.php?addtocart=<?php echo $book['ISBN']; ?>" class="btn btn-danger me-md-3 mb-3 mb-md-0" title="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                    

                </div>
 
                
                
            </div>
            

           
    </div>
</main>
         
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.zoom').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300 // don't forget to change the duration also in CSS
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    // Hide description initially
    $('.description').hide();
    
    // Toggle description visibility
    $('.read-more-btn').click(function() {
        $('.description').toggle();
        // Change button text based on visibility
        $(this).text(function(i, text){
            return text === "Read More" ? "Read Less" : "Read More";
        });
    });
});
</script>



                    
        </div>
    </div>
       <!-- Add jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Add Magnific Popup core CSS file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- Add Magnific Popup core JS file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>
</body>
</html>


