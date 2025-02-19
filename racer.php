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

    if (count($results) > 0) {
        echo "<table border='2'>
        <tr>
            <td>Име</td>
            <td>Имейл</td>
            <td>Време</td>
            <td>Дата</td>
            </td>";

        foreach ($results as $result) {
            echo "<tr>
            <td>" . $result["name"] . "</td>
            <td>" . $result["email"] . "</td>
            <td>" . $result["lap_id"] . "</td>
            <td>" . $result["date"] . "</td>
              </tr>";
        }
    }
}
    getRacer();

