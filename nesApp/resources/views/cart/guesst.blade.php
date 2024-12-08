<x-app-layout>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr data-product-id="{{ $item['product_id'] }}">
                    <td><a href="#"><i class="far fa-times-circle"></i></a></td>
                    <td><img src="{{ asset($item['product_image']) }}" alt=""></td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['size'] }}</td>
                    <td class="price">${{ number_format($item['price'], 2) }}</td>
                    <td><input type="number" value="{{ $item['quantity'] }}" class="quantity" min="1"></td>
                    <td class="subtotal">$0.00</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply coupon</h3>
            <div>
                <form id="couponForm">
                    <input type="text" id="couponCode" placeholder="Enter your coupon" required>
                    <button type="submit" class="normal">Apply</button>
                </form>
                <div id="result" class="mt-3"></div>
            </div>
        </div>
        
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart subtotal</td>
                    <td>$<span id="cart-total">0.00</span></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<span id="total-price">0.00</span></strong></td>
                </tr>
                <tr>
                    <td><strong>Discount Amount</strong></td>
                    <td><strong>$<span id="discount-amount">0.00</span></strong></td>
                </tr>
                <tr>
                    <td><strong>Discounted Total</strong></td>
                    <td><strong>$<span id="discountedPrice">0.00</span></strong></td>
                </tr>
            </table>
            <button class="normal">Proceed to checkout</button>
            <div id="applied-coupons" class="mt-3">
                <h4>Applied Coupons:</h4>
                <ul></ul>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let appliedCoupons = []; // Array to hold applied coupons

            function updateCartTotals() {
                let total = 0;

                $('tbody tr').each(function() {
                    const priceText = $(this).find('.price').text();
                    const price = parseFloat(priceText.replace('$', '').replace(',', '').trim());
                    const quantity = parseInt($(this).find('.quantity').val());

                    if (isNaN(price) || isNaN(quantity)) {
                        return;
                    }

                    const subtotal = price * quantity;
                    $(this).find('.subtotal').text(`$${subtotal.toFixed(2)}`);
                    total += subtotal;
                });

                $('#cart-total').text(total.toFixed(2));
                $('#total-price').text(total.toFixed(2));
                applyDiscounts(total); // Calculate discounts after getting total
            }

            function applyDiscounts(originalTotal) {
                let totalDiscount = 0;

                appliedCoupons.forEach(coupon => {
                    const discountValue = parseFloat(coupon.discount);

                    if (discountValue <= 100) {
                        totalDiscount += (originalTotal * (discountValue / 100)); 
                    } else {
                        totalDiscount += discountValue;
                    }
                });

                const discountedPrice = originalTotal - totalDiscount;
                $('#discount-amount').text(totalDiscount.toFixed(2)); 
                $('#discountedPrice').text(discountedPrice >= 0 ? discountedPrice.toFixed(2) : 0);
                displayAppliedCoupons();
            }

            function displayAppliedCoupons() {
                const couponList = $('#applied-coupons ul');
                couponList.empty(); 
                appliedCoupons.forEach(coupon => {
                    const discountValue = parseFloat(coupon.discount);
                    couponList.append(`<li>${coupon.code}: ${discountValue <= 100 ? discountValue + '%' : '$' + discountValue}</li>`);
                });
            }

            $('.quantity').on('change', function() {
                const newQuantity = $(this).val();
                const productId = $(this).closest('tr').data('product-id');

                $.ajax({
                    url: '/cart/update',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: newQuantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        updateCartTotals();
                    },
                    error: function(xhr) {
                        console.error('Error updating quantity:', xhr);
                    }
                });
            });

            $('#couponForm').on('submit', function(e) {
                e.preventDefault();

                const code = $('#couponCode').val();
                $.ajax({
                    url: '/coupon/' + code,
                    method: 'GET',
                    success: function(response) {
                        const discount = response.data.discount; 
                        appliedCoupons.push({ code: response.data.code, discount: discount });
                        const originalTotal = parseFloat($('#total-price').text());
                        applyDiscounts(originalTotal);
                        $('#result').html('<div class="alert alert-success">Coupon code <strong>' + response.data.code + '</strong> applied! Discount: ' + (discount <= 100 ? discount + '%' : '$' + discount) + '</div>');
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred.';
                        $('#result').html('<div class="alert alert-danger">' + message + '</div>');
                    }
                });
            });

            updateCartTotals();
        });
    </script>
</x-app-layout>


<x-app-layout>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr data-product-id="{{ $item['product_id'] }}">
                    <td><a href="#"><i class="far fa-times-circle"></i></a></td>
                    <td><img src="{{ asset($item['product_image']) }}" alt=""></td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['size'] }}</td>
                    <td class="price">${{ number_format($item['price'], 2) }}</td>
                    <td><input type="number" value="{{ $item['quantity'] }}" class="quantity" min="1"></td>
                    <td class="subtotal">$0.00</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply coupon</h3>
            <div>
                <form id="couponForm">
                    <input type="text" id="couponCode" placeholder="Enter your coupon" required>
                    <button type="submit" class="normal">Apply</button>
                </form>
                <div id="result" class="mt-3"></div>
            </div>
            <div >
                <br>
                Tên người nhận <input type="text" class="rec-name"><br><br>
                Số điện thoại <input type="text" class="rec-sdt"><br><br>
                Địa chỉ <input type="text" class="rec-dc"><br><br>
                <button class="nhan">Gửi</button>

            </div>
        </div>
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart subtotal</td>
                    <td>$<span id="cart-total">0.00</span></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<span id="total-price">0.00</span></strong></td>
                </tr>
                <tr>
                    <td><strong>Discount Amount</strong></td>
                    <td><strong>$<span id="discount-amount">0.00</span></strong></td>
                </tr>
                <tr>
                    <td><strong>Discounted Total</strong></td>
                    <td><strong>$<span id="discountedPrice">0.00</span></strong></td>
                </tr>
            </table>
            <button class="normal" id="placeOrderBtn">Proceed to checkout</button>
            <div id="applied-coupons" class="mt-3">
                <h4>Applied Coupons:</h4>
                <ul></ul>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
       
            let appliedCoupons = []; 

            function updateCartTotals() {
                let total = 0;

                $('tbody tr').each(function() {
                    const priceText = $(this).find('.price').text();
                    const price = parseFloat(priceText.replace('$', '').replace(',', '').trim());
                    const quantity = parseInt($(this).find('.quantity').val());

                    if (isNaN(price) || isNaN(quantity)) {
                        return;
                    }

                    const subtotal = price * quantity;
                    $(this).find('.subtotal').text(`$${subtotal.toFixed(2)}`);
                    total += subtotal;
                });

                $('#cart-total').text(total.toFixed(2));
                $('#total-price').text(total.toFixed(2));
                applyDiscounts(total); 
            }

            function applyDiscounts(originalTotal) {
                let totalDiscount = 0;

                appliedCoupons.forEach(coupon => {
                    const discountValue = parseFloat(coupon.discount);

                    if (discountValue <= 100) {
                        totalDiscount += (originalTotal * (discountValue / 100)); 
                    } else {
                        totalDiscount += discountValue;
                    }
                });

                const discountedPrice = originalTotal - totalDiscount;
                $('#discount-amount').text(totalDiscount.toFixed(2)); 
                $('#discountedPrice').text(discountedPrice >= 0 ? discountedPrice.toFixed(2) : 0);
                displayAppliedCoupons();
            }

            function displayAppliedCoupons() {
                const couponList = $('#applied-coupons ul');
                couponList.empty(); 
                appliedCoupons.forEach(coupon => {
                    const discountValue = parseFloat(coupon.discount);
                    couponList.append(`<li>${coupon.code}: ${discountValue <= 100 ? discountValue + '%' : '$' + discountValue}</li>`);
                });
            }

                $('#placeOrderBtn').click(function() {
                    let cartItems = @json(session('cart', []));
                    let total = parseFloat($('#total-price').text()) || 0;
                    let discount_amount = parseFloat($('#discount-amount').text()) || 0;
                    let discountedTotal = parseFloat($('#discountedPrice').text()) || 0;
                    let name = $('.rec-name').val();
                    let sdt = $('.rec-sdt').val();
                    let dc = $('.rec-dc').val();

                    $.ajax({
                        url: '{{ route("orders.cat") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart: cartItems,
                            total: total,
                            discount_amount: discount_amount,
                            discounted_total: discountedTotal
                            name: name,
                            sdt: sdt,
                            dc: dc
                        },
                        success: function(response) {
                            alert('Orders created successfully!');
                            alert(response);
                        },
                        error: function(xhr) {
                            alert('Error occurred: ' + xhr.responseText);
                            console.log(xhr.responseText);
                        }
                    });
                });

            $('#couponForm').on('submit', function(e) {
                e.preventDefault();

                const code = $('#couponCode').val();
                $.ajax({
                    url: '/coupon/' + code,
                    method: 'GET',
                    success: function(response) {
                        const discount = response.data.discount; 
                        appliedCoupons.push({ code: response.data.code, discount: discount });
                        const originalTotal = parseFloat($('#total-price').text());
                        applyDiscounts(originalTotal);
                        $('#result').html('<div class="alert alert-success">Coupon code <strong>' + response.data.code + '</strong> applied! Discount: ' + (discount <= 100 ? discount + '%' : '$' + discount) + '</div>');
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred.';
                        $('#result').html('<div class="alert alert-danger">' + message + '</div>');
                    }
                });
            });
            $(document).on('change', '.quantity', function() {
                updateCartTotals();
            });
            $(document).on('change', '.quantity', function() {
            const quantity = $(this).val();
            const productId = $(this).closest('tr').data('product-id');

            $.ajax({
                url: '/cart/update', 
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    updateCartTotals(); 
                },
                error: function(xhr) {
                    console.error('Error updating quantity:', xhr.responseText);
                }
            });
        });
            updateCartTotals();
        });
    </script>
</x-app-layout>