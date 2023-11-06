<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Login</title>
    <link rel="icon" href={{asset('images/mathayog-kite.png')}} type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('css/login.css') }}>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url('/images/background.png')">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="left-text">
                    <p class="left-text-content">
                        <img src="{{ asset('images/mathayog.png') }}" class="" alt="mathayog"><br><br>
                        Buksan ang mga Lihim ng mga Lungsod sa Buong Pilipinas Gamit ang Matematika
                    </p>
                </div>
                <div class="login-box">
                    <h2>Sali na sa Nakaka-eksite na Adventure sa Pamamagitan ng Pag-Login!</h2>

                    <form id="loginForm" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form2Example31"/>
                                <label class="form-check-label" for="form2Example31">Remember me</label>
                            </div>
                            <div class="forgot-password">
                                <a href="#!" class="forgot-password">Forgot password?</a>
                            </div>
                        </div>
                        <div class="btn-container">
                            <button type="submit" class="btn" name="loginBtn" id="loginBtn">Mag-Login</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="signup-link">Don't have an account? <a class="signup" href="{{ route('register') }}">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Check if "remember me" is checked and populate fields if needed
        window.addEventListener('load', () => {
            const rememberMeCheckbox = document.getElementById('form2Example31');
            const emailField = document.getElementById('email');
            const passwordField = document.getElementById('password');
    
            // Check if "remember me" is enabled in localStorage
            const isRemembered = localStorage.getItem('rememberMeEnabled') === 'true';
            if (isRemembered) {
                rememberMeCheckbox.checked = true; // Check the checkbox
            }
    
            // Populate fields if "remember me" is enabled
            if (rememberMeCheckbox.checked) {
                const email = localStorage.getItem('rememberedEmail');
                const password = localStorage.getItem('rememberedPassword');
                if (email && password) {
                    emailField.value = email;
                    passwordField.value = password;
                }
            }
    
            // Handle form submission
            const loginForm = document.querySelector('form');
            loginForm.addEventListener('submit', (event) => {
                if (rememberMeCheckbox.checked) {
                    // If "remember me" is checked, save email and password to localStorage
                    const email = emailField.value;
                    const password = passwordField.value;
                    localStorage.setItem('rememberedEmail', email);
                    localStorage.setItem('rememberedPassword', password);
                    localStorage.setItem('rememberMeEnabled', 'true'); // Mark "Remember me" as enabled
                } else {
                    // If "remember me" is not checked, clear the remembered values
                    localStorage.removeItem('rememberedEmail');
                    localStorage.removeItem('rememberedPassword');
                    localStorage.removeItem('rememberMeEnabled'); // Mark "Remember me" as disabled
                }
            });
        });
    </script>

</body>
</html>