<?php

function getLapTimesByRacerId($id)
{
    /** @var PDO $pdo  */
    $pdo = require "db.php";

    $sql = "
    SELECT lap_times.lap_time as lap_id, lap_times.date as date
    FROM lap_times
    WHERE lap_times.racer_id = :id
";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll();
}

function getRacer($id)
{
    /** @var PDO $pdo */
    $pdo = require "db.php";

    $sql = "
    SELECT * 
    FROM racers
    WHERE racers.id = :id
";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch();
}

$racer = getRacer($_GET['id']);
$racerLapTimes = getLapTimesByRacerId($_GET['id']);
$racerName = $racer['name'];

if (count($racerLapTimes) > 0) { ?>

    <html>
    <head>
        <meta charset="UTF-8">
        <meta charset="viewport" content="width=device-width, initial-scale=1.0">
        <title>Състезател <?php echo $racerName; ?></title>
    </head>
    <body>
    <h1>Резултати за <?php echo $racerName; ?></h1>

    <table border='2'>
        <tr>
            <td>Време</td>
            <td>Дата</td>
        </tr>

        <?php foreach ($racerLapTimes as $result) { ?>

            <tr>
                <td><?php echo $result["lap_id"] ?></td>
                <td><?php echo $result["date"] ?></td>
            </tr>
        <?php } ?>


    </table>
    </body>
    </html>
<?php }

