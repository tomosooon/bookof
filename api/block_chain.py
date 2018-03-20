# -*-coding:utf-8-*-

import hashlib
import json
import file_util
from time import time
import os

# 環境変数にchain_fileがなければ、/var2/data.chainにする
CHAIN_FILEPATH = os.getenv("CHAIN_FILE", "/var2/data.chain")


class BlockChain:
    """
    1トランザクションにつき、1ブロックを追加する
    """
    chain = []

    def __init__(self):
        # jsonファイルからchainを取得する
        self._initialize_chain()

    def _initialize_chain(self):
        self._set_genesis_block()
        previous_chains = file_util.read_file(CHAIN_FILEPATH)
        self.chain.extend(previous_chains)

    def _set_genesis_block(self):
        GENESIS_BLOCK = {"index": 0,
           "time": time(),
           "transactions": [],
           "previous_hash": 1,
           "proof": 100
          }
        self.chain.append(GENESIS_BLOCK)

    def mine(self, transaction):
        previous_hash = self._hash(self.chain[-1])
        proof = self._proof_of_work(previous_hash)
        block = {
            'index': len(self.chain),
            'timestamp': time(),
            'transaction': transaction,
            'proof': proof,
            'previous_hash': previous_hash
        }
        # blockを保存する
        file_util.write_file(CHAIN_FILEPATH, block)
        self.chain.append(block)
        return block

    def _proof_of_work(self, previous_hash):
        nonce = 0
        while self._valid_nonce(nonce, previous_hash) is False:
            nonce += 1

        return nonce

    def _valid_nonce(self, nonce, last_hash):
        guess = f'{nonce}{last_hash}'.encode()
        guess_hash = hashlib.sha256(guess).hexdigest()
        return guess_hash[:1] == "0"

    def _hash(self, block):
        block_string = json.dumps(block, sort_keys=True).encode()
        return hashlib.sha256(block_string).hexdigest()
