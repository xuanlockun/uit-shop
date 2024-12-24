import csv
from flask import Flask, request, jsonify
from together import Together
from flask_cors import CORS
from sklearn.feature_extraction.text import TfidfVectorizer


api_key = "9cd00d4757a1a9cdb058fd86170dfdd4a8f0cf13a475f2e9eb7197ab772f256c"  
client = Together(api_key=api_key)

app = Flask(__name__)
CORS(app)

def read_products_from_csv(file_path):
    products = []
    with open(file_path, mode='r', newline='', encoding='utf-8-sig') as file:
        reader = csv.DictReader(file)
        for row in reader:
            products.append(row)
    return products

def ask_together_api(query, context):
    messages = [
        {"role": "user", "content": f"{query}\n\nContext: {context}"}
    ]
    
    stream = client.chat.completions.create(
        model="meta-llama/Meta-Llama-3.1-8B-Instruct-Turbo",
        messages=messages,
        stream=True,
    )

    response = ""
    for chunk in stream:
        response += chunk.choices[0].delta.content or ""
    
    return response

@app.route('/api/suggest', methods=['POST'])
def suggest_products():
    user_query = request.json.get('query')  
    products = read_products_from_csv('products.csv')

    context = "\nPlease ensure that the product names are returned as HTML links in the format a href http://127.0.0.1:8000/products/product_id\n".join([
        f'product_id: {product["id"]}, Name: <strong>{product["name"]}</strong>, Price: <strong>{product["price"]}</strong>, Stock: <strong>{product["stock"]}</strong>'
        for product in products
    ])
    # context = "\n".join([f'product_id: {product["id"]}, Name: <a href="http://127.0.0.1:8000/products/{product["id"]}"><strong>{product["name"]}</strong></a>, Price: <strong>{product["price"]}</strong>, Stock: <strong>{product["stock"]}</strong>' for product in products ])
    response = ask_together_api(user_query, context)
    return jsonify({"response": response})

if __name__ == '__main__':
    app.run(port=6969, debug=True)