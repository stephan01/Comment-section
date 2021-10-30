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
   

<iframe width="560" height="315" src="https://www.youtube.com/embed/tzD9BkXGJ1M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
 echo " 
 <h3>What do you think CrossFit really is?<h3>
 <form method='POST' action='".setComments($conn)."'>     
        <input type='hidden' name='username' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message'></textarea><br>
        <button name='commentSubmit' type='submit'>Comment</button>
</form>

";
getComments($conn);
        
?>

</body>
</html>