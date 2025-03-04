<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #111;
        }
        .form-container {
            background-color: #000;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        h3 {
            font-size: 2rem;
            color: #fff;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
            color: #fff;
        }
        .btn-success {
            background-color: #6e7dff;
            border-color: #6e7dff;
        }
        .btn-success:hover {
            background-color: #3a51ff;
            border-color: #3a51ff;
        }
        .footer-link {
            color: #fff;
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
        .text-danger {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="text-center mb-4">
                <h3>Create Your Account</h3>
                <p class="text-muted">Fill in the details to get started</p>
            </div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="devisi" class="form-label">Divisi</label>
                    <div class="position-relative">
                        <select class="form-control" id="devisi" name="devisi" required>
                            <option value="">Select a Divisi</option>
                            <option value="IT" {{ old('devisi') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Admin" {{ old('devisi') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Digital" {{ old('devisi') == 'Digital' ? 'selected' : '' }}>Digital</option>
                        </select>
                        <i class="fas fa-chevron-down position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                    </div>
                    @error('devisi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>



                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <i class="eye-icon" id="togglePassword" onclick="togglePassword()">👁️</i>
                </div>
                <div class="mb-3 position-relative">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <i class="eye-icon" id="toggleConfirmPassword" onclick="toggleConfirmPassword()">👁️</i>
                </div>
                <button type="submit" class="btn btn-success w-100">Register</button>
                <div class="mt-3 text-center">
                    <a class="footer-link" href="{{ route('login') }}">Already have an account? Login here</a>
                </div>
            </form>
        </div>
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

        function toggleConfirmPassword() {
            const passwordField = document.getElementById('password_confirmation');
            const icon = document.getElementById('toggleConfirmPassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.innerHTML = "🙈"; // Change icon to 'Hide'
            } else {
                passwordField.type = "password";
                icon.innerHTML = "👁️"; // Change icon to 'Show'
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</body>
</html>
