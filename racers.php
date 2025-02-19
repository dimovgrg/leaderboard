<?php

/** @var PDO $pdo */
$pdo = require "db.php";

$sql = "
    SELECT * FROM racers
    ";

if (!empty($_GET['search'])) {
    $sql = "
    SELECT * FROM racers WHERE name LIKE :name
    ";
}

$stmt = $pdo->prepare($sql);

$params = null;

if (!empty($_GET['search'])) {
    $params = ['name' => '%' . $_GET['search'] . '%'];
}

$stmt->execute($params);

$results = $stmt->fetchAll();

if (count($results) > 0) { ?>

    <form action="">
        <input type="text" id="search" name="search" placeholder="Търси по име..">
        <button type="submit" name="submit">Търси!</button>
    </form>

    <table border='2'>
        <tr>
            <th>Състезатели</th>
        </tr>

        <?php foreach ($results as $result) { ?>
            <tr>
                <td><a href='racer.php?id= <?php echo $result['id'] ?>'> <?php echo $result['name']; ?></a></td>
            </tr>

        <?php } ?>

    </table>
<?php } else {
    echo "0 results";
} ?>



