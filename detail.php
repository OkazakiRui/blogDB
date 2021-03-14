<?php
require_once('dbc.php');

use Blog\Dbc;

session_start();
$id = htmlspecialchars($_GET["id"], ENT_QUOTES);
$blogData = Dbc\detailBlog($id);
$_SESSION["id"] = $id;

?>

<h1>PHPブログ</h1>
<h2 style="color:red;"><?php echo $blogData["status"] === "0" ?  "===========非公開のブログです===========" : ""; ?></h2>
<!-- 非公開の場合のみ出す -->
<h2><?php echo $blogData["title"]; ?></h2>
<p><small><?php echo "投稿日時：".$blogData["post_at"]; ?></small></p>
<p><small>カテゴリ：<?php echo Dbc\setBlogCategory($blogData["category"]); ?></small></p>
<hr>
<p><?php echo $blogData["content"]; ?></p>
<hr>

<p><a href="detail.php?id=<?php echo $id+1; ?>">次のブログ</a> <a href="detail.php?id=<?php echo $id-1; ?>">前のブログ</a></p>
<p><a href="index.php">ブログ一覧に戻る</a></p>