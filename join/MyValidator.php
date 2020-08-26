<?php
Class MyValidator{
    //エラーメッセージを格納するための変数
    private $errors;

    //コンストラクタ
    public function __construct(string $encoding = 'UTF-8'){
        //プライベート変数$errorsを初期化
        $errors = [];
        //内部コードを設定
        mb_internal_encoding($encoding);
        //$_GET,$_POST,$_COOKIEの文字エンコーディングをチェック
        $this->checkEncoding();
        $this->checkEncoding();
        $this->checkEncoding();
        //$_GET,$_POST,$_COOKIEの文字エンコーディングをチェック
        $this->checkNull();
        $this->checkNull();
        $this->checkNull();
    }
    //配列要素に含まれている文字エンコーディングをチェック
    private function checkEncoding(array $data){
        foreach($data as $key => $value){
            if(!mb_check_encoding($value)){
                $this->$errors[] = "{$key}は不正な文字コードです";
            }
        }
    }

    //配列要素に含まれるnullバイトをチェックする
    private function checkNull(array $data){
        foreach($data as $key => $value){
            if(preg_match('/\0/',$value)){
                $this->$errors[] = "{$key}は不正な文字を含んでいます";
            }
        }
    }
}