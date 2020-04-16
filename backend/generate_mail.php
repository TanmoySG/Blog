
<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
    $email = $_SESSION['email'];

    if(isset($_POST['submit'])){

        $rows = array();
        $query="SELECT * FROM blog_posts WHERE post_id = :post_id";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(':post_id' => $_POST['id']));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        foreach ($rows as $row) {
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $publish_time= $row['publish_time'];
        }
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
                <a href="subscriber.php" style="color:blue; font-family: Montserrat; font-size: 30px"><i class="fas fa-chevron-circle-left" style="color: #0B7285"></i></a>
            </div>
            <div class="col-9" style="color:#0B7285; font-family: Montserrat; font-size: 30px; text-align: right;">
                Generate Mail
            </div>
        </div>
        <hr>
        <div style="margin-top: 20px" class="row">
            <div class="col-12">
                <span style="color:#0B7285; font-family: Montserrat; font-size: 18px; text-align: center;"><i class="fas fa-info-circle" style="color:#0B7285;"></i> Invitatation mail.</span>
                <br>
                <textarea style="color: black; font-size: 15px; width: 100%; height: 100px; margin-top: 10px;  margin-bottom: 10px">
Hi friend,

It's great to have you on board!
Hope you'll enjoy my blogs and find them usefull.
Thank you for subscribing!
Visit my blog at blog.tanmoysg.com

Yours,
Tanmoy Sen Gupta
tanmoysg.com | +91 9864809029
Mail me at tanmoysgs@gmail.com

Unsubscribe to updates at blog.tanmoysg.com/unsubscribe
                </textarea>
            </div>
        </div>
        <hr>
    <div style="margin-top: 10px">
        <div class="row">
            <div class="col-4">
            <span style="color:#0B7285; font-family: Montserrat; font-size: 18px; text-align: center;"><i class="fas fa-info-circle" style="color:#0B7285;"></i> Subject of mail</span>
        <textarea style="color: black; font-size: 15px; width: 100%; height: 50px; margin-top: 10px;  margin-bottom: 10px">
NEW ARTICLE: "<?php echo $post_title ?>"
        </textarea>
            </div>
            <div class="col-8">
            <span style="color:#0B7285; font-family: Montserrat; font-size: 18px; text-align: center;"><i class="fas fa-info-circle" style="color:#0B7285;"></i> List of Reciever</span>
        <textarea style="color: black; font-size: 15px; width: 100%; height: 50px; margin-top: 10px;  margin-bottom: 10px">
<?php
                  $rows = array();
                  $query="SELECT * FROM `subscribers` ORDER BY `id` DESC";
                  $stmt=$pdo->prepare($query);
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $rows[] = $row;
                  }
                 foreach ($rows as $row) {
                    $email = $row['email'];
                    echo $email."; ";
                 }
                ?>
        </textarea>
            </div>
            <div class="col-12">
                <span style="color:#0B7285; font-family: Montserrat; font-size: 18px; text-align: center;"><i class="fas fa-info-circle" style="color:#0B7285;"></i>Update mail for article "<i><?php echo $post_title ?></i>" .</span>
                <br>
                <textarea style="color: black; font-size: 15px; width: 100%; height: 100px; margin-top: 10px;  margin-bottom: 10px">
Hi friend,

A new article "<?php echo $post_title ?>" is live on my blog!
Head to blog.tanmoysg.com/blog/index.php?id=<?php echo $post_id ?> to read it.

Visit blog.tanmoysg.com for more!

Yours,
Tanmoy Sen Gupta
tanmoysg.com | +91 9864809029
Mail me at tanmoysgs@gmail.com

Unsubscribe to updates at blog.tanmoysg.com/unsubscribe
                </textarea>
                <div style=" margin-top:10px;">
                <a href="mailto:
<?php
                  $rows = array();
                  $query="SELECT * FROM `subscribers` ORDER BY `id` DESC";
                  $stmt=$pdo->prepare($query);
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $rows[] = $row;
                  }
                 foreach ($rows as $row) {
                    $email = $row['email'];
                    echo $email."; ";
                 }
                ?>?subject=NEW ARTICLE: <?php echo $post_title ?>" style="border-radius: 3px; background-color: #0B7285; border: none; font-size: 20px; padding: 10px; "> Mail all <i class="fas fa-paper-plane" style="color: white"></i></a>
       
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
