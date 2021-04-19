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
$item_id = get_post('item_id');       // 商品ID
$changes_to = get_post('changes_to'); // ステータス変更

// 商品のステータス変更用関数を利用
if($changes_to === 'open'){
  // 非公開→公開
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
}else if($changes_to === 'close'){
  // 公開→非公開
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
}else {
  set_error('不正なリクエストです。');
}

// 商品管理ページにリダイレクト
redirect_to(ADMIN_URL);