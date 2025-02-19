<?php

$pdo = require 'db.php';

$sql = "SELECT r.name, MIN(l.lap_time) AS best_lap_time 
        FROM racers r
        JOIN lap_times l ON r.id = l.racer_id
        GROUP BY r.id
        ORDER BY best_lap_time ASC
        LIMIT 10";

$stmt = $pdo->prepare($sql);

$stmt->execute();
$racers = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getRacers(): ?array
{
    /** @var PDO $pdo */
    $pdo = require 'db.php';

    $sql = "SELECT * FROM racers;";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute();
    } catch (\Exception) {
        return null;
    }

    return $stmt->fetchAll();
}
?>


<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Състезатели</title>
</head>
<body>

<h1>VARNA HARD ENDURO CHAMPIONSHIP</h1>
<h2>23.05.2025 - 08:00АМ</h2>
<h2><a href="https://maps.app.goo.gl/WMLvjBddcnJi1w5o8">Начало/Финал</a></h2>
<h2><a href="https://maps.app.goo.gl/xwELMXn4gxt6VwhP6">Междинна точка</a></h2>
<h2>Регистрирай се за тура, <a href="create.php">тук</a>!</h2>
<h2>Запиши новито си време, <a href="lap.time.php">тук</a>!</h2>
<h2><a href="racers.php">Всички състезатели</a></h2>
<h2><a href="time.table.php">Списък с всички времена</a></h2>

<h4>Изтриване на вече регистриран състезател!</h4>

<form method="POST" action="/delete.php">
    <label for="racer-input">Избери състезател:</label>
    <select id="racer-input" name="racer">
        <option value="">Моля изберете:</option>
        <?php foreach (getRacers() as $racer) { ?>
            <option value="<?php echo $racer['id']; ?>">
                <?php echo $racer['name']; ?> - <?php echo $racer['email']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit" name="submit">Изтрий</button>
</form>

<h4>Изтриване на записани времена на даден състезател:</h4>

<form method="POST" action="/delete.time.php">
    <label for="racer-input">Избери състезател:</label>
    <select id="racer-input" name="racer">
        <option value="">Моля изберете:</option>
        <?php foreach (getRacers() as $racer) { ?>
            <option value="<?php echo $racer['id']; ?>">
                <?php echo $racer['name']; ?> - <?php echo $racer['email']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit" name="submit">Изтрий</button>
</form>

<?php
if ($racers) { ?>
    <table border='3'>
        <tr>
            <th>Място</th>
            <th>Име на състезателя</th>
            <th>Най-добро време</th>
        </tr>
        <?php foreach ($racers as $index => $racer) { ?>
            <tr style="text-align: center;">
                <td style="border: 1px solid #ddd;"><?php echo $index + 1; ?></td>
                <td style="border: 1px solid #ddd;"><?php echo $racer['name']; ?> </td>
                <td style="border: 1px solid #ddd;"><?php echo $racer['best_lap_time']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
} else {
    echo "Няма състезатели в базата данни.";
}


?>

</body>
</html>

