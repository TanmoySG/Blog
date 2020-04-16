<!DOCTYPE html>
<?php
        include 'backend/connection.php';
 
        if (isset($_POST['submit'])){
            $query="INSERT INTO `feedback`(`email`, `feedback`, `rating`, `date`) VALUES (:email, :feedback, :rating, :date_f )";
            $stmt=$pdo->prepare($query);
            $stmt->execute(array(
                ':email' => $_POST['email'],
                ':feedback' => $_POST['feedback'],
                ':rating' => $_POST['rating'],
                ':date_f' => date('d M Y')
            ));

            $message = 1;
        }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blogs</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="feedback-style.css">
    <link rel='stylesheet' href="simple-grid.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway|Red+Hat+Display&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Work+Sans:wght@100;200;300;400;500;531;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff3df25b6d.js"></script>
</head>
<body style="background-color: #f6f6f6; width: 100%">
    <div style="margin-top: 50px; margin-bottom: 50px">
        <div class="container">
            <div class="col-12">
            <?php 
                if(isset($message)){
            ?>
                <div style="width: 100%; margin-top: 60px">
                <center>
                    <i class="fas fa-check-circle" style="color: #0B7285; font-size: 100px"></i><br>
                    <span style="font-size: 60px; color: #0B7285; padding: 0px; margin: 0px">Thank you for your feedback!</span><br>
                    <div style="font-size: 30px">Head to <a href="http://blog.tanmoysg.com/" style="color: #0B7285;"> blog.tanmoysg.com </a> </div>
                </center>    
                </div>
            <?php
                }else{
            ?>
                <div class="box2" style="width: 100%; padding: 25px; background-color: white">
                <center>
                    <img class="header-illustration" src="illustrations/undraw_feedback_h2ft.png" ><br>
                    <span style="color: #0B7285; font-size: 50px">Feedback for blog.tanmoysg.com</span>
                </center>
                    <form method="POST" action="feedback.php" style="margin-top: 5px;">
                    <div class="row">
                        <div class="col-9">
                            <label style="font-size: 20px">Email</label><br>
                            <input type="text" name="email" style="width: 100%;height: 25px; font-size: 20px; padding: 2.5px;">
                        </div>
                        <div class="col-3">
                            <label style="font-size: 20px">Rate the project</label><br>
                            <select type="number" name="rating" style="width: 100%;height: 34px; font-size: 20px;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label style="font-size: 20px">Feedback/Suggestions</label><br>
                            <textarea name="feedback" style="color: black; font-size: 15px; width: 100%; height: 100px; margin-top: 10px;  margin-bottom: 10px"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"> 
                            <button type="submit" name="submit" style="border-radius: 5px; background-color: #0B7285; border: none; font-size: 25px; padding: 5px; color: white"> Post Feedback </button><br>
                        </div>
                    </div>
                </form>
                </div>
            <?php 
                }
            ?>

            </div>
        </div>
    </div>
</body>
</html>