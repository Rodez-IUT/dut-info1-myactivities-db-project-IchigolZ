<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

<?php

$host = 'localhost';
$port = '3306'; // 3306 ?
$db = 'my_activities';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo $e->getMessage() ;
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

?>

<h1>All Users</h1>

<?php

$status_id = "Active Account";

$debut_user = "e%";

$stmt = $pdo->query("SELECT users.id AS user_id, username, email, s.name AS status 
                     FROM users 
                     JOIN status s ON users.status_id = s.id
                     WHERE name='$status_id' 
                     AND username LIKE '$debut_user'");
?>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $stmt->fetch()) { ?>
    <tr>
        <td><?php echo $row['user_id']?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['status']?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>