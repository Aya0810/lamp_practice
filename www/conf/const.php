<?php
// ディレクトリパス
define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');       // Modelファイル
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');         // Viewファイル
define('IMAGE_PATH', '/assets/images/');                              // 画像ファイル
define('STYLESHEET_PATH', '/assets/css/');                            // CSSファイル
define('IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/assets/images/' );  // 画像ディレクトリ

// データベースの接続情報
define('DB_HOST', 'mysql');     // MySQLのホスト名
define('DB_NAME', 'sample');    // MySQLのDB名  
define('DB_USER', 'testuser');  // MySQLのユーザー名
define('DB_PASS', 'password');  // MySQLのパスワード
define('DB_CHARSET', 'utf8');   // MySQLのcharset

// URLの情報
define('SIGNUP_URL', '/signup.php');  // 新規登録ページ
define('LOGIN_URL', '/login.php');    // ログインページ
define('LOGOUT_URL', '/logout.php');  // ログアウトページ
define('HOME_URL', '/index.php');     // 商品一覧ページ
define('CART_URL', '/cart.php');      // ショッピングカートページ
define('FINISH_URL', '/finish.php');  // 購入完了ページ
define('ADMIN_URL', '/admin.php');    // 商品管理ページ

// 正規表現
define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');        // 英数字のみ
define('REGEXP_POSITIVE_INTEGER', '/\A([1-9][0-9]*|0)\z/'); // 整数のみ

// 文字数制限
// ユーザー名は6文字以上、100文字以内
define('USER_NAME_LENGTH_MIN', 6);
define('USER_NAME_LENGTH_MAX', 100);
// パスワードは6文字以上、100文字以内
define('USER_PASSWORD_LENGTH_MIN', 6);
define('USER_PASSWORD_LENGTH_MAX', 100);

// ユーザー種別情報
define('USER_TYPE_ADMIN', 1);   // 管理者
define('USER_TYPE_NORMAL', 2);  // 通常

// 文字数制限
// 商品名は1文字以上、100文字以内
define('ITEM_NAME_LENGTH_MIN', 1);
define('ITEM_NAME_LENGTH_MAX', 100);

// 商品公開ステータス
define('ITEM_STATUS_OPEN', 1);  // 公開
define('ITEM_STATUS_CLOSE', 0); // 非公開

// 商品公開ステータスの配列
define('PERMITTED_ITEM_STATUSES', array(
  'open' => 1,
  'close' => 0,
));

// 画像のファイル形式の配列
define('PERMITTED_IMAGE_TYPES', array(
  IMAGETYPE_JPEG => 'jpg',
  IMAGETYPE_PNG => 'png',
));