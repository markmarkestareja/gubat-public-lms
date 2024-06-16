<?php
include '../includes/filesproccess/process.php';


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
    <link href="../style/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/css/styles.css" rel="stylesheet" />
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
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
    <?php include '../includes/topnav.php'?>
    <div id="layoutSidenav">
    
        <?php include '../includes/sidenav.php';?>
        <div id="layoutSidenav_content">
            <main>
                
                <div class="container mt-4">
                    <div class="row">
                        <!-- First Column - Book Image -->
                        <div class="col-md-4">
                            <a href="<?php echo isset($book['image_url']) ? '../images/bookimg/' . $book['image_url'] : 'path/to/default/image.jpg'; ?>" class="zoom">
                                <img src="<?php echo isset($book['image_url']) ? '../images/bookimg/' . $book['image_url'] : 'path/to/default/image.jpg'; ?>" 
                                alt="Book Image" class="img-fluid rounded" style="width: 500px; height: 600px object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 1);">
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
                                                    <li>Main Class: <?php echo $book['bk_cat']; ?></li>
                                                    <li>Sub Class: <?php echo $book['bk_subcat']; ?></li>
                                                    <li>Sub Division: <?php echo $book['bk_subdivision']; ?></li>
                                                    <li>Edition: <?php echo $book['edition']; ?></li>
                                                    <li>Available Copies: <?php echo $book['copies']; ?></li>
                                                    <li>Total Copies: <?php echo $book['stock']; ?></li>
                                                    
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
                                <a href="book.php" class="btn btn-primary me-3">Go Back</a>
                                <a href="../includes/inc_bkmodal/edit_modal.php?edit=<?php echo $book['ISBN']?>" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#edit_patModal">
                                    Edit
                                </a>
                            </div>
                            <?php include '../includes/inc_bkmodal/edit_modal.php';?>

            
                            
                            
                        </div>
                        

                    
                </div>
            </main>
        </div>
    </div>
    <!-- Add jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
    $(document).ready(function() {
        console.log('Document ready'); // Check if document ready event is fired
        $('#edit_patModal').on('show.bs.modal', function(event) {
            console.log('Modal show event fired'); // Check if modal show event is triggered
            var $button = $(event.relatedTarget); // Button that triggered the modal
            console.log('Button:', $button);

            // Assuming your modal contains input fields with the following IDs
            $('#oldISBN').val("<?php echo isset($book['ISBN']) ? $book['ISBN'] : ''; ?>");
            $('#newISBN').val("<?php echo isset($book['ISBN']) ? $book['ISBN'] : ''; ?>");
            $('#bk_title').val("<?php echo $book['bk_title']; ?>");
            $('#subtitle').val("<?php echo $book['subtitle']; ?>");
            $('#author').val("<?php echo $book['author']; ?>");
            $('#bk_cat').val("<?php echo $book['bk_cat']; ?>");
            $('#description').val("<?php echo isset($book['description']) ? $book['description'] : ''; ?>"); // Ensure description is correctly fetched
            $('#ISBN').val("<?php echo $book['ISBN']; ?>");
            $('#edition').val("<?php echo $book['edition']; ?>");
            $('#copies').val("<?php echo $book['copies']; ?>");
            $('#location').val("<?php echo $book['location']; ?>");
            $('#publisher').val("<?php echo $book['publisher']; ?>");
            $('#date_acquired').val("<?php echo date("Y-m-d", strtotime($book['date_acquired'])); ?>");
            $('#pub_date').val("<?php echo date("Y-m-d", strtotime($book['pub_date'])); ?>");
            $('#published_in').val("<?php echo $book['published_in']; ?>");
            $('#image_url').val("<?php echo isset($book['image_url']) ? $book['image_url'] : ''; ?>");

            // Assuming you have an image preview element with ID 'image_preview'
            $('#image_preview').attr("src", "<?php echo isset($book['image_url']) ? '../images/bookimg/' . $book['image_url'] : 'path/to/default/image.jpg'; ?>");
        });
    });
</script>


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
