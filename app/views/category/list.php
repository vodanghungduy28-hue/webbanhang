<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách danh mục</h1>
        <a href="/webbanhang/Category/add" class="btn btn-success">Thêm danh mục mới</a>
    </div>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <?php if (empty($categories)): ?>
        <div class="alert alert-info">Chưa có danh mục nào.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            <?php if (!empty($category->product_count)): ?>
                                <span class="badge badge-info ml-2"><?php echo (int)$category->product_count; ?> sản phẩm</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo nl2br(htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8')); ?></td>
                        <td>
                            <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <?php if (!empty($category->product_count)): ?>
                                <button type="button" class="btn btn-secondary btn-sm" disabled>Không thể xóa</button>
                            <?php else: ?>
                                <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php include 'app/views/shares/footer.php'; ?>