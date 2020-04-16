<!DOCTYPE html>

<?php
 include 'connection.php';
 session_start();
 if (isset($_SESSION['logged_in'])) {
     $email = $_SESSION['email'];
     
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
                Published Articles
            </div>
        </div>
        <hr>
        <div style="margin-top: 20px">
            <div>
              <table class="col-12" style="width:100%;" >
                <tr style="background-color: #e7e7e7;">
                    <th class="col-2" style="text-align: center; padding:5px">Post ID</th>
                    <th class="col-5" style="text-align: center; padding:5px">Title</th>
                    <th class="col-2" style="text-align: center; padding:5px">Published date</th>
                    <th class="col-1" style="text-align: center; padding:5px">Visits</th>
                    <th class="col-2" style="text-align: center; padding:5px">Operation</th>
                </tr>
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
                    $publish_time= $row['publish_time'];
                    $post_visits= $row['post_views'];
                ?>
                <tr style="background-color: #f6f6f6; padding:5px">
                    <td class="col-2" style="text-align: center;  padding:5px"><?php echo $post_id ?></td>
                    <td class="col-5" style="text-align: justify;  padding:5px"><?php echo $post_title ?></td>
                    <td class="col-2" style="text-align: center;  padding:5px"><?php echo $publish_time ?></td>
                    <td class="col-1" style="text-align: center;  padding:5px"><?php echo $post_visits ?></td>
                    <td class="col-2" style="text-align: center;  padding:5px">
                      <div class="row">
                        <a href="../blogs/index.php?id=<?php echo $post_id?>" target="_blank" class="col-4"><i class="fas fa-eye" style="color: #008bc0"></i></a>
                        <a href="edit_article.php?id=<?php echo $post_id?>" class="col-4"><i class="fas fa-pen" style="color: #008bc0"></i></a>
                        <a href="delete.php?id=<?php echo $post_id?>" class="col-4"><i class="fas fa-trash-alt" style="color: #f30022"></i></a>
                      </div>
                    </td>
                </tr>
                <?php } ?> 
              </table>
            </div>
        </div>
        <div style="color: black; width: 100%;">
        <a href="truncate.php" style="color:  #f30022; float: right; padding-top: 10px"> Delete all posts <i class="fas fa-trash-alt" style="color: #f30022"></i></a><br>
        </div>
    </div>   
     
</body>
</html>
<?php
 } else{
    header('Location: login.php');
 }