<?php
include '../includes/filesproccess/process.php';

// Assuming you're processing form submission to add a new patron
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_patron"])) {
    // Your code to add the new patron to the database goes here
    
    // Assuming the patron is successfully added
    $status = "success";
    $message = "Patron added successfully";

    // Prepare the response as an array
    $response = array(
        "status" => $status,
        "message" => $message
    );
    header("Location: patron.php");
    exit; // Make sure to exit after sending the response
}

// Handle form submission for editing a patron
// if (isset($_POST['edit_patron'])) {
//     $user_ID = $_POST['user_ID'];
//     $fName = $_POST['fName'];
//     $mInitial = $_POST['mInitial'];
//     $lName = $_POST['lName'];
//     $gender = $_POST['gender'];
//     $age = $_POST['age'];
//     $b_date = $_POST['b_date'];
//     $address = $_POST['address'];
//     $contact_num = $_POST['contact_num'];
//     $user_email = $_POST['user_email'];
//     $user_pass = $_POST['user_pass'];
//     $type = $_POST['type'];
    
//     $patrons = "UPDATE users 
//               SET
//               fName = '$fName', 
//               mInitial = '$mInitial', 
//               lName = '$lName', 
//               gender = '$gender', 
//               age = '$age', 
//               b_date = '$b_date', 
//               address = '$address', 
//               contact_num = '$contact_num', 
//               user_email = '$user_email', 
//               user_pass = '$user_pass', 
//               type = '$type'
//               WHERE user_ID = '$user_ID'";

//     if ($conn->query($patrons)) {
//         $response = array('status' => 'success', 'message' => 'User data successfully updated!');
//          // Redirect to patron.php after a successful update
//         header("Location: patron.php");
//         exit;
//     } else {
//         $response = array('status' => 'error', 'message' => 'User data update error!');
//     }

//     echo json_encode($response);
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Patron</title>
    <link rel="shortcut icon" type="image/x-icon" href="../style/image/library_logo.jpg">
    <!-- Bootstrap -->
    <!-- jQuery (necessary for Bootstrap’s JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../style/js/bootstrap.min.js"></script>
    <script src="../style/js/bootstrap.bundle.min.js"></script>
    <link href="../style/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../style/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Include jQuery script -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="sb-nav-fixed">
<?php include '../includes/topnav.php'?>>
<div id="layoutSidenav">
    <?php include '../includes/sidenav.php';?>
    <?php include '../includes/inc_patmodal/add_patmodal.php';?>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addPatronModal">New Patron</button>
                        </div>

                        <div class="table-responsive" style="overflow: auto;">
                            <div class="container-fluid px-4">
                                <div class="row">
                                    <div class="col">

                                        <ol class="breadcrumb mb-4">
                                            <!-- Any Content Here -->
                                        </ol>
                                        <div class="card mb-3">
                                            <div class="card-header" style="background-color: #EADBC8; font-size: 20px; font-weight: bold;">
                                                <i class="fas fa-table me-1"></i>
                                                Patron List
                                            </div>
                                            <div class="card-body">

                                                <table id="datatablesSimple" class="table table-bordered table-striped" style="font-size:12px">
                                                    <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Library Number</th>
                                                        <th>First Name</th>
                                                        <th>Middle Name</th>
                                                        <th>Last Name</th>
                                                        <th>Gender</th>
                                                        <th>Age</th>
                                                        <th>Birthdate</th>
                                                        <th>Address</th>
                                                        <th>Contact</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($patrons as $patron) : ?>
                                                            <tr>
                                                                <td style="font-size: 15px;"><?= $patron['fullName']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['lib_num']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['fName']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['mInitial']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['lName']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['gender']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['age']; ?></td>
                                                                <td style="font-size: 15px;"><?= date("F j, Y", strtotime($patron['b_date'])); ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['address']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['contact_num']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['user_email']; ?></td>
                                                                <td style="font-size: 15px;"><?= $patron['user_pass']; ?></td>
                                                                <td class="text-center">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-<?php echo $patron['active'] == 1 ? 'success' : 'danger'; ?>" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                                                            <?php echo $patron['active'] == 1 ? 'Active' : 'Inactive'; ?>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <a href="../includes/inc_patmodal/edit_patmodal.php?edit=<?php echo $patron['user_ID']?>" class="btn btn-primary btn-sm" style="font-size:10px" data-bs-toggle="modal" data-bs-target="#edit_patModal">
                                                                    Edit
                                                                </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php include '../includes/inc_patmodal/edit_patmodal.php';?>
                                                    </tbody>


                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        success: function (response) {
                            if (response.status === "success") {
                                alert(response.message);
                                $('#addPatronModal').modal('hide'); // Hide the modal
                                $('#editForm')[0].reset(); // Reset the form fields
                                location.reload(); // Reload the page after successful update
                            } else {
                                alert(response.message);
                            }
                        },
                    </script>
                    <script>
                        function updateActiveStatus(user_ID, status) {
                            // Send an AJAX request to update_active_status.php
                            $.ajax({
                                type: "POST",
                                url: "update_active_status.php",
                                data: { user_ID: user_ID, status: status },
                                success: function(response) {
                                    // Reload the page or update UI as needed
                                    location.reload(); // Reload the page to reflect the changes
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    </script>


                    <script>
                        function submitForm() {
                            document.getElementById("searchForm").submit();
                        }
                    </script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Hide the specific columns
                            $('table#datatablesSimple th:nth-child(3), table#datatablesSimple td:nth-child(3)').hide(); // First Name
                            $('table#datatablesSimple th:nth-child(4), table#datatablesSimple td:nth-child(4)').hide(); // Middle Name
                            $('table#datatablesSimple th:nth-child(5), table#datatablesSimple td:nth-child(5)').hide(); // Last Name
                        });
                    </script>
                    <script>
                        function updateActiveStatus(userID) {
                            $.ajax({
                                type: 'POST',
                                url: 'patron.php', // Update this with the correct URL
                                data: { userID: userID },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        // Toggle the button color and text
                                        var button = $('[data-user-id="' + userID + '"]');
                                        if (response.active === 1) {
                                            button.removeClass('btn-danger').addClass('btn-success').text('Active');
                                        } else {
                                            button.removeClass('btn-success').addClass('btn-danger').text('Inactive');
                                        }
                                    } else {
                                        alert('Failed to update active status.');
                                    }
                                },
                                error: function() {
                                    alert('Error updating active status.');
                                }
                            });
                        }
                    </script>
                    <script>
                        $(document).ready(function () {
                            // Handle form submission
                            $("#editForm").submit(function (event) {
                                event.preventDefault(); // Prevent the default form submission
                                // Make AJAX request
                                $.ajax({
                                    type: "POST",
                                    url: "patron.php",
                                    data: $(this).serialize(), // Serialize the form data
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.status === "success") {
                                            alert(response.message);
                                            location.reload(); // Reload the page after successful update
                                            
                                            $("#editForm")[0].reset();
                                        } else {
                                            alert(response.message);
                                        }
                                    },
                                    error: function () {
                                        alert("Error during AJAX request");
                                    }
                                });
                            });
                        });

                    </script>
                    <script>
                        $(document).ready(function() {
                            // Assuming your modal ID is 'edit_patModal'
                            $('#edit_patModal').on('show.bs.modal', function(event) {
                                var $button = $(event.relatedTarget); // Button that triggered the modal
                                var $tr = $button.closest('tr'); // Find the closest parent row
                                var $tds = $tr.find('td'); // Find all td elements within the row

                                // Map the text content of each td and store it in an array
                                var data = $tds.map(function() {
                                    return $(this).text().trim(); // Trim to remove leading/trailing whitespaces
                                }).get();

                                // Remove elements 12, 13, and 14
                                data.splice(12, 3);

                                // Log the data to the console
                                console.log(data);

                                // Assuming your input fields have the following IDs
                                $('#fullName').val(data[0]);
                                $('#fName').val(data[2]);
                                $('#mInitial').val(data[3]);
                                $('#lName').val(data[4]);


                                $('#gender').val(data[5]);
                                $('#age').val(data[6]);

                                // Check if the date is in the expected format "yyyy-MM-dd"
                                var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
                                if (dateRegex.test(data[7])) {
                                    $('#b_date').val(data[7]);
                                } else {
                                    // Handle the case where the date is not in the expected format
                                    console.error('Invalid date format:', data[7]);
                                    // You might want to provide a default value or handle this differently based on your use case
                                }
                                $('#address').val(data[8]);
                                $('#contact_num').val(data[9]);
                                $('#user_email').val(data[10]);
                                $('#user_pass').val(data[11]);
                                $('#active').val(data[13]);

                            });
                        });
                    </script>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                    <script src="../style/js/scripts.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
                    <script src="../style/js/datatables-simple-demo.js"></script>


                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
