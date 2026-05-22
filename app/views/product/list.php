<?php include 'app/views/shares/header.php'; ?>
<div class="py-4">
    <h1 class="mb-4">Danh sách sản phẩm</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <article class="card product-card p-0 h-100 shadow-sm">
                    <?php if (!empty($product->image)): ?>
                        <div class="product-card-image">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid product-image">
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="product-card-body p-4">
                        <h2 class="product-title h5 mb-3">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h2>
                        <p class="text-muted mb-3 product-description"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-price fw-bold text-primary"><?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> USD</span>
                            <span class="badge bg-info text-dark"><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>