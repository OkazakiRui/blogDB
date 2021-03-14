<?php
namespace Blog\Dbc;

session_start();

function br() {
  echo "<br>";
}

function dbConnect() {
  
  $_SESSION["dsn"] = 'mysql:host=localhost;dbname=blogApp;charset=utf8';
  $_SESSION["user"] = 'blog_user';
  $_SESSION["pass"] = 'ZeoGAHjIUogeQCd2';
  
  try{
    $dbh = new \PDO($_SESSION["dsn"], $_SESSION["user"], $_SESSION["pass"], [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    ]);
  } catch(\PDOException $e){
    echo '例外発生'.$e->getMessage();
    br();
  }
  
  return $dbh;
}


function getAllBlog() {
  $dbh = dbConnect();
  $sql = "select * from blog";
  $stmt = $dbh -> query($sql);
  $result = $stmt -> fetchAll(\PDO::FETCH_ASSOC);
  return $result;
}

$blogData = getAllBlog();

function setBlogCategory($category) {
  switch ($category) {
    case "1":
      return "ブログ";
      break;
    
    default:
      return "カテゴリが設定されていません";
      break;
  }
}


// detail ↓

function detailBlog($id){
  
  if(empty($id)){
    echo '<p><a href="index.php">ブログ一覧に戻る</a></p>';
    exit("idが不正です。");
  }
  
  // function dbConnect() {
  //   try{
  //     $dbh = new \PDO($_SESSION["dsn"], $_SESSION["user"], $_SESSION["pass"], [
  //       \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
  //       \PDO::ATTR_EMULATE_PREPARES => false,
  //     ]);
  //   } catch(\PDOException $e){
  //     echo '例外発生'.$e->getMessage();
  //     br();
  //   }
  //   return $dbh;
  // }
  
  function getBlog($id){
    $dbh = dbConnect();
    $sql = "SELECT * FROM blog WHERE id = :id";
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindValue(":id", (int)$id, \PDO::PARAM_INT);
    // $stmt -> bindValue(:id, $id, 型);
    $stmt->execute();
  
    $result = $stmt -> fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
  
  
  $blogData = getBlog($id);
  
  if(!$blogData){
    echo '<p><a href="index.php">ブログ一覧に戻る</a></p>';
    exit("ブログがありません。");
  }
  
  // function setBlogCategory($category) {
  //   switch ($category) {
  //     case "1":
  //       return "ブログ";
  //       break;
      
  //     default:
  //       return "カテゴリが設定されていません";
  //       break;
  //   }
  // }
    
  return $blogData;
  

}  

// post
function postBlog($title, $content, $status) {
  $dbh = dbConnect();
  $sql = "INSERT INTO `blog` (`id`, `title`, `content`, `category`, `post_at`, `status`) VALUES (NULL, '$title', '$content', '1', CURRENT_TIMESTAMP, '$status');";
  $dbh -> query($sql);
  
  header("location:index.php");
}

function check($title, $content){
  if($title === "" or $content === ""){
    header("location:index.php");
    exit();
  }
}

?>