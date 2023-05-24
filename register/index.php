<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("Location: https://yoooot.live/shop/");
    }

    # Include the connection file
    include_once "../php/connection.php";

    # Check if the user is already logged in
    if(isset($_SESSION['user'])){
        header("Location: https://yoooot.live/shop/");
    }

    # Check if the user has submitted the form
    if(isset($_POST['submit'])){
        # Get the data from the form
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        # Check if the passwords match
        if($password == $confirm_password){
            # Check if the username is already taken
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                echo "<script>alert('Username already taken!');</script>";
            }else{
                # Check if the email is already taken
                $sql = "SELECT * FROM users WHERE email='$email'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<script>alert('Email already taken!');</script>";
                }else{
                    # Insert the data into the database
                    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                    if($conn->query($sql) === TRUE){
                        echo "<script>alert('Account created successfully!');</script>";
                        header("Location: https://yoooot.live/login/");
                    }else{
                        echo "<script>alert('Error creating account!');</script>";
                    }
                }
            }
        }else{
            echo "<script>alert('Passwords do not match!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>yoooot | best shop</title>

        <!-- Main CSS -->
        <link rel="stylesheet" href="/css/style.css">

        <!-- Parts of CSS -->
        <link rel="stylesheet" href="/css/parts/navbar.css">
        <link rel="stylesheet" href="/css/parts/container.css">
        <link rel="stylesheet" href="/css/parts/hero.css">
        <link rel="stylesheet" href="/css/parts/forms.css">
        <link rel="stylesheet" href="/css/parts/buttons.css">
        <link rel="stylesheet" href="/css/parts/footer.css">

        <!-- JS -->
        <script src="/js/script.js"></script>
    </head>
    <body>
        <div class="form">
            <form method="POST">
                <h1>Register</h1>
                <input type="text" placeholder="Username" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confirm_password" required>

                <input type="submit" value="Register">
                <p>Already have an account? <a href="https://yoooot.live/login/">Login</a></p>
            </form>
        </div>
    </body>
</html>
