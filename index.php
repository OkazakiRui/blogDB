<?php
require_once("dbc.php");
$blogData = Blog\Dbc\getAllBlog();
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
      <th>カテゴリ</th>
      <th>公開・非公開</th>
      <th>詳細</th>
    </tr>
    <?php foreach ($blogData as $column): ?>
    <tr>
      <td><?php echo $column["id"]; ?></td>
      <td><?php echo $column["title"]; ?></td>
      <td><?php echo Blog\Dbc\setBlogCategory($column["category"]); ?></td>
      <td><?php echo $column["status"] == 1 ? "公開" : "非公開" ; ?></td>
      <td><a href="detail.php?id=<?php echo $column["id"]; ?>">ページへ</a></td>
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