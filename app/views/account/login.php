<?php include 'app/views/shares/header.php'; ?>
<section class="vh-100 bg-light">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4 text-center">Login</h2>
                        <p class="text-muted text-center mb-4">Please enter your login and password.</p>
                        <form action="/webbanhang/account/checklogin" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a class="text-decoration-none" href="#!">Forgot password?</a>
                            </div>
                            <button class="btn btn-primary btn-lg w-100" type="submit">Login</button>
                        </form>
                        <div class="text-center mt-4">
                            <p class="mb-0">Don't have an account? <a href="/webbanhang/account/register" class="text-primary fw-bold">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'app/views/shares/footer.php'; ?>