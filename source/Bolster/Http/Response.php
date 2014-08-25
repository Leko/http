<?php

namespace Http;

class Response
{
    public $method;
    public $statusCode;
    public $contentType;

    protected $_parser;

    /**
     * コンストラクタ
     * 
     * @param string          $response_text レスポンステキスト
     * @param \Http\Parser\ParserInterface $parser        レスポンスのパーザー。省略するとPlainParser(そのままのテキストを文字列で返す)が適用されます
     */
    public function __construct(\Http\Parser\ParserInterface $parser = null)
    {
        if(is_null($parser)) {
            $parser = new \Http\Parser\PlainParser();
        }

        $this->_parser = $parser;
    }

    /**
     * レスポンスのパースするパーザをセットする
     * 
     * @param \Http\Parser\ParserInterface $parser パーザのインスタンス
     * @return void
     */
    public function setParser(\Http\Parser\ParserInterface $parser)
    {
        $this->_parser = $parser;
    }

    /**
     * レスポンスをパースする
     * 
     * @param string $response_text レスポンステキスト
     * @return mixed パーザのパースメソッドの戻り値
     */
    public function parse($response_text)
    {
        $parsed = $this->_parser->parse($response_text);
        return $parsed;
    }
}
