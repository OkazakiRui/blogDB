<?php
function br(){
  echo "<br>";
}

$dsn = 'mysql:host=localhost;dbname=blogApp;charset=utf8';
$user = 'blog_user';
$pass = 'ZeoGAHjIUogeQCd2';

session_start();

$_SESSION["dsn"] = 'mysql:host=localhost;dbname=blogApp;charset=utf8';
$_SESSION["user"] = 'blog_user';
$_SESSION["pass"] = 'ZeoGAHjIUogeQCd2';

try{
  $dbh = new PDO($dsn, $user, $pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);
  // echo '接続成功';
  // $dbh = null;
  // br();

  $sql = "select * from blog";
  $stmt = $dbh -> query($sql);
  // print_r($stmt);
  // br();

  $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
  // print_r($result);
  // br();
  
}catch(PDOException $e){
  echo '例外発生'.$e->getMessage();
  br();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ一覧</title>
</head>

<body>
  <h2>ブログ一覧</h2>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>タイトル</th>
      <th>内容</th>
      <th>カテゴリ</th>
      <th>投稿日時</th>
      <th>公開・非公開</th>
    </tr>
    <?php foreach ($result as $column): ?>
    <tr>
      <td><?php echo $column["id"]; ?></td>
      <td><?php echo $column["title"]; ?></td>
      <td><?php echo $column["content"]; ?></td>
      <td><?php echo $column["category"]; ?></td>
      <td><?php echo $column["post_at"]; ?></td>
      <td><?php echo $column["status"] == 1 ? "公開" : "非公開" ; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <h2>ブログ投稿</h2>
  <form action="post.php" method="post">
    <p>ブログタイトル<input name="title" type="text"></p>
    <p>内容</p>
    <textarea name="content" cols="30" rows="10"></textarea>
    <label>
      <p><input type="checkbox" name="status">非公開にする。</p>
    </label>
    <button type="submit">投稿</button>
  </form>
</body>

</html>