<?php
//未使用クラス
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
        $this->checkEncoding($_GET);
        $this->checkEncoding($_POST);
        $this->checkEncoding($_COOKIE);
        //$_GET,$_POST,$_COOKIEの文字エンコーディングをチェック
        $this->checkNull($_GET);
        $this->checkNull($_POST);
        $this->checkNull($_COOKIE);
    }
    //配列要素に含まれている文字エンコーディングをチェック
    private function checkEncoding(array $data){
        foreach($data as $key => $value){
            if(!mb_check_encoding($value)){ //与えられた値が内部文字コードと違ったら処理
                $this->errors[] = "{$key}は不正な文字コードです";
            }
        }
    }

    //配列要素に含まれるnullバイトをチェックする
    private function checkNull(array $data){
        foreach($data as $key => $value){
            if(preg_match('/\0/',$value)){
                $this->errors[] = "{$key}は不正な文字を含んでいます";
            }
        }
    }
        
   //必須検証-1
    public function requiredCheck($value, string $name){
        if(trim($value) === ''){
            $this->errors[] = '<p style="color:red;">' . $name . "は必須入力です</p>";
        }
    }

    //文字列長検証($len文字以内であるか-2
    public function lengthCheck($value,string $name,int $len){
        if(trim($value) !== ''){
            if(mb_strlen($value) < $len){
                $this->errors[] = '<p style="color:red;">' . $name . "は" . $len . "文字以上で入力してください</p>";
            }
        }
    }

    //整数型検証-
    public function intTypeCheck($value, string $name){
        if(trim($value) !== ''){
            if(!ctype_digit($value)){
                $this->errors[] = '<p style="color:red;">' . $name . "は数値で指定してください</p>";
            }
        }
    }

    // //数値検証範囲($min~$maxの範囲にあるか)
    // public function rangeCheck(string $value, string $name, float $max, float $min){
    //     if(trim($value) !== ''){
    //         if($value > $max || $value < $min){
    //             $this->errors[] = "{$name}は{$min}~{$max}で指定してください";
    //         }
    //     }
    // }
    // //正規表現パターン(パターン$patternに合致するか)
    // public function regexCheck(string $value, string $name, string $pattern){
    //     if(trim($value) !== ''){
    //         if(!preg_match($pattern,$value)){
    //             $tmp = implode(', ', $opts);
    //             $this->errors[] = "{$name}は正しい形式で入力してください";
    //         }
    //     }
    // }
    
    // //配列要素検証(配列$opsの要素のいずれかであるか)
    // public function inArrayCheck(string $value, string $name, array $opts){
    //     if(trim($value) !== ''){
    //         if(!in_array($value, $opts)){
    //             $tmp = implode(',',$opts);
    //             $this->errors[] = "{$name}は{$tmp}の中から選択してください";
    //         }
    //     }
    // }

    //プライベート変数errorsにエラー情報が含まれている場合には表示
    public function __invoke(){
        if(count($this->errors) > 0){
            foreach($this->errors as $err){
                print $err;
            }
        }
    }
}

$v = new MyValidator();

$v->requiredCheck($_POST['address'],"住所");
$v->requiredCheck($_POST['age'],"年齢");
$v->requiredCheck($_POST['email'],"メールアドレス");
$v->requiredCheck($_POST['password'],"パスワード");
$v->requiredCheck($_POST['callnumber'],"電話番号");


    

