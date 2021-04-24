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

// PDOを取得
$db = get_db_connect();

// POSTされたものを定義
$name = get_post('name');         // ユーザー名
$password = get_post('password'); // パスワード
$token = get_post('token');       // トークン

// トークンチェック用関数を利用
if (is_valid_csrf_token($token) === false){
  set_error('不正なアクセスが行われました。');
  redirect_to(LOGIN_URL);
}

// ログイン処理用関数を利用
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}

// 管理ユーザーは商品管理ページに、通常ユーザーは商品一覧ページに遷移
set_message('ログインしました。');
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
redirect_to(HOME_URL);