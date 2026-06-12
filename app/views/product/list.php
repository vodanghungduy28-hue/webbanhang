<?php include 'app/views/shares/header.php'; ?>
<section class="home-banner mb-5 rounded-4 overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-light text-dark mb-3 d-inline-block">THEGIOIDIDONGFAKE</span>
                <h1 class="banner-title">Công nghệ đời mới, trải nghiệm đỉnh cao.</h1>
                <p class="banner-text">Mua sắm tiện lợi, giao hàng nhanh, giá tốt mỗi ngày. Khám phá bộ sưu tập điện
                    thoại, laptop và phụ kiện giá cạnh tranh.</p>
                <div class="mt-4">
                    <a href="#product-list" class="btn btn-light btn-lg me-3">Khám phá ngay</a>
                    <a href="/webbanhang/Product/cart" class="btn btn-outline-dark btn-lg">Xem giỏ hàng</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner-feature-card p-4 ms-lg-4">
                    <h5 class="mb-3 text-dark">Ưu điểm nổi bật</h5>
                    <ul class="list-unstyled text-white-75 mb-0">
                        <li class="mb-2">✅ Giá tốt, hàng chính hãng</li>
                        <li class="mb-2">✅ Giao hàng nhanh trong 24h</li>
                        <li class="mb-2">✅ Hỗ trợ đổi trả dễ dàng</li>
                        <li class="mb-2">✅ Dịch vụ khách hàng tận tâm</li>
                        <li class="mb-2">✅ Thanh toán linh hoạt</li>
                        <li class="mb-2">✅ Bảo hành chính hãng</li>
                        <li class="mb-2">✅ Uy tín - Chất lượng - E là không thể</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="py-4">
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="mb-1"></h1>
            <p class="text-muted mb-0">Tìm kiếm nhanh theo tên và danh mục sản phẩm.</p>
        </div>
        <span class="badge bg-primary py-2 px-3">Hiện có <?php echo count($products); ?> sản phẩm</span>
    </div>
    <div class="card filter-card mb-4 shadow-sm">
        <div class="card-body">
            <form method="get" action="/webbanhang/Product/" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="search" class="form-label">Tìm theo tên sản phẩm</label>
                    <input type="text" id="search" name="search"
                        value="<?php echo isset($search) ? htmlspecialchars($search, ENT_QUOTES, 'UTF-8') : ''; ?>"
                        class="form-control form-control-lg" placeholder="Nhập tên sản phẩm...">
                </div>
                <div class="col-md-5">
                    <label for="category_id" class="form-label">Lọc theo danh mục</label>
                    <select id="category_id" name="category_id" class="form-select form-select-lg">
                        <option value="">Tất cả danh mục</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>" <?php echo isset($categoryId) && $categoryId == $category->id ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Lọc</button>
                </div>
            </form>
        </div>
    </div>
    <div id="product-list" class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <article class="card product-card p-0 h-100 shadow-sm">
                    <?php if (!empty($product->image)): ?>
                        <div class="product-card-image">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                    alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                                    class="img-fluid product-image">
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="product-card-body p-4">
                        <h2 class="product-title h5 mb-3">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>"
                                class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h2>
                        <p class="text-muted mb-3 product-description">
                            <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span
                                class="product-price fw-bold text-primary"><?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>
                                USD</span>
                            <span
                                class="badge bg-info text-dark"><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                                class="btn btn-outline-primary btn-sm">Thêm vào giỏ</a>
                            <a href="/webbanhang/Product/buyNow/<?php echo $product->id; ?>"
                                class="btn btn-success btn-sm">Mua ngay</a>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>

<h1>Danh sách sản phẩm</h1>
<a href="/webbanhang/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<ul class="list-group" id="product-list">
    <!-- Danh sách sản phẩm sẽ được tải từ API và hiển thị tại đây -->
</ul>
<?php include 'app/views/shares/footer.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/webbanhang/api/product')
            .then(response => response.json())
            .then(data => {
                const productList = document.getElementById('product-list');
                data.forEach(product => {
                    const productItem = document.createElement('li');
                    productItem.className = 'list-group-item';
                    productItem.innerHTML = `<h2><a
href="/webbanhang/Product/show/${product.id}">${product.name}</a></h2>
<p>${product.description}</p>
<p>Giá: ${product.price} USD</p>
<p>Danh mục: ${product.category_name}</p>
<a href="/webbanhang/Product/edit/${product.id}" class="btn btnwarning">Sửa</a>
<button class="btn btn-danger"
onclick="deleteProduct(${product.id})">Xóa</button>`;
                    productList.appendChild(productItem);
                });
            });
    });
    function deleteProduct(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            fetch(`/webbanhang/api/product/${id}`, {
                method: 'DELETE'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Product deleted successfully') {
                        location.reload();
                    } else {
                        alert('Xóa sản phẩm thất bại');
                    }
                });
        }
    }
</script>