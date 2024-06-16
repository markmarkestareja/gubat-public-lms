<?php
// Include your database connection file
include '../includes/config.php';

// Check if ISBN is set in the POST request
if(isset($_POST['ISBN'])) {
    // Sanitize the ISBN input
    $ISBN = mysqli_real_escape_string($conn, $_POST['ISBN']);

    // Query to fetch book details based on the ISBN
    $query = "SELECT * FROM book WHERE ISBN = '$ISBN'";
    $result = mysqli_query($conn, $query);

    // Check if any row is returned
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Display book details?>
        <div class="row">
            <div class="col-6">
                <?php 
                    echo '<br><p><strong>Title: </strong>' . $row['bk_title'] . '</p>';
                    echo '<p><strong>Author: </strong>' . $row['author'] . '</p>';
                    echo '<p><strong>Edition: </strong>' . $row['edition'] . '</p>';
                ?>
            </div>
            <div class="col-6">
                <img src="<?php echo !empty($row['image_url']) ? '../images/bookimg/' . $row['image_url'] : $defaultImagePath; ?>" 
                        alt="Book Thumbnail" class="card-img-top" style="width: 200px; height: 300px; object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 1);">
             </div>
        </div><?php
        // Add more book details as needed
    } else {
        // If no book found with the provided ISBN
        echo 'Book not found';
    }
} else {
    // If ISBN is not set in the POST request
    echo 'ISBN is not set';
}
?>
