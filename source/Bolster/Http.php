<?php

namespace Bolster;

class Http
{
    protected $_request;
    protected $_response;

    public function __construct()
    {
        $this->_request = new Http\Request();
        $this->_response = new Http\Response();
    }

    /**
     * レスポンスのパーザをセットする
     * 
     * @param Http\Parser\ParserInterface $parser パーザのインスタンス
     * @return void
     */
    public function setParser(Http\Parser\ParserInterface $parser)
    {
        $this->_response->setParser($parser);
    }

    /**
     * メソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキスト。stream_context_createで生成できるコンテキストを指定。省略するとデフォルト設定で送信を行う
     */
    public function get($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $response_text = $this->_request->get($url, $params, $headers, $context_options);
        $response      = $this->_response->parse($response_text);

        return $response;
    }

    /**
     * メソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキスト。stream_context_createで生成できるコンテキストを指定。省略するとデフォルト設定で送信を行う
     */
    public function post($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $response_text = $this->_request->post($url, $params, $headers, $context_options);
        $response      = $this->_response->parse($response_text);

        return $response;
    }

    /**
     * メソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキスト。stream_context_createで生成できるコンテキストを指定。省略するとデフォルト設定で送信を行う
     */
    public function put($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $response_text = $this->_request->put($url, $params, $headers, $context_options);
        $response      = $this->_response->parse($response_text);

        return $response;
    }

    /**
     * メソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキスト。stream_context_createで生成できるコンテキストを指定。省略するとデフォルト設定で送信を行う
     */
    public function delete($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $response_text = $this->_request->delete($url, $params, $headers, $context_options);
        $response      = $this->_response->parse($response_text);

        return $response;
    }

    /**
     * メソッドでHTTP通信を行う
     * 
     * @param string $url             送信するURL
     * @param array  $params          送信するパラメータ。省略すると空配列
     * @param array  $headers         送信するHTTPヘッダ。省略すると空配列
     * @param array  $context_options 送信に使用するコンテキスト。stream_context_createで生成できるコンテキストを指定。省略するとデフォルト設定で送信を行う
     */
    public function patch($url, array $params = array(), array $headers = array(), $context_options = array())
    {
        $response_text = $this->_request->patch($url, $params, $headers, $context_options);
        $response      = $this->_response->parse($response_text);

        return $response;
    }
}
