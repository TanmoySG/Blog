<!DOCTYPE html>
<?php
        include 'backend/connection.php';
 
        if (isset($_POST['submit'])){
            $query="DELETE FROM subscribers WHERE email = :email";
            $stmt=$pdo->prepare($query);
            $stmt->execute(array(
                ':email' => $_POST['email']
            ));

            $message = 1;

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
        <div class="container-fluid">
          <div class="row">
            <center>
                <div class="col-12" style="color: black; line-height: 1; font-family: 'Work Sans', sans-serif;">
                <span class="name" style=" line-height: 1;color: #0B7285; ">Hi, Mate!</span><br>
                <p class="profile-details" style="text-align: center">
                    It's been great having you on board! But it seems you were annoyed with my emails (Sorry!). <br>Unsubscribe to my mails below. Thank you for your support! Hope you'll hang around!
                </p>
                <form method="POST" action="unsubscribe.php" style="margin-top: 5px;">
                    <div class="row" style="margin:0px; width: 100%">
                        <input  type="text" name="email" style="border-radius: 2px; background-color: #eafbff; border: none; border-bottom: solid 2px #0B7285; height: 25px; font-size: 20px; padding: 2.5px;">
                        <button type="submit" name="submit" style="margin-left:5px; background-color: #0B7285; border: none; font-size: 20px;"><i class="fas fa-bell-slash" style="color: white"></i></button><br>
                    </div>
                </form>
            </div>
            </center>
          </div>
        </div>
    </div>
        <div class="container" style="padding: 25px">
            <div class="row">
                <div class="col-12">
                    <center>
                        <div class="website-link" style="color: black; line-height: 1; font-family: 'Work Sans', sans-serif; margin-top: 10px; font-size: 35px">
                            <?php 
                               if(isset($message)){
                                ?>
                                    Visit my blog at <a href="index.php" style="color: #0B7285; font-family: 'Work Sans', sans-serif;">blogs.tanmoysg.com</a>
                                <?php
                                }else{
                                ?>
                                    Know more about me at <a href="http://tanmoysg.com/" style="color: #0B7285; font-family: 'Work Sans', sans-serif;">tanmoysg.com</a>
                                <?php 
                               }
                            ?>
                        </div>
                    </center>    
                </div>
            </div>
    </div>
</body>
</html>