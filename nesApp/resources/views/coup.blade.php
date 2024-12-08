<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm Tra Coupon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Kiểm Tra Coupon</h1>
        <form id="couponForm">
            <div class="form-group">
                <label for="couponCode">Nhập mã coupon:</label>
                <input type="text" class="form-control" id="couponCode" placeholder="Mã coupon" required>
            </div>
            <button type="submit" class="btn btn-primary">Kiểm Tra</button>
        </form>
        <div class="mt-3">
            <h4>Tổng tiền: <span id="totalMoney">1000</span> VNĐ</h4>
            <h4>Giá sau khi áp dụng coupon: <span id="discountedPrice">1000</span> VNĐ</h4>
        </div>
        <div id="result" class="mt-3"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            const originalTotal = 1000; // Tổng tiền ban đầu
            $('#totalMoney').text(originalTotal);

            $('#couponForm').on('submit', function(e) {
                e.preventDefault();
                
                const code = $('#couponCode').val();
                $.ajax({
                    url: '/coupon/' + code,
                    method: 'GET',
                    success: function(response) {
                        const discount = parseFloat(response.data.discount);
                        const discountedPrice = originalTotal - discount;
                        $('#discountedPrice').text(discountedPrice >= 0 ? discountedPrice.toFixed(2) : 0);
                        $('#result').html('<div class="alert alert-success">Coupon hợp lệ: ' + JSON.stringify(response.data) + '</div>');
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON ? xhr.responseJSON.message : 'Đã xảy ra lỗi.';
                        $('#result').html('<div class="alert alert-danger">' + message + '</div>');
                        $('#discountedPrice').text(originalTotal.toFixed(2));
                    }
                });
            });
        });
    </script>
</body>
</html>