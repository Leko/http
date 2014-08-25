<?php

namespace Bolster\Http;

class Request
{
    /**
     * HTTPメソッド：GET
     * @var string
     */
    const METHOD_GET    = 'GET';

    /**
     * HTTPメソッド：POST
     * @var string
     */
    const METHOD_POST   = 'POST';

    /**
     * HTTPメソッド：PUT
     * @var string
     */
    const METHOD_PUT    = 'PUT';

    /**
     * HTTPメソッド：DELETE
     * @var string
     */
    const METHOD_DELETE = 'DELETE';

    /**
     * HTTPメソッド：PATCH
     * @var string
     */
    const METHOD_PATCH  = 'PATCH';

    // 送信オプションを指定
    // NOTE: http://www.php.net/manual/ja/context.http.php
    protected static $_default_context_options = array(
        'http' => array(
            'ignore_errors' => true,    // レスポンスコードが40x系でもレスポンスを取得する
        )
    );

    protected static $_default_headers = array(
        'Content-Type' => 'application/x-www-form-urlencoded',
    );

    /**
     * HTTP通信を行う
     * 
     * @param string $method  使用するHTTPメソッド
     * @param string $url     送信するURL
     * @param array  $params  送信するパラメータ。省略すると空配列
     * @param array  $headers 送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキスト。stream_context_createで生成できるコンテキストを指定。省略するとデフォルト設定で送信を行う
     */
    public function send($method, $url, array $params = array(), array $headers = array(), $context_options = array())
    {
        // デフォルトのヘッダと与えられたヘッダをマージ
        $headers = array_merge_recursive(self::$_default_headers, $headers);

        // key => value形式のヘッダからkey: value形式の文字列の配列へ変換
        $header = array();
        foreach ($headers as $key => $value) {
            $header[] = "{$key}: {$value}";
        }

        $context_options = array_merge_recursive(array(
            'http' => array(
                'method' => $method,
                'header' => implode("\r\n", $header),
            ),
        ), $context_options);

        // コンテキストを生成し送信
        $context       = stream_context_create($context_options);
        $response_text = file_get_contents($url, false, $context);

        return $response_text;
    }

    /**
     * GETメソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキストオプション。省略するとデフォルト設定で送信を行う
     * @return string サーバからのレスポンステキスト
     */
    public function get($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $url .= '?'.http_build_query($params);

        $response = static::send(self::METHOD_GET, $url, $params, $headers, $context_options);
        return $response;
    }

    /**
     * POSTメソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキストオプション。省略するとデフォルト設定で送信を行う
     * @return string サーバからのレスポンステキスト
     */
    public function post($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $context_options = array_merge_recursive(array(
            'http' => array(
                'content' => http_build_query($params),
            ),
        ), $context_options);

        $response = static::send(self::METHOD_POST, $url, $params, $headers, $context_options);
        return $response;
    }

    /**
     * PUTメソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキストオプション。省略するとデフォルト設定で送信を行う
     * @return string サーバからのレスポンステキスト
     */
    public function put($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $context_options = array_merge_recursive(array(
            'http' => array(
                'content' => http_build_query($params),
            ),
        ), $context_options);

        $response = static::send(self::METHOD_PUT, $url, $params, $headers, $context_options);
        return $response;
    }

    /**
     * DELETEメソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキストオプション。省略するとデフォルト設定で送信を行う
     * @return string サーバからのレスポンステキスト
     */
    public function delete($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $url .= '?'.http_build_query($params);

        $response = static::send(self::METHOD_DELETE, $url, $params, $headers, $context_options);
        return $response;
    }

    /**
     * PATCHメソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキストオプション。省略するとデフォルト設定で送信を行う
     * @return string サーバからのレスポンステキスト
     */
    public function patch($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $url .= '?'.http_build_query($params);

        $response = static::send(self::METHOD_PATCH, $url, $params, $headers, $context_options);
        return $response;
    }
}
