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

    $models = array(
        'users'         =>   array(),
        'requests'      =>   array(),
        'reviews'       =>   array(),
        'books'         =>   array(),
        'bookMaterials' =>   array()
    );

    foreach ($transactions as $transaction) {
        if (!array_key_exists('kind', $transaction)){
            continue;
        }
        switch ($transaction['kind']) {
            case 'register':
                # userがいなかったら追加
                # bookがなかったら追加
                # bookMaterialの追加

                $senderUserAddress = $transaction['sender'];
                $bookName = $transaction['name'];
                $isbn = $transaction['isbn'];
                $bookMaterialId = $transaction['book_material_id'];

                # userがなかったら追加
                if (!array_search($senderUserAddress, array_map(function($value) {
                    return $value->email;
                }, $models['users']))){
                    $user = new User_model();
                    $user->init($senderUserAddress);
                    $models['users'][] = $user;
                }

                # bookがなかったら追加
                if (!array_search($isbn, array_map(function($value) {
                    return $value->isbn;
                }, $models['books']))){
                    $book = new Book_model();
                    $book->init($isbn, $bookName);
                    $models['books'][] = $book;
                }

                # bookMaterialの追加, bookへのbookmaterialの追加, bookMaterialへのbookの追加
                $index = array_search($isbn, array_map(function($value) {
                    return $value->isbn;
                }, $models['books']));

                $bookMaterial = new BookMaterial_model();
                $bookMaterial->init($models['books'][$index], $bookMaterialId);
                $models['bookMaterials'][] = $bookMaterial;
                $models['books'][$index]->bookMaterials[] = $bookMaterial;

                # userへのbookmaterialの追加, bookMaterialへのuserのついか
                $index = array_search($senderUserAddress, array_map(function($value) {
                    return $value->email;
                }, $models['users']));
                $models['users'][$index]->bookMaterials[] = $bookMaterial;
                $bookMaterial->user = $models['users'][$index];

                break;
            case 'request':
                # userがいなかったら追加
                # requestの追加
                # userへのヒモ付
                # bookへのヒモ付
                $senderUserAddress = $transaction['sender'];
                $isbn = $transaction['isbn'];
                $requestId = $transaction['request_id'];
                $fromDate = $transaction['from_date'];

                # userがいなかったら追加
                if (!array_search($senderUserAddress, array_map(function($value) {
                    return $value->email;
                }, $models['users']))){
                    $user = new User_model();
                    $user->init($senderUserAddress);
                    $models['users'][] = $user;
                }

                # requestの追加
                $bookIndex = array_search($isbn, array_map(function($value) {
                    return $value->isbn;
                }, $models['books']));
                $userIndex = array_search($senderUserAddress, array_map(function($value) {
                    return $value->email;
                }, $models['users']));

                $request = new Request_model();
                $request->init($models['books'][$bookIndex], $models['users'][$userIndex], $fromDate, $requestId);
                $models['requests'][] = $request;

                $models['users'][$userIndex]->requests[] = $request;
                $models['books'][$bookIndex]->requests[] = $request;

                break;
            case 'accept':
                $isbn = $transaction['isbn'];
                $requestId = $transaction['request_id']; # リクエストのuniqueId

                # 該当するrequestを処理済みにする
                $index = array_search($requestId, array_map(function($value) {
                    return $value->requestId;
                }, $models['requests']));

                $models['requests'][$index]->isAccepted = true;
                break;
            case 'review':
                # userがいなかったら追加
                # reviewの追加
                # userへのヒモ付
                # bookへのヒモ付
                $senderUserAddress = $transaction['sender'];
                $isbn = $transaction['isbn'];
                $message = $transaction['message'];
                $star = $transaction['star'];

                if (!array_search($senderUserAddress, array_map(function($value) {
                    return $value->email;
                }, $models['users']))){
                    $user = new User_model();
                    $user->init($senderUserAddress);
                    $models['users'][] = $user;
                }


                # reviewの追加
                $bookIndex = array_search($isbn, array_map(function($value) {
                    return $value->isbn;
                }, $models['books']));
                $userIndex = array_search($senderUserAddress, array_map(function($value) {
                    return $value->email;
                }, $models['users']));

                $review = new Review_model();
                $review->init($models['books'][$bookIndex], $models['users'][$userIndex], $star, $message);
                $models['reviews'][] = $review;
                $models['books'][$bookIndex]->reviews[] = $review;

                break;
            default:
                break;
        }
    }

    return $models;
}

  ?>
