<?php include 'app/views/shares/header.php'; ?>
<section class="vh-100 bg-light">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4 text-center">Register</h2>
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $err): ?>
                                        <li><?php echo htmlspecialchars($err); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="/webbanhang/account/save" method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fullname" class="form-label">Fullname</label>
                                    <input type="text" class="form-control form-control-lg" id="fullname" name="fullname" placeholder="Fullname" required>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirmpassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control form-control-lg" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5">Register</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <p class="mb-0">Already have an account? <a href="/webbanhang/account/login" class="text-primary fw-bold">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'app/views/shares/footer.php'; ?>