<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 凡庸関数ファイルを読み込み
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

// PDOを利用してすべての商品のデータを取得
$items = get_all_items($db);

// ビューの読み込み
include_once VIEW_PATH . '/admin_view.php';
