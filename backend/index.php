<!DOCTYPE html>

<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
     $email = $_SESSION['email']; 
     
     $query_1 = "SELECT COUNT(*) FROM `blog_posts`";
     $stmt=$pdo->prepare($query_1);
     $stmt->execute();

     $article_count =  $stmt->fetchColumn();

     $query_2 = "SELECT COUNT(*) FROM `subscribers`";
     $stmt=$pdo->prepare($query_2);
     $stmt->execute();

     $subscriber_count =  $stmt->fetchColumn();

     $query_3 = "SELECT SUM(post_views) FROM `blog_posts`";
     $stmt=$pdo->prepare($query_3);
     $stmt->execute();

     $visit_count =  $stmt->fetchColumn();

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blogs | Control Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../backend/style.css">
    <link rel='stylesheet' href="simple-grid.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway|Red+Hat+Display|Poppins&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff3df25b6d.js"></script>
</head>
<body style="font-family: Montserrat">
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="logo">
                        <div class="row">
                            Blog Control Panel
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="">
        <div class="container">
            <div class="row">
                    <div style="margin-top: 40px">
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="padding: 20px">
                                    <div class="row">
                                        <div class="col-4"><div style="font-size:40px; color: #0B7285"><?php echo $article_count; ?></div><div style="font-size:15px">Number of Articles</div></div>
                                        <div class="col-4"><div style="font-size:40px; color: #0B7285"><?php echo $subscriber_count; ?></div><div style="font-size:15px">Number of Subscribers</div></div>
                                        <div class="col-4"><div style="font-size:40px; color: #0B7285"><?php echo $visit_count; ?></div><div style="font-size:15px">Total Views</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                          <centre>
                            <div class="col-6">
                                    <a style="color:white;text-align: center; " href="add.php">
                                        <div class=" card" style="background-color: #ffffff; ">
                                            <i class="fas fa-plus" style="color: #0B7285"></i><br>Add Article
                                        </div>
                                    </a>
                            </div>
                            <div class="col-6">
                                    <a style="color:white;text-align: center; " href="edit.php">
                                        <div class=" card" style="background-color: #ffffff;">
                                            <i class="fas fa-pen" style="color: #0B7285"></i><br>Edit Article
                                        </div>
                                    </a>
                            </div>
                          </centre>
                        </div>
                        <div class="row" style="margin-top: 20px">
                             <div class="col-4">
                                <centre><a style="color:white;text-align: center; " target="_blank" href="../index.php"><div style="background-color:#ffffff; box-shadow: 1px -1px 23px .5px rgba(0,0,0,0.14); border-radius: 10px; border: none; font-size: 20px; padding: 10px;"><i class="fas fa-eye" style="color:#0B7285"></i> View Blog</div></a></centre>
                             </div>
                             <div class="col-4">
                                <centre><a style="color:white;text-align: center; " href="subscriber.php"><div style="background-color:#ffffff; box-shadow: 1px -1px 23px .5px rgba(0,0,0,0.14); border-radius: 10px; border: none; font-size: 20px; padding: 10px;"><i class="fas fa-user-check" style="color:#0B7285"></i> View subscribers</div></a></centre>
                             </div>
                             <div class="col-4">
                                <centre><a style="color:white;text-align: center; " href="logout.php"><div style="background-color: #ffffff; box-shadow: 1px -1px 23px .5px rgba(0,0,0,0.14); border-radius: 10px; border: none; font-size: 20px; padding: 10px;"><i class="fas fa-sign-out-alt" style="color:#0B7285"></i> Log-out</div></a></centre>
                             </div>
                        </div>
                    </div>
            </div> 
        </div>
    </div>
</body>
</html>
<?php
 } else{
    header('Location: login.php');
 }