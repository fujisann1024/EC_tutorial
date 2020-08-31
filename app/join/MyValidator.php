<?php

class MyValidator{
    //プロパティ
    private $data;
    private $errors = [];
    private static $fields = ['name','address','age','email','password'];

    //コンストラクタ~インスタンスを生成したときに実行される

    public function __construct($post_data){
        //インスタンス生成時の引数が$dataに渡される
        $this->data = $post_data;
    }




    public function validateForm(){
        //自分自身のプロパティを$fieldとして繰り返す
        foreach(self::$fields as $field){
            //指定した配列のキーがあるかどうかを調べる->フォーム内にその項目があるかどうか
            if(!array_key_exists($field,$this->data)){
                //なければエラーメッセージを表示
                trigger_error("フォームは存在しません");
                return;
            }
        }
        //フォームがあるかを確認したのでメソッドを実行
        $this->validatorName();
        $this->validatorAddress();
        $this->validatorAge();
        $this->validatorEmail();
        $this->validatorPassword();
        $this->validatorTellphone();
        return $this->errors;
    }
    
    private function validatorName(){
        //trim ~ 送られてきた名前のPOSTの値がスペースを除いた文字列を返す
        $val = trim($this->data['name']);

        if(empty($val)) $this->addEmptyError('name','名前');
    }

    private function validatorAddress(){
        $val = trim($this->data['address']);

        if(empty($val)) $this->addEmptyError('address','住所');

    }
    
    private function validatorAge(){
        $val = trim($this->data['age']);

        if(empty($val)) $this->addEmptyError('age','年齢');
        
        if(!empty($val)) $this->intTypeCheck($val,'age','年齢');
    }

    private function validatorEmail(){
        $val = trim($this->data['email']);

        if(empty($val)) $this->addEmptyError('email','メールアドレス');
    
    }

    private function validatorPassword(){
        $val = trim($this->data['password']);

        if(empty($val)) $this->addEmptyError('password','パスワード');

        if(!empty($val)) $this->lengthCheck($val,'password','パスワード',8);
    }

    private function validatorTellphone(){
        $val = trim($this->data['tellphone']);

        if(empty($val)) $this->addEmptyError('tellphone',"電話番号");

        if(!empty($val)) $this->intTypeCheck($val,'tellphone',"電話番号");
    }




    //メソッドが実行されたら$errorsプロパティの指定の$keyに$messageを代入
    private function addEmptyError(string $key,string $message){
        $this->errors[$key] = "{$message}は入力されていません";
    }

        //文字列長検証($len文字以内であるか-2
    private function lengthCheck($val,string $key, string $name,int $len){
        if(mb_strlen($val) < $len){
             $this->errors[$key] = "{$name}は{$len}文字以上で入力してください";
        }
    }

        //整数型検証-
    private function intTypeCheck($val, string $key, string $name){
        if(!ctype_digit($val)){
            $this->errors[$key] = "{$name}は数値で指定してください";
        }        
    }

        //正規表現パターン(パターン$patternに合致するか)
    private function regexCheck(string $value, string $name, string $pattern){
        if(!preg_match($pattern,$value)){
            $tmp = implode(', ', $opts);
            $this->errors[] = "{$name}は正しい形式で入力してください";
        }
    }

}

    //配列要素に含まれている文字エンコーディングをチェック
//     private function checkEncoding(array $data){
//         foreach($data as $key => $value){
//             if(!mb_check_encoding($value)){ //与えられた値が内部文字コードと違ったら処理
//                 $this->errors[] = "{$key}は不正な文字コードです";
//             }
//         }
//     }

//     //配列要素に含まれるnullバイトをチェックする
//     private function checkNull(array $data){
//         foreach($data as $key => $value){
//             if(preg_match('/\0/',$value)){
//                 $this->errors[] = "{$key}は不正な文字を含んでいます";
//             }
//         }
//     }
        
//    //必須検証-1
//     public function requiredCheck($value, string $name){
//         if(trim($value) === ''){
//             $this->errors[] = '<p style="color:red;">' . $name . "は必須入力です</p>";
//         }
//     }

//     //文字列長検証($len文字以内であるか-2
//     public function lengthCheck($value,string $name,int $len){
//         if(trim($value) !== ''){
//             if(mb_strlen($value) < $len){
//                 $this->errors[] = '<p style="color:red;">' . $name . "は" . $len . "文字以上で入力してください</p>";
//             }
//         }
//     }

//     //整数型検証-
//     public function intTypeCheck($value, string $name){
//         if(trim($value) !== ''){
//             if(!ctype_digit($value)){
//                 $this->errors[] = '<p style="color:red;">' . $name . "は数値で指定してください</p>";
//             }
//         }
//     }

    // //数値検証範囲($min~$maxの範囲にあるか)
    // public function rangeCheck(string $value, string $name, float $max, float $min){  
    //         if($value > $max || $value < $min){
    //             $this->errors[] = "{$name}は{$min}~{$max}で指定してください";
    //         }  
    // }
    // //正規表現パターン(パターン$patternに合致するか)
    // public function regexCheck(string $value, string $name, string $pattern){
    //         if(!preg_match($pattern,$value)){
    //             $tmp = implode(', ', $opts);
    //             $this->errors[] = "{$name}は正しい形式で入力してください";
    //         }
    // }
    
//     // //配列要素検証(配列$opsの要素のいずれかであるか)
//     // public function inArrayCheck(string $value, string $name, array $opts){
//     //     if(trim($value) !== ''){
//     //         if(!in_array($value, $opts)){
//     //             $tmp = implode(',',$opts);
//     //             $this->errors[] = "{$name}は{$tmp}の中から選択してください";
//     //         }
//     //     }
//     // }