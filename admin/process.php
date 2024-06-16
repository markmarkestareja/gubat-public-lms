<?php
if (isset($_POST["add_book"])) {
    // Retrieve necessary values from the form
    $ISBN = $_POST['ISBN'];
    $due_date = $_POST['due_date'];
    $lib_num = $_POST['lib_num'];
    // Get current datetime
    $current_date_time = date('Y-m-d H:i:s');
    
    // Prepare a query to retrieve user_ID based on library number
    $user_query = "SELECT user_ID FROM users WHERE lib_num = '$lib_num'";
    $result = $conn->query($user_query);
    
    if ($result->num_rows > 0) {
        // If a matching record is found, fetch the user_ID
        $row = $result->fetch_assoc();
        $user_ID = $row['user_ID'];
        
        // Prepare the SQL query to insert the transaction
        $query = "INSERT INTO transaction (trans_name, user_ID, ISBN, status, date_requested, date_approved, date_borrowed, due_date)
                    VALUES ('borrowing', '$user_ID', '$ISBN', 'borrowed', '$current_date_time', '$current_date_time', '$current_date_time', '$due_date')";

        // Execute the query
        if ($conn->query($query)) {
            $_SESSION['msg'] = "Book Issued Successfully";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['msg'] = "Failed to Issue Book: " . $conn->error;
            $_SESSION['msg_type'] = "danger";
        }
    } else {
        // If no matching record is found
        $_SESSION['msg'] = "No user found for the given library number";
        $_SESSION['msg_type'] = "danger";
    }
    
    // Redirect back to the issue.php page
    header('location: issue.php');
    exit;
}
?>
