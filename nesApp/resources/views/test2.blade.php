<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@foreach ($bills as $bill)
    <p class="billy" data-bill-id="{{ $bill->id }}">Hóa đơn ID: {{ $bill->id }}</p>
    <table class="orders" id="orders-{{ $bill->id }}" >
        <table class="orders" id="orders-{{ $bill->id }}" border="1">
            <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Name</th>
                    <th scope="col">Size</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bill->orders as $order)
                <tr>
                    <td>{{ $order->product->image }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->size }}</td>
                    <td>${{ $order->product->price }} x {{ $order->quantity }}</td>
                    <td>${{ number_format($order->product->price * $order->quantity, 2) }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

<!-- Table để hiển thị kết quả -->
<table id="displayTable" border="1">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Sản phẩm</th>
            <th>Kích thước</th>
            <th>Số lượng</th>
        </tr>
    </thead>
    <tbody>
        <!-- Dữ liệu sẽ được copy vào đây -->
    </tbody>
</table>

<script>
$(document).ready(function () {
    $('.billy').click(function () {
        let billId = $(this).data('bill-id');

        // Lấy bảng ẩn tương ứng với Bill ID
        let ordersTable = $(`#orders-${billId}`);

        // Copy nội dung của bảng ẩn vào bảng chính
        $('#displayTable tbody').html(ordersTable.find('tbody').html());

        // Optional: Cuộn đến bảng nếu cần
        $('html, body').animate({
            scrollTop: $("#displayTable").offset().top
        }, 500);
    });
});


</script>