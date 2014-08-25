<?php

namespace Http\Parser;

class JsonParser implements ParserInterface
{
    /**
     * レスポンスをパースする
     * 
     * @param string $response_text レスポンステキスト
     * @return mixed 各自のフォーマットによってパースされたレスポンスデータ
     */
    public function parse($response_text)
    {
        return json_decode($response_text);
    }
}
