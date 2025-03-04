<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #111;
            /* Dark background */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        /* Container for login form */
        
        .login-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 3rem;
            border-radius: 15px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        h3 {
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
        }
        
        .form-label {
            font-weight: bold;
            color: #bbb;
        }
        
        .btn-primary {
            background-color: #6e7dff;
            border-color: #6e7dff;
        }
        
        .btn-primary:hover {
            background-color: #3a51ff;
            border-color: #3a51ff;
        }
        
        .footer-link {
            color: #bbb;
        }
        
        .footer-link:hover {
            color: #6e7dff;
        }
        
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 35px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .login-container {
                width: 85%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h3>Login</h3>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="mb-4 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                <i class="eye-icon" id="togglePassword" onclick="togglePassword()">
                    👁️
                </i>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('togglePassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.innerHTML = "🙈"; // Change icon to 'Hide'
            } else {
                passwordField.type = "password";
                icon.innerHTML = "👁️"; // Change icon to 'Show'
            }
        }
    </script>
</body>

</html>