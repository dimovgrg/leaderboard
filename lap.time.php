<?php
function createLapTime(string $racer_id, string $lap_time): bool
{
    $pdo = require 'db.php';

    $sql = "INSERT INTO lap_times (racer_id, lap_time, date)
                VALUES (:racer_id, :lap_time, :date)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            'racer_id' => $racer_id,
            'lap_time' => $lap_time,
            'date' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
        ]);
    } catch (\Exception) {
        return false;
    }

    return true;
}

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

if (isset($_POST['submit'])) {
    if (!$_POST['racer']) {
        die('Моля, изберете съзтезател.');
    }
    if (!$_POST['time']) {
        die('Моля, въведете време..');
    }

    $created = createLapTime($_POST['racer'], $_POST['time']);

    if ($created) {
        echo 'Успешно създадохме време.';
    } else {
        echo 'Възникна грешка. Опитайте пак.';
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавяне на ново време</title>
</head>
<body>
<h2>Добавяне на ново време!</h2>

<form method="POST" action="lap.time.php">
    <label for="racer">Имена:</label>
    <select id="racer" name="racer">
        <option value="">Моля изберете:</option>
        <?php foreach (getRacers() as $racer) { ?>
            <option value="<?php echo $racer['id']; ?>">
                <?php echo $racer['name']; ?> - <?php echo $racer['email']; ?>
            </option>
        <?php } ?>
    </select>

    <label for="time">Време:</label>
    <input type="time" id="time" name="time" step="2" required><br><br>

    <button type="submit" name="submit">Изпрати</button>
</form>

</body>
</html>
