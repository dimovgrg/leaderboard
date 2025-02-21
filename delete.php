<?php

function deleteRacer(string $id): void
{
    /** @var PDO $pdo */
    $pdo = require 'db.php';

    $sql = "DELETE FROM `lap_times` WHERE `racer_id` = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $id]);

    $sql = "DELETE FROM racers WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $id]);
}


if (isset($_POST['submit'])) {
    if (!$_POST['racer']) {
        die('Моля, въведете състезател.');
    }

    deleteRacer($_POST['racer']);

    echo 'Успешно изтрихте избрания състезател.';
}
