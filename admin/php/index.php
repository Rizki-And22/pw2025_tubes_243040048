<?php
session_start();
if (isset($_POST["login"])) {
    if ($_POST["username"] == "admin" && $_POST["password"] == "admin123") {
        $_SESSION['username'] = 'admin';
        header("Location: home.php");
        exit;
    } else {
        $error = true;
    }
}


?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lana Fest Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a0dad 0%, #b993d6 100%);
            min-height: 100vh;
        }

        .navbar {
            background-color: #fff !important;
            box-shadow: 0 2px 8px rgba(106, 13, 173, 0.1);
            border-radius: 0 0 20px 20px;
        }

        .login {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;

        }

        .card {
            border: none;
            border-radius: 1rem;
            background: #fff;
        }

        .card-title {
            color: #6a0dad;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #6a0dad;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4b087a;
        }

        .form-label {
            color: #6a0dad;
        }

        .logo-img {
            width: 50px;
            height: 50px;
        }

        .login h3 {
            margin-top: 10px;
            margin-left: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;

        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">

        <div class="container">
            <div class="login">
                <img src="../img/logo.png" alt="Logo" class="logo-img">
                <h3>LANA FEST</h3>
            </div>
        </div>
    </nav>

    <!-- Login Page -->
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:80vh;">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="../img/logo.png" alt="Logo" class="logo-img mb-2">
                            <h3 class="card-title mb-1">Admin Login</h3>
                            <p class="text-muted" style="font-size: 0.95rem;">Sign in to manage Lana Fest</p>
                        </div>
                        <form method="post" autocomplete="off">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </span>
                                    <input type="te xt" class="form-control" id="username" name="username" placeholder="Enter username" required autocomplete="username">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock-fill text-primary"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required autocomplete="current-password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">
                                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>
                            </div>
                            <div class="text-center">
                                <a href="#" class="small text-decoration-none text-secondary">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="text-white-50">© <?= date('Y') ?> Lana Fest. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                toggleIcon.classList.toggle('bi-eye');
                toggleIcon.classList.toggle('bi-eye-slash');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>