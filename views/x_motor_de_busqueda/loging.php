<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Travel Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 900px;
            width: 100%;
        }
        .promo-side {
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .promo-side h2 { font-size: 3rem; font-weight: bold; }
        .coupon-box {
            background: white;
            color: #2193b0;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .login-side {
            padding: 50px;
        }
        .btn-login {
            background-color: #5bc0de;
            border: none;
            color: white;
            padding: 12px;
            font-weight: bold;
        }
        .btn-login:hover { background-color: #46b8da; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-container row g-0">
        <div class="col-md-6 promo-side d-none d-md-flex">
            <div class="mb-4 w-100 text-start px-3"><strong>COMPANY LOGO</strong></div>
            <h2>50% OFF</h2>
            <p class="fs-4">for new user</p>
            <img src="https://cdn-icons-png.flaticon.com/512/201/201331.png" width="150" class="my-4" alt="Plane icon" style="filter: brightness(0) invert(1);">
            <div class="d-flex align-items-center">
                <span class="me-2">COUPON CODE</span>
                <div class="coupon-box">NEWUSER</div>
            </div>
        </div>

        <div class="col-md-6 login-side">
            <h2 class="fw-bold">Login</h2>
            <p class="text-muted small">Welcome! Login to get amazing discounts and offers only for you.</p>

            <form action="auth.php" method="POST" class="mt-4">
                <div class="mb-3">
                    <label class="form-label text-muted small">User Name</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Remember me</label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login text-uppercase">Login</button>
                </div>

                <div class="mt-4 d-flex justify-content-between small">
                    <span>New User? <a href="#" class="text-decoration-none">Signup</a></span>
                    <a href="#" class="text-muted text-decoration-none">Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>