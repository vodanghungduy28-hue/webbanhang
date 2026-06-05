<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thegioididongfake</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/webbanhang/public/css/style.css">
</head>

<body>
    <?php
    // Ensure SessionHelper is available and session started
    if (!class_exists('SessionHelper')) {
        require_once __DIR__ . '/../../helpers/SessionHelper.php';
    }
    SessionHelper::start();

    $cartCount = 0;
    $cartTotal = 0;
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;
            $price = isset($item['price']) ? (float) $item['price'] : 0;
            $cartCount += $quantity;
            $cartTotal += $quantity * $price;
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/webbanhang/Product/">THEGIOIDIDONGFAKE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/">Sản phẩm</a>
                </li>
                <?php if (SessionHelper::isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/manage">Quản lý sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Category/">Quản lý danh mục</a>
                    </li>
                <?php endif; ?>
                <?php if (SessionHelper::isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/cart">
                        <span role="img" aria-label="Giỏ hàng">🛒</span> Giỏ hàng
                        <span class="badge badge-pill badge-primary">
                            <?php echo $cartCount > 0 ? $cartCount : 0; ?>
                        </span>
                        <?php if ($cartCount > 0): ?>
                            <small class="text-muted">(<?php echo number_format($cartTotal, 2); ?> USD)</small>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">