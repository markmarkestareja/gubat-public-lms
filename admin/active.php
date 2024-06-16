<?php
// Include your database connection file
include '../includes/filesproccess/process.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if userID and status parameters are set
    if (isset($_POST["userID"]) && isset($_POST["active"])) {
        // Sanitize input
        $userID = $_POST["userID"];
        $active = $_POST["active"];

        try {
            // Prepare UPDATE statement
            $stmt = $connection->prepare("UPDATE users SET active = :active WHERE user_ID = :userID");

            // Bind parameters
            $stmt->bindParam(':status', $active);
            $stmt->bindParam(':userID', $userID);

            // Execute statement
            $stmt->execute();

            // Send a success response
            $response = array(
                "active" => "success",
                "message" => "Active status updated successfully"
            );
            echo json_encode($response);
            exit;
        } catch (PDOException $e) {
            // Send an error response
            $response = array(
                "active" => "error",
                "message" => "Failed to update active status: " . $e->getMessage()
            );
            echo json_encode($response);
            exit;
        }
    } else {
        // Send an error response if parameters are missing
        $response = array(
            "active" => "error",
            "message" => "Missing parameters"
        );
        echo json_encode($response);
        exit;
    }
} else {
    // Send an error response if request method is not POST
    $response = array(
        "active" => "error",
        "message" => "Invalid request method"
    );
    echo json_encode($response);
    exit;
}
?>
