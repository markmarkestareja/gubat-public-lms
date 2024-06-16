<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="LMSLandingPage/image/LibLogo1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>

    <style>
        body {
            /* background-color: linear-gradient(to right, #cea130, #dabd73, #cea130); */
            background-image: url('images/cover4.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/cover4.jpg'); /* Same background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(10px); /* Adjust the blur radius as needed */
            opacity: 0.8; /* Adjust the opacity of the blur overlay */
            z-index: -1; /* Ensure the pseudo-element is behind other content */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.7); /* Adjust the opacity by changing the last value (0.5 represents 50% opacity) */
        }
        header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px;
            margin: auto;
        }

        .gradient-btn {
            background: linear-gradient(to right, #525e73, #303c54, #525e73);
            color: #f6eadc;
            border: 2px solid #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .gradient-btn:hover {
            background: #8b949b;
            color: #f6eadc;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            margin-right: 20px;
        }

        .right-container {
            margin: auto; 
            width: 400px; 
            padding: 20px; 
        }

        
        .password-container {
            position: relative;
        }

        .password-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        
        .login-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px; 
        }

        .create-account {
            font-size: 14px;
            color: #333;
            margin-right: 20px; 
        }
    </style>

</head>
<body>
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
    <?php
    // Check if success message exists in session
    if (isset($_SESSION['success_message'])) {
        echo '<div id="successMessage" class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
        // Unset the session variable to remove the message after displaying it
        unset($_SESSION['success_message']);
    }
    ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main><br><br><br>
                <div class="container">
                    <!-- Right container for login form -->
                    <div class="row justify-content-center">
                        <div class="col-md-6 right-container">
                            <div class="card shadow-lg border-0 rounded-lg mt-5" style="margin: 0 auto;">
                                <div class="d-flex align-items-center">
                                    <!-- Logo -->
                                    <img src="images/logo.png" alt="Library Logo" height="110" class="d-inline-block align-text-top me-2 ms-2 mt-2">
                                    <!-- Title -->
                                    <h2 class="text-center font-weight-heavy mt-4 mb-2 p-2"><strong>GUBAT PUBLIC LIBRARY MANAGEMENT SYSTEM</strong></h2>
                                </div>
                                <div class="card-body">
                                    <form action="includes/filesproccess/loginprocess.php" method="post">
                                        <div class="form-floating mb-2">
                                            <input class="form-control" id="username" name="username" type="text" placeholder="Username" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3 password-container">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                                            <label for="password">Password</label>
                                            <i class="bi bi-eye-slash password-icon" id="togglePassword"></i>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-4 mb-0 login-form">
                                            <button class="submit gradient-btn"><a href="index.php" class="text-white" style="text-decoration: none; position: left;">Cancel</a></button>
                                            <button type="submit" class="submit gradient-btn">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordField = document.getElementById("password");
            var icon = document.getElementById("togglePassword");

            if (passwordField.getAttribute('type') === 'password') {
                passwordField.setAttribute('type', 'text');
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordField.setAttribute('type', 'password');
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>
    <script>
        // Function to hide the success message after 5 seconds
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
