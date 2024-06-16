<?php
session_start();
include('../includes/config.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $userEmail = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $firstName = $row["fName"];
            $middleInitial = $row["mInitial"];
            $lastName = $row["lName"];
        }

        mysqli_stmt_close($stmt);
    }
}

// Fetch distinct years from the database
$yearQuery = "SELECT DISTINCT pub_date FROM book ORDER BY pub_date DESC";
$yearResult = mysqli_query($conn, $yearQuery);
$years = [];
while ($yearRow = mysqli_fetch_assoc($yearResult)) {
    $years[] = date("Y", strtotime($yearRow['pub_date']));;
}


// Fetch distinct categories from the database
$categoryQuery = "SELECT DISTINCT bk_cat FROM book";
$categoryResult = mysqli_query($conn, $categoryQuery);
$categories = [];
while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $categories[] = $categoryRow['bk_cat'];
}

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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Books</title>
    <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
    <!-- Bootstrap -->
    <!-- jQuery (necessary for Bootstrap’s JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../style/js/bootstrap.min.js"></script>
    <script src="../style/js/bootstrap.bundle.min.js"></script>
    <link href="../style/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/css/styles.css" rel="stylesheet" />
    <!--Morris Chart CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body{
            /* background-image: url('../images/cover4.jpg'); */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
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
    <?php include '../includes/topnav_patron.php' ?>
    <div id="layoutSidenav">
        <?php include '../includes/sidenav_patron.php'; ?>

        <div id="layoutSidenav_content" class="main-content">

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
                        }, 10000); // 10 seconds
                    </script>
                <?php endif; ?>

                <!-- End of alert messages -->
            <!-- 1st Main Content, show cover photo, image circle-round, complete name, -->
            <main>
                <?php include '../includes/inc_bkmodal/cart_modal.php'; ?>
                <div class="container-fluid px-4" id="data-cardSimple">
                    <div class="row">
                        
                        <div class="col-12 col-md-6 mt-4" style="display: none;">
                            <div class="mb-3">
                                <label for="publishYearFilter" class="form-label">Filter by Publish Year:</label>
                                <select class="form-select" id="publishYearFilter" name="publishYearFilter">
                                    <option value="All">All</option>
                                    <?php
                                    // Assuming $years is an array of years
                                    $uniqueYears = array_unique($years);

                                    foreach ($uniqueYears as $year) {
                                    ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-4">
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
                        <div class="col-12 col-md-6 mt-4">
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
                    </div>

                    <div class="card mb-4">
                            <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                                <i class="fas fa-table me-1"></i>
                                Book Collection
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
                </div>

            </main>

            <script>
                $(document).ready(function () {
                    function filterBooks() {
                        var selectedYear = $('#publishYearFilter').val();
                        var selectedCategory = $('#categoryFilter').val();

                        $('.card-body[data-cardSimple]').each(function () {
                            var publishYear = $(this).data('publish-year');
                            var category = $(this).data('category');

                            var yearCondition = selectedYear !== 'All' && publishYear != selectedYear;
                            var categoryCondition = selectedCategory !== 'All' && category != selectedCategory;

                            if (yearCondition || categoryCondition) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        });
                    }

                    // Call filterBooks when the page loads
                    filterBooks();

                    // Bind the filterBooks function to events for input elements
                    $('#publishYearFilter, #categoryFilter').on('change', function () {
                        filterBooks();
                    });
                });

                $(document).ready(function () {
                    // Handle click event for the clear search button
                    $('#clearSearch').on('click', function () {
                        // Clear the search input value
                        $('#search').val('');
                        
                        // Reload the page
                        window.location.href = 'book.php';
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



            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../style/js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="../style/assets/demo/chart-area-demo.js"></script>
            <script src="../style/assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../style/js/datatables-simple-demo.js"></script>
        </div>
    </div>
</body>

</html>
