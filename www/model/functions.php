<?php
// デバック用
function dd($var){
  // 情報を出力する
  var_dump($var);
  exit();
}

// リダイレクト処理
function redirect_to($url){
  header('Location: ' . $url);
  exit;
}

// GETの入力値の取得
function get_get($name){
  if(isset($_GET[$name]) === true){
    // 変数がセットされているときの処理
    return $_GET[$name];
  };
  return '';
}

// POSTの入力値の取得
function get_post($name){
  if(isset($_POST[$name]) === true){
    // 変数がセットされているときの処理
    return $_POST[$name];
  };
  return '';
}

// ファイルの入力値の取得
function get_file($name){
  if(isset($_FILES[$name]) === true){
    // 変数がセットされているときの処理
    return $_FILES[$name];
  };
  return array();
}

// セッションの入力値の取得
function get_session($name){
  if(isset($_SESSION[$name]) === true){
    // 変数がセットされているときの処理
    return $_SESSION[$name];
  };
  return '';
}

// セッションデータの設定
function set_session($name, $value){
  $_SESSION[$name] = $value;
}

// エラーメッセージの設定
function set_error($error){
  $_SESSION['__errors'][] = $error;
}
// エラーメッセージの取得
function get_errors(){
  // errorsをセッションエラーと定義する
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}

// エラーが存在するかの確認
function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

// 完了メッセージの設定
function set_message($message){
  $_SESSION['__messages'][] = $message;
}
// 完了メッセージを取得
function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}

// ログインチェック
function is_logined(){
  // セッションのユーザID
  return get_session('user_id') !== '';
}

// 画像のアップロード
function get_upload_filename($file){
  if(is_valid_upload_image($file) === false){
    return '';
  }
  // ファイル拡張子のチェック
  $mimetype = exif_imagetype($file['tmp_name']);
  $ext = PERMITTED_IMAGE_TYPES[$mimetype];
  return get_random_string() . '.' . $ext;
}

// ランダムな文字列を生成
function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

//画像を保存
function save_image($image, $filename){
  return move_uploaded_file($image['tmp_name'], IMAGE_DIR . $filename);
}

// 画像の削除
function delete_image($filename){
  if(file_exists(IMAGE_DIR . $filename) === true){
    unlink(IMAGE_DIR . $filename);
    return true;
  }
  //指定した値が存在しなかったらfalseを返す
  return false;
  
}


// 文字列のバリデーション
function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  // 文字列の長さ
  $length = mb_strlen($string);
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}

// 正規表現の英数字
function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

// 正規表現の正の整数
function is_positive_integer($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER);
}

// 正規表現によるマッチング
function is_valid_format($string, $format){
  return preg_match($format, $string) === 1;
}

// 画像のバリデーション
function is_valid_upload_image($image){
  if(is_uploaded_file($image['tmp_name']) === false){
    set_error('ファイル形式が不正です。');
    //指定した値が存在しなかったらfalseを返す
    return false;
  }
  $mimetype = exif_imagetype($image['tmp_name']);
  if( isset(PERMITTED_IMAGE_TYPES[$mimetype]) === false ){
    set_error('ファイル形式は' . implode('、', PERMITTED_IMAGE_TYPES) . 'のみ利用可能です。');
    //指定した値が存在しなかったらfalseを返す
    return false;
  }
  return true;
}

/**
* 特殊文字をHTMLエンティティに変換する
* @param str  $str 変換前文字
* @return str 変換後文字
*/
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}