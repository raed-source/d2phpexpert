<?php
require('../bookingManager.php');
require('../classes/booking.php');
$id = $_REQUEST['id'];
echo $id;


if (isset($_POST['supprimer'])) {
    $dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
    $bookingManager = new BookingManager($dbh);
    $sql = 'SELECT * FROM booking WHERE booking_id="' . $id . '"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    $booking = new Booking($res[0]);
    if ($bookingManager->deleteBooking($booking->getBooking_id())) {
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