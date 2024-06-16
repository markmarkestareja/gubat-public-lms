<?php

include '../includes/filesproccess/process.php';

// Fetch distinct categories from the database
$categoryQuery = "SELECT DISTINCT bk_cat FROM book";
$categoryResult = mysqli_query($conn, $categoryQuery);
$categories = [];
while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $categories[] = $categoryRow['bk_cat'];
}


// Constructing the default image path relative to the book images directory
$defaultImagePath = '../images/NotAvailable.jpg';

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
    <title>Book</title>
    <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Your custom script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../style/js/bootstrap.min.js"></script>
    <script src="../style/js/bootstrap.bundle.min.js"></script>
    <link href="../style/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../style/css/styles.css" rel="stylesheet" />
    <link href="../style/css/card.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!---DropDown: Interaction Plugins-------->
</head>

<body class="sb-nav-fixed" style="background-color: white;">
    <?php include '../includes/topnav.php'?>
    <div id="layoutSidenav">
        <!---->
        <?php include '../includes/sidenav.php'?>
        <div id="layoutSidenav_content">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Button: For Adding Book -->
                                <br>
                                <div class="d-flex justify-content-between">
                                    <!-- Add Book Button -->
                                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addTaskModal">Add Book</button>

                                    <!-- Popularity Books Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="popularityDropdown" data-toggle="dropdown" aria-expanded="false">
                                            Popularity Books
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="popularityDropdown">
                                            <li><a class="dropdown-item" href="#" onclick="openPopularityReport('anytime')">Anytime</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="openPopularityReport('1-month')">1 Month</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="openPopularityReport('6-month')">6 Months</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="openPopularityReport('1-year')">1 Year</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Search by Title and Publish Year Filtering -->
                                    <label for="categoryFilter" class="form-label">Search:</label>
                                    <form id="searchForm" action="book.php" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="search" name="search" placeholder="Enter title, author, subcategories, or subdivision" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                            <button type="button" class="btn btn-outline-secondary" id="clearSearch">X</button>
                                            <!-- Remove the search button -->
                                        </div>
                                        <!-- Dropdown to display suggestions -->
                                        <div id="suggestionDropdown" class="dropdown-menu" aria-labelledby="search"></div>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <!-- Category Dropdown -->
                                    <div class="mb-3">
                                        <label for="categoryFilter" class="form-label">Filter by Category:</label>
                                        <select class="form-select" id="categoryFilter" name="categoryFilter">
                                            <option value="All">All</option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row row-cols-1 row-cols-md-5 g-2" id="bookResults">
                                    <!-- Book cards will be dynamically added here -->
                                </div>
                            </div>

                            
                            
                            <!-- <div class="col-12 col-md-6 mt-4">
                                    <label for="categoryFilter" class="form-label">Filter by Sub Category:</label>
                                 Sub Category Dropdown 
                                 <select class="form-select" id="subcategoryFilter" name="subcategoryFilter">
                                    <option value="All">All</option>
                                    <?php //foreach ($subcategories as $subcategory) { ?>
                                        <option value="<?php //echo $subcategory; ?>"><?php //echo $subcategory; ?></option>
                                    <?php //} ?>
                                </select>

                            </div> -->


                        </div>
                        
                        <div class="container">
                           
                            <br>
                            <div class="card mb-4">
                                <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                                    
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-table me-1"></i>
                                            Library Books
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body" id="data-cardSimple">
                                    <div class="row row-cols-1 row-cols-md-5 g-2" id="bookResults">
                                    <?php
                                        $search = isset($_GET['search']) ? $_GET['search'] : ''; // Initialize $search with an empty string if not set
                                        $categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : 'All'; // Get the selected category filter, default to 'All' if not set

                                        // Construct the WHERE clause based on the selected category filter
                                        $whereClause = ($categoryFilter !== 'All') ? "WHERE bk_cat = '$categoryFilter' AND (bk_title LIKE '%$search%' OR author LIKE '%$search%' OR bk_cat LIKE '%$search%' OR bk_subcat LIKE '%$search%' OR bk_subdivision LIKE '%$search%')" : 
                                                        "WHERE bk_title LIKE '%$search%' OR author LIKE '%$search%' OR bk_cat LIKE '%$search%' OR bk_subcat LIKE '%$search%' OR bk_subdivision LIKE '%$search%'";

                                        $query = mysqli_query($conn, "SELECT * FROM book $whereClause ORDER BY bk_title ASC");

                                        // Check if any rows are returned
                                        if (mysqli_num_rows($query) > 0) {
                                            while ($row = mysqli_fetch_assoc($query)) {
                                                $imageSource = isset($row['image_url']) && !empty($row['image_url']) ?
                                                    "../images/bookimg/{$row['image_url']}" : "path/to/your/default/image.jpg";
                                        ?>
                                        <div class="card-body" data-cardSimple data-category="<?php echo $row['bk_cat']; ?>">
                                            <a href="viewpage.php?ISBN=<?php echo $row['ISBN']; ?>">
                                                <img src="<?php echo !empty($row['image_url']) ? '../images/bookimg/' . $row['image_url'] : $defaultImagePath; ?>" 
                                                alt="Book Thumbnail" class="card-img-top" style="width: 200px; height: 300px; object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 1);">
                                            </a>
                                        </div>
                                        <?php 
                                            } 
                                        } else {
                                            // Display a message if no books are found
                                            echo "<p>No books available.</p>";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <?php include '../includes/inc_bkmodal/add_modal.php';?>
                        </div>
                    </div>
                </div>
            </main>
            <script>
                $(document).ready(function () {
                    // Function to fetch and display filtered books
                    function filterBooks() {
                        var searchValue = $('#search').val().trim(); // Trim whitespace
                        $.ajax({
                            url: 'filter_books.php', // Modify this URL to your backend endpoint for filtering books
                            method: 'GET',
                            data: { search: searchValue },
                            success: function (response) {
                                $('#bookResults').html(response);
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }

                    // Call filterBooks when the search input value changes
                    $('#search').on('input', function () {
                        filterBooks();
                    });

                    // Ensure jQuery is loaded before this script
                    $('#clearSearch').on('click', function () {
                        // Clear the search input value
                        $('#search').val('');
                        filterBooks(); // Trigger filtering when clearing search
                    });
                });

                

            </script>
            

            <script>
                $(document).ready(function () {
                    function filterBooks() {
                        var selectedCategory = $('#categoryFilter').val();

                        $('.card-body[data-cardSimple]').each(function () {
                            var category = $(this).data('category');

                            var categoryCondition = selectedCategory !== 'All' && category !== selectedCategory;

                            if (categoryCondition) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        });
                    }

                    // Call filterBooks when the page loads
                    filterBooks();

                    // Bind the filterBooks function to events for input elements
                    $('#categoryFilter').on('change', function () {
                        filterBooks();
                    });

                    // Ensure jQuery is loaded before this script
                    $('#clearSearch').on('click', function () {
                        // Clear the search input value
                        $('#search').val('');
                        
                        // Reload the page
                        window.location.href = 'book.php';
                    });
                });
            </script>


            <script>
                function openPopularityReport(period) {
                    var baseUrl = '../admin/reports/'; // Base URL for reports directory

                    switch (period) {
                        case 'anytime':
                            window.open(baseUrl + 'anytime.php', '_blank');
                            break;
                        case '1-month':
                            window.open(baseUrl + 'month.php', '_blank');
                            break;
                        case '6-month':
                            window.open(baseUrl + 'sixmonth.php', '_blank');
                            break;
                        case '1-year':
                            window.open(baseUrl + 'year.php', '_blank');
                            break;
                        default:
                            // Handle default case
                    }
                    
                }
            </script>
            <!----DropDown For Account Settings----->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../style/js/scripts.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../style/js/datatables-simple-demo.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </div>
    </div>
</body>
</html>
