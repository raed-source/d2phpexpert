<?php
require('../bookingManager.php');

$id = $_REQUEST['id'];
echo $id;


if (isset($_POST['supprimer'])) {
    $dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
    $bookingManager = new BookingManager($dbh);
    $sql = 'DELETE FROM booking WHERE booking_id="' . $id . '"';
    $stmt = $dbh->prepare($sql);
    if ($stmt->execute()) {
        echo 'supprission éffectué';
    } else {
        echo 'probleme de connexion!';
    }
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
    modif
</body>

</html>