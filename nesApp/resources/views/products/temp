<x-app-layout>
    <section id="cart" class="section-p1">
        <div>
            <table id="productsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Kích thước</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr data-id="{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ asset($product->image) }}" width="100%" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @if ($product->sizes->isEmpty())
                                No sizes available
                            @else
                                <ul>
                                    @foreach ($product->sizes as $size)
                                        <li>{{ $size->size }} {{ $size->stock }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product) }}" method="DELETE" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
                
            </table>
        </div>
    </section>
    
    <!-- Modal for editing product -->
    <div id="editProductModal" class="modal">
        <div class="modal-content">
            <section id="cart" class="section-p1">
                <span class="close">&times;</span>
            <h3>Chỉnh sửa Sản phẩm</h3>
            <form id="productForm">
                <input type="hidden" id="productId" name="id">
                <div>
                    <label for="productName">Tên sản phẩm</label>
                    <input type="text" id="productName" name="name" required>
                </div>
                <div>
                    <label for="productDescription">Mô tả</label>
                    <textarea id="productDescription" name="description" required></textarea>
                </div>
                <div>
                    <label for="productPrice">Giá</label>
                    <input type="number" id="productPrice" name="price" required>
                </div>
                <button type="submit">Cập nhật</button>
            </form>
            </section>
        </div>
    </div>
    
    <script>
    $(document).ready(function() {
        // Mở modal khi nhấp vào hàng
        $('#productsTable tbody tr').click(function() {
            var id = $(this).data('id');
            var name = $(this).find('td:nth-child(3)').text();
            var description = $(this).find('td:nth-child(4)').text();
            var price = $(this).find('td:nth-child(5)').text();
    
            // Điền thông tin vào form chỉnh sửa
            $('#productId').val(id);
            $('#productName').val(name);
            $('#productDescription').val(description);
            $('#productPrice').val(price);
    
            // Hiện modal
            $('#editProductModal').css('display', 'block');
        });
    
        // Đóng modal khi nhấp vào nút "X"
        $('.close').click(function() {
            $('#editProductModal').css('display', 'none');
        });
    
        // Đóng modal khi nhấp ra ngoài modal
        $(window).click(function(event) {
            if ($(event.target).is('#editProductModal')) {
                $('#editProductModal').css('display', 'none');
            }
        });
    
        // Xử lý sự kiện submit form
        $('#productForm').submit(function(e) {
            e.preventDefault();
            // Thực hiện cập nhật sản phẩm qua AJAX
            var formData = $(this).serialize();
            $.ajax({
                url: '/update-product', // Đường dẫn đến API cập nhật sản phẩm
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert('Cập nhật thành công!');
                    location.reload(); // Tải lại trang để cập nhật hiển thị
                },
                error: function() {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
        var form = $(this).closest('form');

    if (confirm('Bạn có chắc chắn muốn xóa?')) {
        $.ajax({
            url: form.attr('action'),
            type: 'DELETE',
            data: form.serialize(),
            success: function(response) {
                alert('Sản phẩm đã được xóa thành công!');
                location.reload(); // Tải lại trang
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
});
    });
    </script>
    
</x-app-layout>