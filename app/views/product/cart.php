<?php include 'app/views/shares/header.php'; ?>
<h1>Giỏ hàng</h1>
<div id="zero-quantity-warning" class="alert alert-warning d-none" role="alert">
    Sản phẩm có số lượng 0 sẽ bị xóa khi cập nhật giỏ hàng. Bạn không thể thanh toán cho đến khi cập nhật giỏ hàng.
</div>
<?php if (!empty($cart)): ?>
    <?php
    $cartTotal = 0;
    foreach ($cart as $item) {
        $cartTotal += $item['quantity'] * $item['price'];
    }
    ?>
    <form id="cart-form" action="/webbanhang/Product/updateCart" method="post">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $id => $item): ?>
                    <?php $lineTotal = $item['quantity'] * $item['price']; ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                            <?php if (!empty($item['image'])): ?>
                                <div class="mt-2">
                                    <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" style="max-width: 100px;">
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo number_format($item['price'], 2); ?> USD</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary quantity-decrease" data-item-id="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">-</button>
                                </div>
                                <input
                                    type="number"
                                    name="quantities[<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>]"
                                    value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>"
                                    min="0"
                                    class="form-control cart-quantity"
                                    data-price="<?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-item-id="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>"
                                >
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary quantity-increase" data-item-id="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">+</button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Nhập 0 để xóa sản phẩm.</small>
                        </td>
                        <td>
                            <span class="line-total" data-item-id="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo number_format($lineTotal, 2); ?>
                            </span>
                            USD
                        </td>
                        <td>
                            <a href="/webbanhang/Product/removeFromCart/<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right font-weight-bold">Tổng cộng</td>
                    <td colspan="2" class="font-weight-bold">
                        <span id="cart-total"><?php echo number_format($cartTotal, 2); ?></span> USD
                    </td>
                </tr>
            </tfoot>
        </table>
        <a href="/webbanhang/Product" class="btn btn-secondary">Tiếp tục mua sắm</a>
        <button type="button" id="checkout-button" class="btn btn-success">Thanh toán</button>
    </form>
    <script>
        var checkoutButton = document.getElementById('checkout-button');
        var cartForm = document.getElementById('cart-form');
        var updateTimer = null;

        function submitCartForm() {
            if (cartForm) {
                cartForm.submit();
            }
        }

        function scheduleCartUpdate() {
            if (updateTimer) {
                clearTimeout(updateTimer);
            }
            updateTimer = setTimeout(submitCartForm, 600);
        }

        function updateCartTotals() {
            var total = 0;
            var hasZeroQuantity = false;
            document.querySelectorAll('.cart-quantity').forEach(function(input) {
                var quantity = parseInt(input.value, 10) || 0;
                var price = parseFloat(input.dataset.price) || 0;
                var itemId = input.dataset.itemId;
                var lineTotal = quantity * price;
                var lineTotalElement = document.querySelector('.line-total[data-item-id="' + itemId + '"]');
                if (lineTotalElement) {
                    lineTotalElement.textContent = lineTotal.toFixed(2);
                }
                if (quantity === 0) {
                    hasZeroQuantity = true;
                }
                total += lineTotal;
            });
            var cartTotalElement = document.getElementById('cart-total');
            if (cartTotalElement) {
                cartTotalElement.textContent = total.toFixed(2);
            }
            var warning = document.getElementById('zero-quantity-warning');
            if (warning) {
                warning.classList.toggle('d-none', !hasZeroQuantity);
            }
            if (checkoutButton) {
                checkoutButton.disabled = hasZeroQuantity;
            }
        }

        document.querySelectorAll('.cart-quantity').forEach(function(input) {
            input.addEventListener('input', function() {
                if (parseInt(this.value, 10) === 0) {
                    var confirmDelete = confirm('Số lượng giảm về 0. Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?');
                    if (!confirmDelete) {
                        this.value = 1;
                    }
                }
                updateCartTotals();
                scheduleCartUpdate();
            });
        });

        document.querySelectorAll('.quantity-increase').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = this.dataset.itemId;
                var input = document.querySelector('.cart-quantity[data-item-id="' + itemId + '"]');
                if (input) {
                    input.value = parseInt(input.value, 10) + 1 || 1;
                    updateCartTotals();
                    scheduleCartUpdate();
                }
            });
        });

        document.querySelectorAll('.quantity-decrease').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = this.dataset.itemId;
                var input = document.querySelector('.cart-quantity[data-item-id="' + itemId + '"]');
                if (input) {
                    var current = parseInt(input.value, 10) || 0;
                    var newValue = current - 1;
                    if (newValue === 0) {
                        var confirmDelete = confirm('Số lượng giảm về 0. Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?');
                        if (!confirmDelete) {
                            return;
                        }
                    }
                    input.value = newValue >= 0 ? newValue : 0;
                    updateCartTotals();
                    scheduleCartUpdate();
                }
            });
        });

        if (checkoutButton) {
            checkoutButton.addEventListener('click', function() {
                updateCartTotals();
                if (this.disabled) {
                    alert('Bạn không thể thanh toán khi có sản phẩm số lượng 0. Vui lòng cập nhật giỏ hàng trước.');
                    return;
                }
                window.location.href = '/webbanhang/Product/checkout';
            });
        }
        updateCartTotals();
    </script>
<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
    <a href="/webbanhang/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>
<?php endif; ?>
<?php include 'app/views/shares/footer.php'; ?>