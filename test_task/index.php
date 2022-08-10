<?php
include 'layout.php';


$conn = new mysqli("localhost", "root", "", "bd_test");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM users";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
   
    echo "<table class = 'main'>
    <tr>
         <th>Id</th>
         <th>Имя</th>
         <th>Фамилия</th>
         <th>День рождения</th>
         <th>Пол</th>
         <th>Город</th>
         <th>Редактировать</th>
         <th>Удалить</th>
        
    </tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["surname"] . "</td>";
            echo "<td>" . $row["birthday"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td><a href='update.php?id=" . $row["id"] . "'>Редактировать</a></td>";
            echo "<td><form action='delete.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'>
                </form></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<div><button class = 'button'><a href='form.html'>Добавить</a></button></div>";
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
