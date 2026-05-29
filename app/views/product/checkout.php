<?php include 'app/views/shares/header.php'; ?>
<h1>Thanh toán</h1>
<?php
$cart = isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : [];
$checkoutTotal = 0;
?>
<?php if (!empty($cart)): ?>
    <div class="card mb-4">
        <div class="card-header bg-light font-weight-bold">Thông tin sản phẩm thanh toán</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <?php $subtotal = $item['quantity'] * $item['price']; $checkoutTotal += $subtotal; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo number_format($item['price'], 2); ?> USD</td>
                            <td><?php echo (int)$item['quantity']; ?></td>
                            <td><?php echo number_format($subtotal, 2); ?> USD</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Tổng thanh toán</th>
                        <th><?php echo number_format($checkoutTotal, 2); ?> USD</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">Giỏ hàng của bạn hiện đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.</div>
<?php endif; ?>
<form method="POST" action="/webbanhang/Product/processCheckout">
    <div class="form-group">
        <label for="name">Họ tên:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ:</label>
        <textarea id="address" name="address" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary"<?php echo empty($cart) ? ' disabled' : ''; ?>>Thanh toán</button>
</form>
<a href="/webbanhang/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ hàng</a>
<?php include 'app/views/shares/footer.php'; ?>