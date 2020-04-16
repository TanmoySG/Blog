<!DOCTYPE html>

<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
     $email = $_SESSION['email'];
     
     if(isset($_POST['submit_article'])){
        $query="INSERT INTO `blog_posts`(`post_title`, `publish_time`, `post_content`, `post_category`, `post_image`, `post_views`) VALUES (:post_title, :publish_time , :post_content, :post_category, :post_image, 0) ";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(
           ':post_title' => $_POST['post_title'],
           ':publish_time'=> $_POST['publish_time'],
           ':post_content' => $_POST['post_content'],
           ':post_category' => $_POST['post_category'],
           ':post_image' => $_POST['post_image']
       ));
        $path = "../blogs/blog_images/";
        $_FILES['post_image_upload']['name'] = $_POST['post_image'];

        $path = $path.$_FILES['post_image_upload']['name'];
        move_uploaded_file($_FILES['post_image_upload']['tmp_name'], $path);

        $success_message="Article added Successfully";
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
                <a href="index.php" style="color:blue; font-family: Montserrat; font-size: 30px"><i class="fas fa-chevron-circle-left" style="color: #0B7285"></i></a>
            </div>
            <div class="col-9" style="color:#0B7285; font-family: Montserrat; font-size: 30px; text-align: right;">
                Add Article
            </div>
        </div>
        <hr>
        <?php if (isset($success_message)) { ?>
            <small style="font-size: 15px; color: black ;"><?php echo $success_message; ?> <a href="subscriber.php" style="color:#0B7285">Mail Subscribers</a></small><br>
        <?php } ?>
        <div style="margin-top: 20px; margin-bottom: 20px">
           <form method="POST" action="add.php" enctype="multipart/form-data">
           <div class="row">
                   <div class="col-12">
                        <label style="font-size: 20px">Article Title</label><br>
                        <input type="text" name="post_title" placeholder="Put the Article Title here" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                   </div>
            </div>
               <div class="row">
                   <div class="col-4">
                        <label style="font-size: 20px">Image Name</label><br>
                        <input type="text" name="post_image" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                   </div>
                   <div class="col-2">
                        <label style="font-size: 20px">Image</label><br>
                        <input type="file" name="post_image_upload" style=" width:100%; border-radius: 5px; border: solid 1px black; height: 30px; font-size: 20px; padding: 1px;"><br>
                   </div>
                   <div class="col-3">
                        <label style="font-size: 20px">Article Category</label><br>
                        <select type="text" name="post_category" placeholder="Choose the article category" style="width:100%; border-radius: 5px; border: solid 1px black; height: 35px; font-size: 20px; padding: 3px;">
                             <option value="Science">Science</option>
                             <option value="Technology">Technology</option>
                             <option value="Design">Design</option>
                             <option value="Politics">Politics</option>
                             <option value="Arts & Culture">Arts & Culture</option>
                             <option value="Misc">Misc</option>
                        </select>
                        <br>
                   </div>
                   <div class="col-3">
                        <label style="font-size: 20px">Date</label><br>
                        <input type="date" name="publish_time" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                   </div>
               </div>
               <div class="row">
                   <div class="col-12">
                        <label style="font-size: 20px">Article Body</label><br>
                        <textarea placeholder="Put the Article here with the required tags for formatting!" name="post_content" style="min-width: 100%; max-width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px; height:250px;"></textarea><br>
                   </div>
               </div>
               <div class="row">
                    <div class="col-4">
                        <button type="submit" name="submit_article" style="width:100%; background-color:#0B7285 ;border-radius: 5px; color:white; border: none; font-size: 20px; padding: 5px;">Submit Article</button><br>
                    </div>
               </div>
           </form>
        </div>
    </div>    
</body>
</html>
<?php
 } else{
    header('Location: login.php');
 }