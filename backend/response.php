<!DOCTYPE html>

<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
     $email = $_SESSION['email'];

     $query_3 = "SELECT AVG(rating) FROM `feedback`";
     $stmt=$pdo->prepare($query_3);
     $stmt->execute();

     $avg_rating =  $stmt->fetchColumn();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blogs | Control Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href="simple-grid.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway|Red+Hat+Display|Poppins&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff3df25b6d.js"></script>
</head>
<body style="font-family: Montserrat">
    
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-3">
                <a href="subscriber.php" style="color:blue; font-family: Montserrat; font-size: 30px"><i class="fas fa-chevron-circle-left" style="color: #0B7285"></i></a>
            </div>
            <div class="col-9" style="color:#0B7285; font-family: Montserrat; font-size: 30px; text-align: right;">
                Feedback for Blog
            </div>
        </div>
        <hr>
        <div style="margin-top: 20px">
            <div>
            <div class="col-9" style="color:#0B7285; font-family: Montserrat; font-size: 20px; text-align: Left;">
                Average Rating: <span style="color:#0B7285;"><?php echo $avg_rating ?></span>
            </div>
              <table class="col-12" style="width:100%; margin-top: 10px" >
                <tr style="background-color: #e7e7e7;">
                  <div class="row">
                    <th class="col-1" style="text-align: center; padding:5px">Sl</th>
                    <th class="col-3" style="text-align: center; padding:5px">Mail</th>
                    <th class="col-1" style="text-align: center; padding:5px">Rating</th>
                    <th class="col-5" style="text-align: center; padding:5px">Feedback</th>
                    <th class="col-2" style="text-align: center; padding:5px">Date</th>
                  </div>
                </tr>
                <?php
                  include 'connection.php';
                  $rows = array();
                  $query="SELECT * FROM `feedback` ORDER BY `id`";
                  $stmt=$pdo->prepare($query);
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $rows[] = $row;
                  }
                 foreach ($rows as $row) {
                    $id = $row['id'];
                    $mail = $row['email'];
                    $rating= $row['rating'];
                    $feedback= $row['feedback'];
                    $date = $row['date'];
                ?>
                <tr style="background-color: #f6f6f6; padding:5px">
                  <div class="row">
                    <td  class="col-1" style="text-align: center;  padding:5px"><?php echo $id ?></td>
                    <td  class="col-3" style="text-align: justify;  padding:5px"><?php echo $mail ?></td>
                    <td  class="col-1" style="text-align: center;  padding:5px"><?php echo $rating ?></td>
                    <td  class="col-5" style="text-align: justify;  padding:5px"><?php echo $feedback ?></td>
                    <td  class="col-2" style="text-align: center;  padding:5px"><?php echo $date ?></td>  
                 </div>
                </tr>
                <?php } ?>
             </table>
            </div>
        </div>
        
    </div>   
</body>
</html>
<?php
 } else{
    header('Location: login.php');
 }