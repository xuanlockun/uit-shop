import mysql.connector
import pandas as pd

host = "localhost"
user = "root"
password = ""
database = "nes-test"

cnx = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=database,
    charset='utf8mb4'
)

if cnx.is_connected():
    print("\033[92mKết nối thành công!\033[0m")
else:
    print("\033[91mKết nối thất bại!\033[0m")

def export_mysql_table_to_csv(table_name, query):
    try:
        cursor = cnx.cursor()
        cursor.execute(query)
        results = cursor.fetchall()
        df = pd.DataFrame(results, columns=[desc[0] for desc in cursor.description])
        df.to_csv(f"{table_name}.csv", index=False, encoding='utf-8-sig')
        print(f"Dữ liệu đã được lưu vào file '{table_name}.csv'")
        cursor.close()
        cnx.close()
    except mysql.connector.Error as err:
        print(f"\033[91m{err}\033[0m")

# Xuất dữ liệu từ bảng products và product_sizes
export_mysql_table_to_csv(
    "products",
    """
    SELECT 
        p.id AS product_id,
        p.name AS product_name,
        p.price AS product_price,
        p.description AS product_description,
        p.image AS product_image,
        ps.size AS product_size,
        ps.stock AS product_stock
    FROM 
        products p
    JOIN 
        product_sizes ps ON p.id = ps.product_id
    ORDER BY 
        p.id, ps.size;
    """
)