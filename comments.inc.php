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
//de fiecare data cand gaseste un rezultat vreau sa "echo out" bucata aceea 
//in paranteze bagam numele coloanei ce vrem sa fie afisata 
echo "<div class='comment-box'><p>";
    echo  $row['username']."<br>";
    echo  $row['date']."<br>";
    echo  $row['message']."<br><br>";
echo// Iar aici mai jos  vine Edit-ul
"</p>
<form  class='edit-btn' action='editcomment.php' method='POST'>
    <input type='hidden' name='cid' value='".$row['cid']."'>
    <input type='hidden' name='username' value='".$row['username']."'>
    <input type='hidden' name='date' value='".$row['date']."'>
    <input type='hidden' name='message' value='".$row['message']."'>
    <button>Edit</button>        
</form>
</div>";

    }
    
//includem functia in index.php (sau o scrie direct acolo daca nu avem fisier de functii)
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

