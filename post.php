<?php
require_once("dbc.php");
use Blog\Dbc as DB;

  session_start();

  $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
  $content = htmlspecialchars($_POST["content"], ENT_QUOTES);
  DB\check($title, $content);
  $status = htmlspecialchars($_POST["status"], ENT_QUOTES) === "" ? 1 : 0;

  DB\postBlog($title, $content, $status);
  
?>