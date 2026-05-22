<?php include 'app/views/shares/header.php'; ?>
<div class="py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="mb-2">Quản lý sản phẩm</h1>
            <p class="text-muted mb-0">Thêm, sửa hoặc xóa sản phẩm dễ dàng từ giao diện quản lý.</p>
        </div>
        <a href="/webbanhang/Product/add" class="btn btn-primary btn-lg shadow-sm">Thêm sản phẩm mới</a>
    </div>

    <?php if (empty($products)): ?>
        <div class="alert alert-info">Hiện chưa có sản phẩm nào.</div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded bg-white">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></th>
                            <td>
                                <?php if (!empty($product->image)): ?>
                                    <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover; border-radius: 0.85rem;">
                                <?php else: ?>
                                    <span class="text-secondary">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo number_format($product->price, 0, ',', '.'); ?> USD</td>
                            <td>
                                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-sm btn-warning me-2">Sửa</a>
                                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php include 'app/views/shares/footer.php'; ?>