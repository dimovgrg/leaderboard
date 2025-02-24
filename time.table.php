<?php

/** @var PDO $pdo */
$pdo = require "db.php";

$sql = "SELECT lap_times.id as lap_time_id, lap_times.racer_id as racer_id, lap_times.lap_time as lap_time, lap_times.date as date, name
        FROM lap_times
        LEFT JOIN leaderboard.racers r on r.id = lap_times.racer_id
        ORDER BY lap_time asc";
$stmt = $pdo->prepare($sql);

$stmt->execute();

$results = $stmt->fetchAll();

if (count($results) > 0) { ?>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta charset="viewport" content="width=device-width, initial-scale=1.0">
        <title>Списък с времена</title>
    </head>
    <body>
    <table border='2'>
        <tr>
            <th>Ранк</th>
            <th>Име</th>
            <th>Време</th>
            <th>Дата</th>
        </tr>

        <?php foreach ($results as $index => $result) { ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $result['name'] ?></td>
                <td><?php echo $result['lap_time'] ?></td>
                <td><?php echo $result['date'] ?></td>
                <td><a href='delete.the.time.php?id=<?php echo $result['lap_time_id']; ?>'>Delete</a></td>
            </tr>
        <?php } ?>

    </table>
    </body>
    </html>
<?php } else {
    echo "0 results";
}
