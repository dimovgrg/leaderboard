<?php

function deleteRacer(string $id): void
{
    /** @var PDO $pdo */
    $pdo = require 'db.php';

    // Delete lap times first to avoid constraints errors and garbage in DB
    $sql = "DELETE FROM `lap_times` WHERE `racer_id` = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $id]);

    // now after times are deleted, we can delete the user
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
