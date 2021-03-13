<?php
  session_start();

  $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
  $content = htmlspecialchars($_POST["content"], ENT_QUOTES);

  if($title === "" or $content === ""){
    header("location:dbc.php");
    exit();
  }
  $status = htmlspecialchars($_POST["status"], ENT_QUOTES) === "" ? 1 : 0;
  var_dump($status);

  try{
    $dbh = new PDO($_SESSION["dsn"],$_SESSION["user"],$_SESSION["pass"],[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "接続成功";
    
    $sql = "INSERT INTO `blog` (`id`, `title`, `content`, `category`, `post_at`, `status`) VALUES (NULL, '$title', '$content', '1', CURRENT_TIMESTAMP, '$status');";
    $dbh -> query($sql);

    header("location:dbc.php");
  }catch(PDOException $e){
    echo "接続失敗".$e;
    exit(); 
  }

  
?>