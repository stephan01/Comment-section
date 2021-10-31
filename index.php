<?php
date_default_timezone_set('Europe/Bucharest');
include 'dbcon.php';
include 'comments.inc.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Main Page</title>
</head>
<body>
    <?php
    echo "<form action='".getLogin($conn)."' method='POST'>
<input type='text' name='username'required placeholder='Enter your username'>
<input type='password' name='password'required placeholder='Enter your password'>
<button type='submit' name='loginSubmit'>LogIn</button>
    </form>";
    echo "<form action='".userLogout()."' method='POST'>
<button type='submit' name='logoutSubmit'>LogOut</button>
    </form>";

//if we are logged in or not, if is not the session set we logged out   
if (isset($_SESSION['id'])){
    echo "You are logged in";
}else{
    echo "You are not logged in";
}
    ?>
 <br><br>  

<iframe width="560" height="315" src="https://www.youtube.com/embed/tzD9BkXGJ1M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
 echo " <h2>What do you think CrossFit really is?<h2>";
    if (isset($_SESSION['id'])) {
 echo "<form method='POST' action='".setComments($conn)."'>     
        <input type='hidden' name='username' value='".$_SESSION['id']."'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message'></textarea><br>
        <button name='commentSubmit' type='submit'>Comment</button>
</form>";
}else{
    echo "<h4>You need to be logged in to comment!</h4><br>";
    
}

getComments($conn);
        
?>

</body>
</html>