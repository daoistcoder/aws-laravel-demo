<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="icon" href={{asset('images/mathayog-kite.png')}} type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url('/images/signupbg.png')">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="left-text">
                    <p class="left-text-content">
                        <img src="{{ asset('images/mathayog.png') }}" class="" alt="mathayog"><br><br>
                        Maglibot-libot sa Pagsusuri ng Matematika sa Buong Pilipinas
                    </p>
                </div>
                <div class="register-box">
                    <h2>Sama na sa Adbentura at Simulan ang Iyong Paglalakbay!</h2>

                    <form id="registerForm" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="name-fields">
                                <div class="form-group firstn-width">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname">
                                </div>
                                <div class="form-group lastn-width">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="emapassword_confirmationil">
                        </div>
                        <div class="btn-container">
                            <button type="submit" class="btn" name="registerBtn" id="registerBtn">Mag-Register</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="login-link">Already have an account? <a class="login" href="{{ route('login') }}">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
