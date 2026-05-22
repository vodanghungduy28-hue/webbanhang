<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <h1>Thêm danh mục mới</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="POST" action="/webbanhang/Category/save">
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="/webbanhang/Category" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<?php include 'app/views/shares/footer.php'; ?>