<?php
require('../bookingManager.php');
require('../classes/booking.php');
if (isset($_POST['consulte'])) {
    $email = $_POST['email'];
    $dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
    $bookingManager = new BookingManager($dbh);
    $sql = 'SELECT * FROM booking WHERE client_mail= "' . $email . '" ';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // var_dump($stmt->debugDumpParams());
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    if (!$res) {
        header("Location: ./index.php");
    }
} else {
    if (empty($email)) header("Location: ./index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Consulte</title>
</head>

<body>
    <h2>Les détais de votre réservation: </h2>

    <?php foreach ($res as $obj) : ?>
        <?php $booking = new Booking($obj); ?>
        <form class="consulte" action="../pages/modifier.php?id=<?php echo $booking->getBooking_id() ?>" method="POST">
            <p>Numéro réservation: <a href="../pages/consulte.php?id=<?php echo $booking->getBooking_id() ?>"><?php echo $booking->getBooking_id() ?>modifier</a> </p>
            <p>Name: <input type="text" name="clientName" placeholder="<?php echo $booking->getClientName(); ?> "></p>
            <p>Adresse mail: <input type="text" name="clientMail" placeholder="<?php echo $booking->getClientMail(); ?>" </p>
            <p>Hotel:<input type="text" name="hotelName" placeholder="<?php echo $booking->getHotelName(); ?>" </p>
            <p>Chambre: <input type="" text" name="roomNumber" placeholder="<?php echo $booking->getRoomNumber(); ?>"></p>
            <p>Date d'arriver: <input type="text" name="checkIn" placeholder="<?php echo $booking->getCheckin(); ?>"> </p>
            <p>Date départ: <input type="text" name="checkOut" placeholder="<?php echo $booking->getCheckout(); ?>"></p>
            <button class="btn" type="submit" name="modify">modifier</button>
            <button class="btn" type="submit" name="supprimer">Supprimer</button>
            <div class="list">
                <?php echo $booking->getClientName(); ?>
                <?php echo $booking->getClientMail(); ?>
                <?php echo $booking->getHotelName(); ?>
                <?php echo $booking->getRoomNumber(); ?>
                <?php echo $booking->getCheckin(); ?>
                <?php echo $booking->getCheckout(); ?>
            </div>
        </form>
    <?php endforeach; ?>



    </div>

</body>

</html>