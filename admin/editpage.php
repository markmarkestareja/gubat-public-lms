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
    <?php include '../includes/topnav.php'?>
    <div id="layoutSidenav">
        <?php include '../includes/sidenav.php';?>
        <div id="layoutSidenav_content">
        <main>
                <div class="card-body bg-light border rounded p-4">
                <div class="container-fluid">
                <!-- Added id attribute to the form -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                             <!-- Display book image -->
            <img src="<?php echo !empty($book['image_url']) ? '../images/bookimg/' . $book['image_url'] : $defaultImagePath; ?>" alt="Book Image" class="img-fluid rounded" width="200" height="200">
            <div class="mb-3">
                <label for="image_upload" class="form-label">Upload New Image</label>
                <input type="file" class="form-control" id="image_upload" name="image_upload">
            </div>
                            <!-- Display book title and category -->
                            <h2 class="mt-4"><?php echo isset($book['bk_title']) ? $book['bk_title'] : ''; ?></h2>
                            <p class="font-italic font-weight-bold text-danger"><?php echo isset($book['bk_cat']) ? $book['bk_cat'] : ''; ?></p>
                        </div>
                        <div class="col-md-4 mt-4 mt-md-0">
                            
                                <!-- Display and allow editing author, title, edition, publisher, and publication date -->
            
                                <div class="form-floating mb-3">
                                    <input type="text" id="author" name="author" class="form-control" value="<?php echo isset($book['author']) ? $book['author'] : ''; ?>">
                                    <label for="author">title</label>
                                </div>

                                <div class="form-floating mb-3">
                                        <input type="text" id="author" name="author" class="form-control" value="<?php echo isset($book['author']) ? $book['author'] : ''; ?>">
                                        <label for="author">Author</label>
                                    </div>

            
                                    <div class="form-floating mb-3">
                                        <input type="text" name="bk_title" class="form-control" value="<?php echo isset($book['bk_title']) ? $book['bk_title'] : ''; ?>">
                                        <label for="bk_title">Book Title</label>
                                    </div>

            
                                    <div class="form-floating mb-3">
                                        <input type="text" name="edition" class="form-control" value="<?php echo isset($book['edition']) ? $book['edition'] : ''; ?>">
                                        <label for="edition">Edition</label>
                                    </div>

            
                                    <div class="form-floating mb-3">
                                        <input type="text" name="publisher" class="form-control" value="<?php echo isset($book['publisher']) ? $book['publisher'] : ''; ?>">
                                        <label for="publisher">Publisher</label>
                                    </div>

            
                                    <div class="form-floating mb-3">
                                        <input type="date" name="pub_date" class="form-control" value="<?php echo isset($book['pub_date']) ? $book['pub_date'] : ''; ?>">
                                        <label for="pub_date">Publication Date</label>
                                    </div>
                        
                            <div>
                            
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 mt-md-0">
                        <!-- Inside the form -->
                            <div class="form-floating mb-3">
                                <input type="text" name="location" class="form-control" value="<?php echo isset($book['location']) ? $book['location'] : ''; ?>">
                                <label for="location">Location</label>
                                <input type="hidden" name="id" value="<?php echo isset($book) ? $book['ISBN'] : ''; ?>">
                            </div>
                            <div class="form-floating mb-2">
                                <textarea name="description" class="form-control custom-textarea" rows="4" style="height: 300px; width: 100%;"><?php echo htmlspecialchars(isset($book['description']) ? $book['description'] : (isset($book['desc']) ? $book['desc'] : '')); ?></textarea>
                                <label for="description">Description</label>
                            </div>
                            <button name="<?php echo isset($book) ? 'add_book' : 'edit_book'; ?>" type="submit" class="btn btn-primary">
                                    <?php echo isset($book) ? 'Update' : 'Edit'; ?> Book
                            </button>
                                <a href="viewpage.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
        </main>
    </div>
    <!-- Footer and script includes here -->
</body>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../style/assets/demo/chart-area-demo.js"></script>
        <script src="../style/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../style/js/datatables-simple-demo.js"></script>
</body>
</html>
