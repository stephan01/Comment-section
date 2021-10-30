<?php
date_default_timezone_set('Europe/Bucharest');
include 'dbcon.php';
include 'comments.inc.php';

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
 $cid = $_POST['cid'];
 $username = $_POST['username'];
 $date = $_POST['date'];
 $message = $_POST['message'];

 echo " 
 <h3>Edit your answer:<h3>
 <form method='POST' action='".editComments($conn)."'>  
        <input type='hidden' name='cid' value='".$cid."'>   
        <input type='hidden' name='username' value='".$username."'>
        <input type='hidden' name='date' value='".$date."'>
        <textarea name='message'>".$message."</textarea><br>
        <button name='commentSubmit' type='submit'>Edit</button>
</form>
";

        
?>

</body>
</html>