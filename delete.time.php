<?php

function deleteRacerTime(string $id): void
{
    /** @var PDO $pdo */
    $pdo = require 'db.php';

    $sql = "DELETE FROM `lap_times` WHERE `racer_id` = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $id]);

}


if (isset($_POST['submit'])) {
    if (!$_POST['racer']) {
        die('Моля, въведете състезател.');
    }

    deleteRacerTime($_POST['racer']);

    echo 'Успешно изтрихте времената на избрания състезателя.';
}

