<!DOCTYPE html>

<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
     $email = $_SESSION['email'];
     $post_id=$_GET['id'];

     if(isset($_POST['edit'])){
        $query_edit="UPDATE `blog_posts` SET post_title= :post_title , post_content = :post_content WHERE `post_id`= $post_id ";
        $stmt=$pdo->prepare($query_edit);
        $stmt->execute(array(
           ':post_title' => $_POST['post_title'],
           ':post_content' => $_POST['post_content']
       ));
       $success_message="Article edited successfully";
     }
     
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
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-3">
                <a href="edit.php" style="color:blue; font-family: Montserrat; font-size: 30px"><i class="fas fa-chevron-circle-left" style="color: #0B7285"></i></a>
            </div>
            <div class="col-9" style="color:#0B7285; font-family: Montserrat; font-size: 30px; text-align: right;">
                Edit Article
            </div>
        </div>
        <hr>
        <?php if (isset($success_message)) { ?>
            <small style="font-size: 15px; color: black ;"><?php echo $success_message; ?></small><br>
        <?php } ?>
        <div style="margin-top: 20px">
        <?php
                  $rows = array();
                  $query_2="SELECT * FROM `blog_posts` WHERE `post_id`= $post_id";
                  $stmt=$pdo->prepare($query_2);
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $rows[] = $row;
                  }
                 foreach ($rows as $row) {
                    $post_title = $row['post_title'];
                    $publish_time= $row['publish_time'];
                    $post_content = $row['post_content'];
        ?>
           <form method="POST" action="edit_article.php?id=<?php echo $post_id ;?>">
               <div class="row">
                   <div class="col-9">
                        <label style="font-size: 20px">Article Title</label><br>
                        <input type="text" name="post_title" value="<?php echo $post_title ;?>" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                   </div>
                   <div class="col-3">
                        <label style="font-size: 20px">Date</label><br>
                        <input type="date" name="publish_time" value="<?php echo $publish_time ;?>" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                   </div>
               </div>
               <div class="row">
                   <div class="col-12">
                        <label style="font-size: 20px">Article Body</label><br>
                        <textarea name="post_content" style="min-width: 100%; max-width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px; height:250px;"><?php echo $post_content; ?></textarea><br>
                   </div>
               </div>
               <div class="row">
                    <div class="col-4">
                        <button type="submit" name="edit" style="width:100%; background-color:#0B7285 ;border-radius: 5px; color:white; border: none; font-size: 20px; padding: 5px;">Submit changes</button><br>
                    </div>
               </div>
           </form>
           <?php } ?> 
        </div>
    </div>    
</body>
</html>
<?php
 } else{
    header('Location: login.php');
 }