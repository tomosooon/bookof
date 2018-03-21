# -*-coding:utf-8-*-

from flask import Flask, jsonify, request
from block_chain import BlockChain

# Instantiate the Node
app = Flask(__name__)

block_chain = BlockChain()

@app.route('/', methods=['GET'])
def index():
    return "Hello, World", 200

@app.route('/register', methods=['POST'])
def register_book():
    values = request.get_json()

    required = ['sender', 'name', 'isbn', 'book_material_id']
    if not all(k in values for k in required):
        return 'Missing values', 400

    _create_block(values, 'register')

    response = {
        'message': 'Register request has been accepted.'
    }

    return jsonify(response), 200

@app.route('/request', methods=['POST'])
def request_book():
    values = request.get_json()

    required = ['sender', 'isbn', 'request_id', 'from_date']
    if not all(k in values for k in required):
        return 'Missing values', 400

    _create_block(values, 'request')

    response = {
        'message': 'Request request has been accepted.'
    }

    return jsonify(response), 200

@app.route('/accept', methods=['POST'])
def accept():
    values = request.get_json()

    required = ['sender', 'isbn', 'request_id', 'recipient']
    if not all(k in values for k in required):
        return 'Missing values', 400

    _create_block(values, 'accept')

    response = {
        'message': 'accept Request has been accepted.'
    }

    return jsonify(response), 200

@app.route('/review', methods=['POST'])
def review():
    values = request.get_json()

    required = ['sender', 'isbn', 'message', 'star']
    if not all(k in values for k in required):
        return 'Missing values', 400

    _create_block(values, 'review')

    response = {
        'message': 'Review request has been accepted.'
    }

    return jsonify(response), 200

def _get_transaction_by_request(request_values, kind):
    transaction = {'kind': kind}
    for k, v in request_values.items():
        transaction[k] = v

    return transaction

def _create_block(request_values, kind):
    transaction = _get_transaction_by_request(request_values, kind)

    block_chain.mine(transaction)

if __name__ == '__main__':
    from argparse import ArgumentParser

    parser = ArgumentParser()
    parser.add_argument('-p', '--port', default=5000, type=int, help='port to listen on')
    args = parser.parse_args()
    port = args.port

    app.run(host='0.0.0.0', port=port)
