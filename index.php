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

// list($y,$m,$d)=explode('-$date);
// if(checkdate($m,$d,$y)){...}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
<form action="bookingManager.php" method="POST">
      <h1>Reservez une chambre dans un de nous hotels</h1>
      <select name="hotels" id="">
        <option value="hotel1">hotel1</option>
        <option value="hotel2">hotel1</option>
        <option value="hotel3">hotel1</option>
        <option value="hotel4">hotel1</option>
        <option value="hotel5">hotel1</option>
        <option value="hotel6">hotel1</option>
        <option value="hotel7">hotel1</option>
        <option value="hotel8">hotel1</option>
        <option value="hotel9">hotel1</option>
      </select>
      <select name="chambres" id="">
        <option value="chambre">1 chambre</option>
        <option value="chambre">2 chambre</option>
        <option value="chambre">3 chambre</option>
      </select>
      <p>
        <label for="client_name">client name</label>
        <input type="text" name="client_name" />
      </p>
      <p>
        <label for="client_email">client email</label>
        <input type="email" name="client_email" />
      </p>
      <label for="confirm">confirm</label>
      <input type="submit" name="confirm" value="confirm">
    </form>
</body>

</html>