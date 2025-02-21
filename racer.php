<?php

function getRacer()
{
    /** @var $PDO $sql */
    $pdo = require "db.php";

    $id = intval($_GET["id"]);

    $sql = "
    SELECT lap_times.lap_time as lap_id, lap_times.date as date, name as name, email as email 
    FROM lap_times
    LEFT JOIN leaderboard.racers r
    ON r.id = lap_times.racer_id
    WHERE r.id = :id
";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->fetchAll();
    $racerName = $results[0] ? $results[0]["name"] : " ";
        // Ако няма резултат $results[0] , : да даде като грешка " "

    if (count($results) > 0) { ?>

        <html>
        <head>
            <meta charset="UTF-8">
            <meta charset="viewport" content="width=device-width, initial-scale=1.0">
            <title>Състезател <?php echo $racerName; ?></title>
        </head>
        <body>

        <table border='2'>
            <tr>
                <td>Име</td>
                <td>Имейл</td>
                <td>Време</td>
                <td>Дата</td>
            </tr>

            <?php foreach ($results as $result) { ?>

                <tr>
                    <td><?php echo $result["name"] ?></td>
                    <td><?php echo $result["email"] ?></td>
                    <td><?php echo $result["lap_id"] ?></td>
                    <td><?php echo $result["date"] ?></td>
                </tr>
            <?php } ?>


        </table>
        </body>
        </html>
    <?php }
}

getRacer(); ?>

