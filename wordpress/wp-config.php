<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86 
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'narabikke_1');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'narabikke_1');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'moritakuka');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ';T g:?X--qw|/_Pg|b4j.Xnk#VL<jM5vt2/|,>!&HXx=~H>L:Gn%d|c{=4e65YbT');
define('SECURE_AUTH_KEY',  '*@FerRs d-H!z,n_MNwy3Ww([/9XLbE^&.nG5UxUH!v$B#_k,X<8`&bFi{*GP3W>');
define('LOGGED_IN_KEY',    '8<GxrR>?4CA_jbi!WmPm]EjRi(;P:At>t]k9ZieO5M5LBD-P|#+mhN&ou-Lj||*D');
define('NONCE_KEY',        'y&38b~-,7u.frssPr SU#ER_5!_|?|-.djS;W7Q@e6[lSgQZq6&^_>H/r~i?]ZD8');
define('AUTH_SALT',        ')z8,+3_XOhN~1 k}mbv-Wy=hq{y]RnBxY#Np5`r07~#LtOp@<S5UMH?f_$zP_eKm');
define('SECURE_AUTH_SALT', 'b#Oj/uqMawVpdu|`h9/Su9OqOAB`l4j3}IDbtP=NT;lOzD^v[-Bh^L.aUF_4ZBg@');
define('LOGGED_IN_SALT',   '3={N~iX&[+V3yy&5MU/= T}!=qQF+T.)Es|;E7Q$2gNd]9i9Za$0/-`13A)+p $E');
define('NONCE_SALT',       'Sq$}QxsQaA`cy|KLF;k.rh-w||7T%7p+T$,>l#-D6h%ZoEO?P.3TpM B[3`JTiy0');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
