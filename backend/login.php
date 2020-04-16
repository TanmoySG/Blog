<!DOCTYPE html>

<?php
include 'connection.php';
session_start();
if (isset($_SESSION['logged_in'])) {
    header('Location: ../backend/index.php');
} else {
    if (isset($_POST['login'])) {
        if (empty($_POST['email']) or empty($_POST['password'])) {
            $error = 'All Fields Required!';
        } else {
            $query = "SELECT * FROM user WHERE email= :email AND password = :password";
            $stmt=$pdo->prepare($query);
            $stmt->execute(array(
                ':email'=> $_POST['email'],
                ':password' => md5($_POST['password'])
            ));
            $results=$stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount()>0) {
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                header('Location: ../backend/index.php');
                exit();
            } else {
                $error = 'Incorrect Credentials!';
            }
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog Backend | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
    <link rel='stylesheet' href="../simple-grid.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway|Red+Hat+Display&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/ff3df25b6d.js"></script>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="logo">
                        <div class="row">
                            Blog Backend
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style=" width: 100%">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="" style="margin-top: 100px">
                       <span style="font-size: 3vmax;">Login to the CMS</span>
                       <br>
                       <hr style="color: black">
                       <div class="login-form">
                            <?php if (isset($error)) { ?>
                                <br>
                                <small style="font-size: 15px; color: #ff6767;"><?php echo $error; ?></small><br>
                                <br>
                            <?php } ?>
                           <form action="login.php" method="POST" >
                               <div class="col-6">
                                    <label style="font-size: 20px">Email/Login ID</label><br>
                                    <input type="text" name="email" value="User ID" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                               </div>
                               <div class="col-6">
                                    <label style="font-size: 20px">Password</label><br>
                                    <input type="password" name="password" value="******" style="width:100%; border-radius: 5px; border: solid 1px black; height: 26px; font-size: 20px; padding: 3px;"><br>
                               </div>
                               <div class="col-6">
                                    <button type="submit" name="login" style="width:100%; background-color:#00d3ac ;border-radius: 5px; color:white; border: none; font-size: 20px; padding: 5px;">Log-in</button><br>
                               </div>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>