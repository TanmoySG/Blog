<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
   $query="TRUNCATE TABLE blog_posts";
   $stmt=$pdo->prepare($query);
   $stmt->execute();
   header("location: edit.php");
}else{
    header("location: login.php");
}
?>