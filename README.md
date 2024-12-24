# UIT-Shop: Web Bán Quần Áo Online

UIT-Shop là dự án web bán quần áo online, được phát triển nhằm hỗ trợ sinh viên UIT trong môn học Lập Trình Web.

## Cơ Cấu Dự Án

### 1. **Thư mục `nesApp`**
- Chứa mã nguồn server PHP Laravel.
- Các tính năng chính:
  - Quản lý danh mục sản phẩm.
  - Thêm/sửa/xóa sản phẩm.
  - Xử lý thanh toán và đơn hàng.
  - Tích hợp API cho chatbot.

### 2. **Thư mục `rag`**
- Chứa tool để thu thập và xử lý dữ liệu cho RAG chatbot.
- Các tính năng:
  - Tạo và huấn luyện chatbot nhặm cung cấp thông tin nhanh chóng cho người dùng.
  - Thu thập dữ liệu từ nhiều nguồn khác nhau.

## Yêu Cầu Hệ Thống

- **Server**: PHP >= 8.1, Composer
- **Cơ sở dữ liệu**: MySQL >= 8.0
- **Môi trường**: Python 3 
- **Thư viện**: Laravel >= 10.x

## Hướng Dẫn Cài Đặt

1. Clone repository:
   ```bash
   git clone https://github.com/username/uit-shop.git
   cd uit-shop
   ```

2. Thiết lập môi trường Laravel:
   ```bash
   cd nesApp
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
   Cập nhật thông tin cơ sở dữ liệu trong file `.env`.

3. Chạy migration để tạo cơ sở dữ liệu:
   ```bash
   php artisan migrate
   ```

4. Cài đặt các phụ thuộc trong thư mục `rag` (nếu có):
   ```bash
   cd rag
   python final.py
   ```

## Hướng Dẫn Sử Dụng

1. Khởi động server Laravel:
   ```bash
   php artisan serve
   ```

2. Truy cập website:
   - URL: [http://localhost:8000](http://localhost:8000)

3. Kết nối RAG chatbot:
   - Cấu hình API và khởi chạy chatbot trong thư mục `rag`.

