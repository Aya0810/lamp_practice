<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
// itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// PDOを取得
$db = get_db_connect();
// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

// 管理者チェック用関数を利用
if(is_admin($user) === false){
  // 管理者以外の場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// POSTされたものを定義
$item_id = get_post('item_id'); // 商品ID
$stock = get_post('stock');     // 在庫数
$token = get_post('token');       // トークン

// トークンチェック用関数を利用
if (is_valid_csrf_token($token) === false){
  set_error('不正なアクセスが行われました。');
  redirect_to(ADMIN_URL);
}

// 商品の在庫数変更用関数を利用
if(update_item_stock($db, $item_id, $stock)){
  set_message('在庫数を変更しました。');
} else {
  set_error('在庫数の変更に失敗しました。');
}

// 商品管理ページにリダイレクト
redirect_to(ADMIN_URL);