<?php 
$conn = new mysqli("localhost", "root", "", "bd_test");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Test task Anastasiya Vasileva</title>
<meta charset="utf-8" />
</head>
<body>
<?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
{
    $userid = $conn->real_escape_string($_GET["id"]);
    $sql = "SELECT * FROM users WHERE id = '$userid'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            foreach($result as $row){
                $username = $row["name"];
                $usersurname = $row["surname"];
                $userbirthday = $row["birthday"];
                $usergender = $row["gender"];
                $usercity = $row["city"];
            }
            echo "<h3>Обновление пользователя</h3>
                <form method='post'>
                    <input type='hidden' name='id' value='$userid' />
                    <p>Имя:
                    <input type='text' name='name' value='$username' /></p>
                    <p>Фамилия:
                    <input type='text' name='surname' value='$usersurname' /></p>
                    <p>Дата рождения:
                    <input type='date' name='birthday' value='$userbirthday' /></p>
                    <p>Пол:
                    <input type='radio' name='gender' value='$usergender' />Мужской 
                    <input type='radio' name='gender' value='$usergender' />Женский</p>
                    <p>Город:
                    <input type='text' name='city' value='$usercity' /></p>
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>Пользователь не найден</div>";
        }
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
    }
}
elseif (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["surname"])) {
      
    $userid = $conn->real_escape_string($_POST["id"]);
    $username = $conn->real_escape_string($_POST["name"]);
    $usersurname = $conn->real_escape_string($_POST["surname"]);
    $userbirthday = $conn->real_escape_string($_POST["birthday"]);
    $usergender = $conn->real_escape_string($_POST["gender"]);
    $usercity = $conn->real_escape_string($_POST["city"]);
    $sql = "UPDATE users SET name = '$username', surname = '$usersurname', birthday = '$userbirthday', gender = '$usergender', city = '$usercity' WHERE id = '$userid'";
    if($result = $conn->query($sql)){
        header("Location: index.php");
    } else{
        echo "Ошибка: " . $conn->error;
    }
}
else{
    echo "Некорректные данные";
}
$conn->close();
?>
</body>
</html>
