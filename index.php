<?php
require('bookingManager.php');
require('booking.php');
?>
<?php


if (isset($_POST['submitBooking'])) {
    if (
        !empty($_POST['hotel'])
        and !empty($_POST['room'])
        and !empty($_POST['client_name'])
        and !empty($_POST['client_mail'])
        and !empty($_POST['checkin'])
        and !empty($_POST['checkout'])
    ) {
        $hotel_name = $_POST['hotel'];
        $room_number = $_POST['room'];
        $client_name = $_POST['client_name'];
        $client_mail = $_POST['client_mail'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
    }
    // --------------------CREER UN ARRAY NECESSAIR POUR L'OBJET BOOKING---------------------------------
    $booking_data = array('client_name' => $client_name, 'client_mail' => $client_mail, 'hotel_name' => $hotel_name, 'room_number' => $room_number,   'checkin' => $checkin, 'checkout' => $checkout);

    // -------------------CREATION D'OBJET BOOKING-------------------
    $booking = new Booking($booking_data);

    $dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');


    // ------------CREATION D'OBJET BOOKINGMANAGER
    $bookingManager = new BookingManager($dbh);
    // ------------VERIFICATION DE L'ETAT DE LA BASE--------
    $sql = 'SELECT * FROM booking_manager';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $res[] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    foreach ($res as $list) {
        if (
            $list['hotel_name'] == $booking->getHotelName()
            and $list['room_number'] == $booking->getRoomNumber()
            and $list['checkout'] >= $booking->getCheckin()
        ) {
            header("Location: error.php");
            exit;
        } else {
            $bookingManager->addBooking($booking);
            $bookingManager->addClient($booking);
        }
    }
    $dbh = null;
    header("Location: merci.php");
    exit;
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="POST">
        <h1>Reservez une chambre dans un de nos hotel</h1>
        <select name="hotel" id="">
            <option value="null"></option>
            <option value="hotel1">hotel1</option>
            <option value="hotel2">hotel2</option>
            <option value="hotel3">hotel3</option>
            <option value="hotel4">hotel4</option>
            <option value="hotel5">hotel5</option>
            <option value="hotel6">hotel6</option>

        </select>
        <select name="room" id="">
            <option value=""></option>
            <option value="1">1 chambre</option>
            <option value="2">2 chambre</option>
            <option value="3">3 chambre</option>
            <option value="4">4 chambre</option>
            <option value="5">5 chambre</option>
            <option value="6">6 chambre</option>
        </select>
        <p>
            <label for="client_name">client name</label>
            <input type="text" name="client_name" />
        </p>
        <p>
            <label for="client_mail">client mail</label>
            <input type="email" name="client_mail" />
        </p>
        <p>
            <label for="checkin">Date arrivé:</label>
            <input type="date" name="checkin">
        </p>
        <p>
            <label for="checkout">Date départ:</label>
            <input type="date" name="checkout">
        </p>
        <label for="confirm">confirm</label>
        <input type="submit" name="submitBooking" value="confirm">
    </form>
    <div class="affich">
        <form action="bookingManager.php" method="post">
            <p>Consultez votre reservation</p>
            <p>
                <label for="consulter">saisissez votre mail</label>
                <input type="email" name="email">
                <input type="submit" name="submitConsulte" value="consultez">
            </p>
        </form>

    </div>


</body>

</html>