<?php
// .chain ⇒ 各モデルに変換

# chainの読み込み処理
function loadChainData() {

    $file = fopen(BASEPATH."sample_data/sample_data.chain","r"); #相対パスへのアクセス
    // $file = fopen("/tmp/sample_data.chain","r"); #絶対パスへのアクセス
    $arr = [];
    if ($file) {
        while($line = fgets($file)) {
            $arr[] = json_decode($line, true);
        }
    }
    fclose($file);

    echo "-----------------------\n";
    $transactionsList = array_map(function($value) {
        return $value['transactions'];
    }, $arr);

    $transactions = array_reduce($transactionsList, function($carry, $item) {
        return array_merge($carry, $item);
    }, []);

    # chainのモデルへの変換
    $users = array();
    $requests = array();
    $reviews = array();
    $books = array();
    $bookMaterials = array();

    $models = array(
        'users'         =>   $users,
        'requests'      =>   $requests,
        'reviews'       =>   $reviews,
        'books'         =>   $books,
        'bookMaterials' =>   $bookMaterials
    );

    $data = '';

    foreach ($transactions as $transaction) {
        if (!array_key_exists('kind', $transaction)){
            continue;
        }
        switch ($transaction['kind']) {
            case 'register':
                $data .= 'register\n';
                break;
            case 'request':
                $data .= 'request\n';
                break;
            case 'accept':
                $data .= 'accept\n';
                break;
            case 'review':
                $data .= 'review\n';
                break;
            default:
                # code...
                break;
        }
    }

    return $data;
  }

  ?>
