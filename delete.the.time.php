<?php

function deleteRacerTime(string $id): void
{
    /** @var PDO $pdo */
    $pdo = require 'db.php';

    $sql = "DELETE FROM `lap_times` WHERE `id` = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $id]);

}


if (isset($_GET['id'])) {
    deleteRacerTime($_GET['id']);

    echo 'Успешно изтрихте времената на избрания състезателя.';
}

