<?php
if(isset($_POST["id"]))
{
    $conn = new mysqli("localhost", "root", "", "bd_test");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $userid = $conn->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM users WHERE id = '$userid'";
    if($conn->query($sql)){
         
        header("Location: index.php");
    }
    else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();  
}
?>
