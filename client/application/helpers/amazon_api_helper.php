<?php
function loadBookInformation($isbm) {

    define("ACCESS_KEY_ID"     , 'AKIAJ44T2YGZSGJ6APZQ');
    define("SECRET_ACCESS_KEY" , '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');
    define("ASSOCIATE_TAG"     , 'k315k1010-22');
    define("ACCESS_URL"        , 'https://aws.amazonaws.jp/onca/xml');

    $baseParam = 'AWSAccessKeyId='.ACCESS_KEY_ID;

    $params = array();
    $params['Service']        = 'AWSECommerceService';
    $params['Version']        = '2013-08-01';
    $params['Operation']      = 'ItemLookup';
    $params['ItemId']         = $isbn;
    $params['IdType']         = 'ISBN';
    $params['SearchIndex']    = 'Books';
    $params['AssociateTag']   = ASSOCIATE_TAG;
    $params['ResponseGroup']  = 'ItemAttributes,Offers, Images ,Reviews '; // 必要なレスポンスを設定(詳しくは下で説明)
    $params['Timestamp']      = gmdate('Y-m-d\TH:i:s\Z');

    //パラメータを自然順序付け・昇順で並び替え
    ksort($params);

    $canonicalString = $baseParam;
    foreach ($params as $k => $v) {
        $canonicalString .= '&'.urlencode_RFC3986($k).'='.urlencode_RFC3986($v);
    }

    function urlencode_RFC3986($str) {
        return str_replace('%7E', '~', rawurlencode($str));
    }

    $parsed_url = parse_url(ACCESS_URL);
    $string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";

    $signature = base64_encode(
                        hash_hmac('sha256', $string_to_sign, SECRET_ACCESS_KEY, true)
                    );

    $url = ACCESS_URL.'?'.$canonical_string.'&Signature='.urlencode_RFC3986($signature);

    $response = file_get_contents($url); //Amazonへレスポンス

    // レスポンスを配列で取得
    $parsed_xml = null;
    if (isset($response)) {
        $parsed_xml = simplexml_load_string($response);
    }

    // Amazonへのレスポンスが正常に行われていたら Book_model のインスタンスを生成して返す
    if ($response &&
        isset($parsed_xml) &&
        !$parsed_xml->faultstring &&
        !$parsed_xml->Items->Request->Errors) {

        $item = $parsed_xml->Items[0];
        $book = new Book_model;

        $title = $current->ItemAttributes->Title; // タイトル
        // 管理しやすいように文字コードの宣言やスペースの削除等を行う
        $title = mb_convert_kana($title, "as", "UTF-8");

        $book.init($isbn,$title);

        $author         = $current->ItemAttributes->Author; // 著者
        $authors = $author[0];
        // 著者が複数いる場合
        if (count($author) > 1) {
            for ($i = 1; $i < count($author); $i++) {
                $authors = $authors. ",". $author[$i];
            }
        }

        $book->$author       = $authors
        $book->$manufacturer = $current->ItemAttributes->Manufacturer; // 出版社
        $book->$imgURL       = $current->MediumImage->URL; // 本の表紙の中サイズのURL(サイズは小中大から選べる)

        return $book;
    } else return null;
}
?>