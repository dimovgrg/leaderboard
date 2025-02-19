<?php
function createRacer(string $name, string $email): bool
{
    /** @var PDO $pdo */
    $pdo = require 'db.php';

    $sqlCheckEmail = "SELECT * FROM racers WHERE email = :email";
    $stmtCheckEmail = $pdo->prepare($sqlCheckEmail);

    try {
        $stmtCheckEmail->execute(['email' => $email]);
        $resultCheckEmail = $stmtCheckEmail->fetchAll();
    } catch (\Exception) {
        return false;
    }
    if (count($resultCheckEmail) > 0) {
        return false;
    }

    $sql = "INSERT INTO racers (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            'name' => $name,
            "email" => $email,
        ]);
    } catch (\Exception) {
        return false;
    }

    return true;
}


if (isset($_POST['submit'])) {
    if (!$_POST['name']) {
        die('Моля, въведете име.');
    }
    if (!$_POST['email']) {
        die('Моля, въведете имейл.');
    }

    $created = createRacer($_POST['name'], $_POST['email']);

    if ($created) {
        echo 'Успешно съсдадохте състезател.';
    } else {
        echo 'Възникна грешка. Опитайте пак.';
    }
}


?>

<html>
<body>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация състезател</title>
</head>
<body>
<h2>Регистриране на нов състезател!</h2>

<form method="POST" action="create.php">
    <label for="name">Имена:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="email">Имейл:</label>
    <input type="text" id="email" name="email"><br><br>

    <button type="submit" name="submit">Изпрати</button>
</form>

</body>
</html>
