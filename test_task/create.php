<?php
if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["birthday"]) && isset($_POST["city"])) {
      
    $conn = new mysqli("localhost", "root", "", "bd_test");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $username = $conn->real_escape_string($_POST["name"]);
    $usersurname = $conn->real_escape_string($_POST["surname"]);
    $userbirthday = $conn->real_escape_string($_POST["birthday"]);
    $usercity = $conn->real_escape_string($_POST["city"]);
    
    $sql = "INSERT INTO users (name, surname, birthday, city) VALUES ('$username', '$usersurname', '$userbirthday', '$usercity')";
    if($conn->query($sql)){
        echo "Данные успешно добавлены";
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>
