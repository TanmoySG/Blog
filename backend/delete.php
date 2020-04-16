<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
    if(isset($_GET['id'])){
        $query="DELETE FROM blog_posts WHERE post_id = :post_id";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(
            ':post_id' => $_GET['id']
        ));
        header("location: edit.php");
    }elseif (isset($_GET['subs_id'])) {
        $query="DELETE FROM subscribers WHERE id = :subs_id";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(
            ':subs_id' => $_GET['subs_id']
        ));
        header("location: subscriber.php");
    }

}else{
    header("location: login.php");
}

?>