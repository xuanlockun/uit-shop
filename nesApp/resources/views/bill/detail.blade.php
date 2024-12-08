<x-app-layout>
    <section id="cart" class="section-p1">
        <h2>Chi tiết hóa đơn</h2>
        <table width="100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bill->orders as $order)
                    <tr data-product-id="{{ $order->product->id }}">
                        <td><img src="{{ asset($order->product->image) }}" alt=""></td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->size }}</td>
                        <td class="price">${{ number_format($order->product->price, 2) }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td class="subtotal">${{ number_format($order->product->price * $order->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        {{-- <div id="coupon">
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
        </div> --}}

        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<span id="total-price">{{ $bill->total }}</span></strong></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Discount Amount</strong></td>
                    <td><strong>$<span id="discount-amount">{{ $bill->discount_amount }}</span></strong></td>
                </tr>
                <tr>
                    <td><strong>Discounted Total</strong></td>
                    <td><strong>$<span id="discountedPrice">{{ $bill->discount_total }}</span></strong></td>
                </tr>
            </table>
            {{-- <div id="applied-coupons" class="mt-3">
                <h4>Applied Coupons:</h4>
                <ul></ul>
            </div> --}}
        </div>
    </section>

</x-app-layout>
