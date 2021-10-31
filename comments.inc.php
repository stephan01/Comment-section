<?php
include 'dbcon.php';


// scriem setComments($conn) iar asta va spune functiei ca facem referire la o ceva din afara functiei
// si modificam si in index.php action='setComments($conn)'
function setComments($conn) {
    
    // doar daca se apasa pe butonul submit sa ruleze codul, altfel nu
if(isset($_POST['commentSubmit'])) {

 $username = $_POST['username'];
 $date = $_POST['date'];
 $message = $_POST['message'];

    $sql = "INSERT INTO comments (username, date, message) VALUES ('$username', '$date', '$message') ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
}
}

//Creeam o functie pentru a afisa efectiv comentariile
function getComments($conn){
    $sql = "SELECT * FROM comments";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
//se va duce si va lua toate rezultatele diferite din database 
//si ne lasa sa le afisam pt ca le stocam intr-un array $row

//FARA WHILE IMI AFISA DOAR PRIMUL REZULTAT DIN DATABASE DAR CU WHILE ->
//DE FIECARE DATA CAND GASESTE REZULTAT IN DATABASE NI LE AFISEAZA PANA NU MAI RAMANE NICIUNUL
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //luam user-id cand va fi logat sa apara numele lui de utilizator la comm-ul facut de el
 $id =  $row['username'];   // e egal cu $row resul din comment table 
 $sql1 = "SELECT * FROM users WHERE id='$id'";
 $stmt1 = $conn->prepare($sql1); 
 $stmt1->execute();     
    if ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
        //de fiecare data cand gaseste un rezultat vreau sa "echo out" bucata aceea 
//in paranteze bagam numele coloanei ce vrem sa fie afisata 
echo "<div class='comment-box'><p>";
echo  $row1['username']."<br>";
echo  $row['date']."<br>";
echo  $row['message']."<br><br>";
echo "<p>";
//aici este DELETE si EDIT daca suntem logati
if (isset($_SESSION['id'])){ // check if we are logged in
    if ($_SESSION['id'] == $row1['id'] )   { // check if the autor of the post match with the $_SESSION['id']
        echo "<form  class='delete-btn' action='".deleteComments($conn)."' method='POST'>
        <input type='hidden' name='cid' value='".$row['cid']."'> 
        <button type='submit' name='commentDelete'>Delete</button>        
        </form>
    
        <form  class='edit-btn' action='editcomment.php' method='POST'>
        <input type='hidden' name='cid' value='".$row['cid']."'>
        <input type='hidden' name='username' value='".$row['username']."'>
        <input type='hidden' name='date' value='".$row['date']."'>
        <input type='hidden' name='message' value='".$row['message']."'>
        <button>Edit</button>        
        </form>";
   
    }

}

    
echo"</div>";

}


}
}


//edit
function editComments($conn) {
    // doar daca se apasa pe butonul submit sa ruleze codul, altfel nu
if(isset($_POST['commentSubmit'])) {
 $cid = $_POST['cid'];
 $username = $_POST['username'];
 $date = $_POST['date'];
 $message = $_POST['message'];

    $sql = "UPDATE comments SET message='$message' WHERE cid='$cid'"; //fara where ar fi schimbat toate comentariile din database,trebe sa ii spunem unde sa faca update
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("location: index.php");
}
}



function getLogin($conn){
    if(isset($_POST['loginSubmit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
//vedem daca avem vreun rezultat
    if ($stmt->rowCount() > 0){
//daca chiar avem rezultate vrem sa incepem sa luam datele si sa le punem inautrul lui $row
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//face sesiunea egala cu "data", in cazul nostru facem referire la id-ul din database
            $_SESSION['id'] = $row['id']; 
            $_SESSION['username'] = $row['username'];

            header("Location: index.php?loginsucces"); //daca are succes revenim la pagina prinicipala logati
            exit();//nu va lasa sa se "resubmit the form" dupa ce apasam refresh
        }
        
    }else{
        header("Location: index.php?loginfailed"); 
        exit();
    }
    }
}


function userLogout(){

    if(isset($_POST['logoutSubmit'])) {
        session_start();
        session_destroy();
        header("Location: index.php"); 
        exit();
}
}

function deleteComments($conn){
    
    if(isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];
       
           $sql = "DELETE FROM comments WHERE cid = '$cid'";
           $stmt = $conn->prepare($sql);
           $stmt->execute();
           header("location: index.php");
       }
       }
       