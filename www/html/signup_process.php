<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === true){
  // ログインされている場合は商品一覧ページにリダイレクト
  redirect_to(HOME_URL);
}

// POSTされたものを定義
$name = get_post('name'); // ユーザー名
$password = get_post('password'); // パスワード
$password_confirmation = get_post('password_confirmation'); // 確認用パスワード

// PDOを取得
$db = get_db_connect();

// ユーザー登録処理用関数を利用
try{
  $result = regist_user($db, $name, $password, $password_confirmation);
  if( $result === false) {
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e) {
  set_error('ユーザー登録に失敗しました。');
  redirect_to(SIGNUP_URL);
}
set_message('ユーザー登録が完了しました。');

// ユーザ登録完了後、そのままログインして商品一覧ページへ遷移
login_as($db, $name, $password);
redirect_to(HOME_URL);