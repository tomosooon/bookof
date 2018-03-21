# -*-coding:utf-8-*-

import codecs
import json
import os

def read_file(filepath):
    """
    :param filepath: jsonファイルのパス
    :return json_dict: jsonを辞書に変換したオブジェクト, エラー
    """
    json_dicts = []
    if os.path.exists(filepath):
        with open(filepath) as f:
            for line in f:
                json_dicts.append(json.loads(line.replace("\n", "")))
    return json_dicts

def write_file(filepath, json_dict):
    """
    :param filepath: jsonファイルパス
    :param json_dict: jsonを辞書に変換したオブジェクト
    """
    json_str = json.dumps(json_dict)
    f = codecs.open(filepath, 'a')
    f.write(json_str+'\n')
