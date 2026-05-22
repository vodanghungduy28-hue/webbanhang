<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <h1>Giỏ hàng của bạn</h1>
    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">
            Giỏ hàng trống.
        </div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($cartItems as $item): ?>
                    <?php $subtotal = $item['price'] * $item['quantity']; ?>
                    <?php $total += $subtotal; ?>
                    <tr>
                        <td>
                            <?php if (!empty($item['image'])): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>" style="max-width: 80px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo (int)$item['quantity']; ?></td>
                        <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-right font-weight-bold">
            Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?> VND
        </div>
    <?php endif; ?>
    <a href="/webbanhang/Product/list" class="btn btn-secondary mt-3">Quay lại danh sách sản phẩm</a>
</div>
<?php include 'app/views/shares/footer.php'; ?>