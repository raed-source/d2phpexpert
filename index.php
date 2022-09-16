<?php
require('bookingManager.php');
require('booking.php');
?>
<?php


if (isset($_POST['submitBooking'])) {
    echo 'submit</br>';
    if (
        !empty($_POST['hotels'])
        and !empty($_POST['rooms'])
        and !empty($_POST['client_name'])
        and !empty($_POST['client_mail'])
        and !empty($_POST['checkin'])
        and !empty($_POST['checkout'])
        // and !empty($_POST['submitConsulte'])
        // and !empty($_POST['hotels'])
    ) {
        echo 'not empty</br>';
        $hotel_name = $_POST['hotels'];
        $rooms_number = $_POST['rooms'];
        $client_name = $_POST['client_name'];
        $client_mail = $_POST['client_mail'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
    }
}
//  $booking_data = array('hotel_name'=>$hotel_name, $rooms_number, $client_name, $client_mail, $checkin, $checkout);

// print_r($booking_data);

// $booking_data = array('booking_id' =>0 , 'hotel_name' => 'hotel1', 'rooms_number' => 1, 'client_name' => 'raed', 'client_mail' => 'raed.abbas@hotmail.fr', 'checkin' => '2022-09-01', 'checkout' => '2022-09-02');

// --------------------CREER UN ARRAY NECESSAIR POUR L'OBJET BOOKING---------------------------------
$booking_data = array('booking_id' => 0, 'hotel_name' => $hotel_name, 'rooms_number' => $rooms_number, 'client_name' => $client_name, 'client_mail' => $client_mail, 'checkin' => $checkin, 'checkout' => $checkout);
// -------------------CREATION D'OBJET BOOKING-------------------
$booking = new Booking($booking_data);
if (isset($booking)) {
    echo $booking->getHotelName() . '<br>';
    // var_dump($booking);
    $dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
    // if (isset($dbh)) echo 'connecté à la base booking_db</br>';
    // ------------CREATION D'OBJET BOOKINGMANAGER
    $bookingManager = new BookingManager($dbh);
    print_r($bookingManager);
    $bookingManager->addBooking($booking);
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
        <h1>Reservez une chambre dans un de nos hotels</h1>
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
        <select name="rooms" id="">
            <option value="1 chambre">1 chambre</option>
            <option value="2 chambre">2 chambre</option>
            <option value="3 chambre">3 chambre</option>
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