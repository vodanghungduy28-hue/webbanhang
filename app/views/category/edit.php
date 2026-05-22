<?php include 'app/views/shares/header.php'; ?>
<?php $category = $category ?? (object) ['id' => '', 'name' => '', 'description' => '']; ?>
<div class="container mt-4">
    <h1>Sửa danh mục</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="POST" action="/webbanhang/Category/update">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?>">
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="/webbanhang/Category" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<?php include 'app/views/shares/footer.php'; ?>