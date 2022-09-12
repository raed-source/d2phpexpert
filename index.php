<?php
$dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
$stmt = $dbh->prepare('SELECT * FROM booking');
// $var=var;
// $stmt=$dbh->prepare('SELECT VAR FROM dbname
// where var=:var');
// $stmt->bindParam('var':$var); ensuite l'execution
$stmt->execute();
while ($row = $stmt->fetch()) {
    print_r($row);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>