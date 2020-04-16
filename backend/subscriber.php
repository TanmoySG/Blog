<!DOCTYPE html>

<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
    $email = $_SESSION['email'];

    if(isset($_GET['mail'])){

        $query="UPDATE `subscribers` SET invite = 'Sent' WHERE email = :email";
        $stmt=$pdo->prepare($query);
        $stmt->execute(array(
            ':email' => $_GET['mail']
        ));      

        header("location: subscriber.php");
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
                Generate Mail
            </div>
        </div>
        <hr>
        <div style="margin-top: 20px">
            <form method="POST" action="generate_mail.php">
                    <div class="row" style="margin:0px; width: 100%">
                        <select class="col-11" type="text" name="id" style="border-radius: 3px; background-color: #eafbff; border: none; border-bottom: solid 2px #0B7285; font-size: 25px; padding: 2.5px;">
                        <?php

                            $rows = array();
                            $query="SELECT * FROM `blog_posts` ORDER BY `post_id` DESC";
                            $stmt=$pdo->prepare($query);
                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $rows[] = $row;
                            }
                            foreach ($rows as $row) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                        ?>
                            <option value="<?php echo $post_id ?>"><?php echo $post_title ?></option>
                        <?php } ?>
                        </select>
                        <button class="col-1" type="submit" name="submit" style="border-radius: 3px; margin-left:5px; background-color: #0B7285; border: none; font-size: 25px; padding: 2.5px; "><i class="fas fa-inbox" style="color: white"></i></button><br>
                    </div>
            </form>
        </div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-12" style="color:#0B7285; font-family: Montserrat; font-size: 30px; text-align: right;">
                Subscribers
            </div>
        </div>
        <hr>
        <div style="margin-top: 20px">
            <div>
              <table class="col-12" style="width:100%;" >
                <tr style="background-color: #e7e7e7;">
                    <th class="col-1" style="text-align: center; padding:5px">Sl.</th>
                    <th class="col-5" style="text-align: center; padding:5px">Mail</th>
                    <th class="col-2" style="text-align: center; padding:5px">Date</th>
                    <th class="col-2" style="text-align: center; padding:5px">Invite</th>
                    <th class="col-2" style="text-align: center; padding:5px">Operation</th>
                </tr>
                <?php
                  $rows = array();
                  $query="SELECT * FROM `subscribers` ORDER BY `id` DESC";
                  $stmt=$pdo->prepare($query);
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $rows[] = $row;
                  }
                 foreach ($rows as $row) {
                    $id = $row['id'];
                    $email = $row['email'];
                    $date = $row['subs_date'];
                    $invite = $row['invite']
                ?>
                <tr style="background-color: #f6f6f6; padding:5px">
                    <td class="col-1" style="text-align: center;  padding:5px"><?php echo $id ?></td>
                    <td class="col-5" style="text-align: justify;  padding:5px"><?php echo $email ?></td>
                    <th class="col-2" style="text-align: center; padding:5px"><?php echo $date ?></th>
                    <th class="col-2" style="text-align: center; padding:5px">
                        <?php
                            if($invite=='Not Sent'){ ?>
                                <a href="subscriber.php?mail=<?php echo $email ?>" style="color: #f30022"><?php echo $invite ?></a>
                            <?php } else { ?>
                                <span style="color: #0B7285"><?php echo $invite ?></span>
                            <?php }
                        ?>
                    </th>
                    <td class="col-2" style="text-align: center;  padding:5px"> 
                        <div class="row">
                            <a href="mailto:<?php echo $email ?>?subject=Thank You for Subscribing!" class="col-6"><i class="fas fa-envelope" style="color:#0B7285"></i></a>
                            <a href="delete.php?subs_id=<?php echo $id?>" class="col-6"><i class="fas fa-trash-alt" style="color: #f30022"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?> 
              </table>
            </div>
        </div>
        <div style="color: black; width: 100%;">
        <a href="response.php" style="color:  #0B7285; font-size: 17px; float: right; padding-top: 10px"> View Feedbacks <i class="fas fa-comment" style="color: #0B7285"></i></a><br>
        </div>
    </div>   
     
</body>
</html>
<?php
 } else{
    header('Location: login.php');
 }

 //margin-top: 5px; padding:8px; border-radius: 2px; background-color: #eafbff; border: none; border-left: solid 2px #0B7285; color: #0B7285; font-size: 25px;