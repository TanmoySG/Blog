<!DOCTYPE html>
<?php
        include 'backend/connection.php';
 
        if (isset($_POST['submit'])){
            $query="INSERT INTO `subscribers` (`email`, `subs_date`, `invite`) VALUES (:email, :subs_date, 'Not Sent')";
            $stmt=$pdo->prepare($query);
            $stmt->execute(array(
                ':email' => $_POST['email'],
                ':subs_date' => date('d M Y')
            ));

            /*$to = $_POST['email'];
            $subject = "My subject";
            $txt = "Hello world!";
            $headers = "From: tanmoysps@gmail.com" . "\r\n" .
                        "CC: tanmoysg@live.com";

            mail($to,$subject,$txt,$headers);*/
        }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blogs</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href="simple-grid.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway|Red+Hat+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:wght@100;200;300;400;500;531;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff3df25b6d.js"></script>
</head>
<body style="background-color: #f6f6f6">
    <div class="box2 sb9 ">
        <div class="container-fluid" style="margin: 0px; padding: 0px">
          <div class="row">
            <div class="col-3" >
                <center>
                <img class="header-illustration"src="illustrations/<?php 
                            $illustrations = array("l1.png", "l2.png", "l3.png", "l4.png", "l5.png", "l6.png", "l7.png", "l8.png", "l9.png", "l10.png", "l11.png", "l12.png");
                            shuffle($illustrations);
                            print_r($illustrations[0]);
                          ?>" >
                </center>          
            </div>
            <div class="col-9" style="color: black; line-height: 1; font-family: 'Work Sans', sans-serif;">
                <span class="intro" style=" line-height: 1; ">Hi, I am</span><br>
                <span class="name" style=" line-height: 1; font-family: 'Montserrat'; color: #0B7285;">Tanmoy Sen Gupta</span>
                <p class="profile-details">
                I'm an Engineering Undergrad pursuing Computer Science Engineering from SRM Institute of Science and Technology. Check out my Blogs here!
                </p>

                <p style="line-height: 1.125; font-family: 'Work Sans', sans-serif; font-weight: 400; font-size: 15px; text-align: justify">
                    Get updated on new posts! Subscribe to my posts with your email.
                </p>
                <form method="POST" action="index.php" style="margin-top: 5px;">
                    <div class="row" style="margin:0px; width: 100%">
                        <input  type="text" name="email" style="border-radius: 2px; background-color: #eafbff; border: none; border-bottom: solid 2px #0B7285; height: 25px; font-size: 20px; padding: 2.5px;">
                        <button type="submit" name="submit" style="margin-left:5px; background-color: #0B7285; border: none; font-size: 20px;"><i class="fas fa-bell" style="color: white"></i></button><br>
                    </div>
                </form>
                <div class="website-link" style="color: black; line-height: 1; font-family: 'Work Sans', sans-serif; margin-top: 10px;">
                    Know more about me at <a href="http://tanmoysg.com" target="_blank" style="color: #0B7285; font-family: 'Work Sans', sans-serif;">tanmoysg.com</a>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top:30px; margin-bottom: 40px">
        <div class="row">
        <?php
                  include 'backend/connection.php';
                  $rows = array();
                  $query="SELECT * FROM `blog_posts` ORDER BY `post_id` DESC";
                  $stmt=$pdo->prepare($query);
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $rows[] = $row;
                  }
                 foreach ($rows as $row) {
                    $post_id = $row['post_id'];
                    $post_content = $row['post_content'];
                    $post_title = $row['post_title'];
                    $publish_time= $row['publish_time'];
                    $post_category = $row['post_category'];
                    $post_image = $row['post_image'];
        ?>
        <div class="col-3">
                <a style="text-align: center; text-decoration:none;" href="blogs/index.php?id=<?php echo $post_id; ?>">
                    <div style="color:white; background-color: white; box-shadow: 1px -1px 23px .5px rgba(0,0,0,0.14); border-radius: 10px;font-family: 'Work Sans', sans-serif;">
                        <div style="width: 100%; height:150px; background-image: url('<?php echo 'blogs/blog_images/'.$post_image; ?>'); border-top-left-radius: 10px;  border-top-right-radius: 10px; background-position: center; background-repeat: no-repeat; background-size: cover; "></div>
                        <div class="row" style="height: 100% ;" >
                            <div style="padding: 20px;">
                               <div style="color: #0095ff; text-align: left; font-size: 15px;">
                                    <?php echo  $post_category ;?></i>
                                </div>
                                <div style="text-align: left; font-size: 30px; color: #0B7285;">
                                    <?php echo  $post_title ;?>
                                </div>
                                <div style="text-align: left; font-size: 15px; color: #1b2528;">
                                    Published on <i style="color: #1b2528;"><?php echo  $publish_time ;?></i>
                                </div>
                           </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        
    </div>
    <div class="container" style="margin-top:15px; margin-bottom: 20px; text-align: center; font-size: 17px;">
        <i class="fas fa-comment" style="color: black"></i> Have any suggestions or feedback? <a href="feedback.php" style="color: #0B7285;"> Feel free to post them here! </a>
    </div>
</body>
</html>