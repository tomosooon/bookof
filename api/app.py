# -*-coding:utf-8-*-

from flask import Flask, jsonify, request
from block_chain import BlockChain

# Instantiate the Node
app = Flask(__name__)

block_chain = BlockChain()

@app.route('/register', methods=['POST'])
def register():
    values = request.get_json()

    required = ['sender', 'name', 'isbn', 'uuid']
    if not all(k in values for k in required):
        return 'Missing values', 400

    _create_block(values, 'register')

    response = {
        'message': 'Register request has been accepted.'
    }

    return jsonify(response), 200

@app.route('/request', methods=['POST'])
def request():
    values = request.get_json()

    required = ['isbn', 'from_date']
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

    required = ['isbn', 'request_index', 'recipient']
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

    required = ['isbn', 'message', 'star', 'sender']
    if not all(k in values for k in required):
        return 'Missing values', 400

    _create_block(values, 'review')

    response = {
        'message': 'Review request has been accepted.'
    }

    return jsonify(response), 200

def _get_transaction_by_request(request_json, kind):
    transaction = {'kind': kind}
    for k, v in request_json.items():
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
