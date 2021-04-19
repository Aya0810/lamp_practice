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
$name = get_post('name');     // 商品ID
$price = get_post('price');   // 値段
$status = get_post('status'); // ステータス
$stock = get_post('stock');   // 在庫数
// ファイルから画像を読み込む
$image = get_file('image');

// 商品の追加用関数を利用
if(regist_item($db, $name, $price, $stock, $status, $image)){
  set_message('商品を登録しました。');
}else {
  set_error('商品の登録に失敗しました。');
}

// 商品管理ページにリダイレクト
redirect_to(ADMIN_URL);