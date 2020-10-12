<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once 'connec.php';
    $pdo = new \PDO(DSN, USER, PASS);

    if(isset($_POST["firstname"]) && isset($_POST["lastname"])){
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
        if(strlen($firstname) < 45 && strlen($lastname) < 45 ){
            $statement = $pdo->prepare($query);
            $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
            $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
            $statement->execute();
            header("Location:index.php");
        }else
        {
            echo "lenght error";
        }
    }

    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    $friends = $statement->fetchAll();

    echo "<ul>";
    for($i = 0; $i < count($friends); $i++){
        echo "<li>".$friends[$i]["firstname"];
        echo " ".$friends[$i]["lastname"]. "</li>";
    }
    echo "</ul>";
    ?>

    <form action="" method="POST">
        <label for="firstname">Firstname : </label><br>
        <input type="text" id="firstname" name="firstname" maxlength="45"><br>
        <label for="lastname">Lastname : </label><br>
        <input type="text" id="lastname" name="lastname" maxlength="45"><br>
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>



