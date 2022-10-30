<?php
require('../bookingManager.php');
require('../classes/booking.php');
require('../classes/client.php');
?>
<?php
$rooms = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
$room_dispo = array(0);
if (isset($_GET['id']))
    $id = $_GET['id'];
echo '<h2> Bienvenue à L\'' . $id . '</h2>';
// -------$id SERT LE NOM DE L'HOTEL OU ON RESERVE LA CHAMBRE
// -------AFFICHER LES CHAMBRE DISPONIBLE DANS CET HOTEL
$dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
$bookingManager = new BookingManager($dbh);
//------------VERIFICATION DE L'ETAT DE LA BASE--------

if (isset($_POST['submitBooking'])) {
    if (
        // !empty($_POST['hotel'])
        // !empty($_POST['room'])
        !empty($_POST['client_name'])
        and !empty($_POST['client_mail'])
        and !empty($_POST['checkin'])
        and !empty($_POST['checkout'])
    ) {
        $hotel_name = $id;
        echo $hotel_name;
        $client_name = $_POST['client_name'];
        $client_mail = $_POST['client_mail'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
    }
    // ----------------------CREER UN ARRAY NECESSAIR POUR L'OBJET BOOKING---------------------------------
    $booking_data = array('client_name' => $client_name, 'client_mail' => $client_mail, 'hotel_name' => $hotel_name, 'room_number' => '', 'checkin' => $checkin, 'checkout' => $checkout);
    // -------------------CREATION D'OBJET BOOKING-------------------
    $booking = new Booking($booking_data);
    $client = new Client($booking_data);


    // -----------------------VERFIER LE NOMBRE DE CHAMBRES RESERVEES A CETTE DATE ET MEME HOTEL ---------
    $sql = 'SELECT * FROM booking WHERE checkin>= "' . $booking->getCheckin() . '" AND checkout<="' . $booking->getCheckout() . '" AND hotel_name="' . $booking->getHotelName() . '"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    // -----------------------DEBUGUE DE LA REQUETE-----------
    // var_dump($stmt->debugDumpParams());
    $count = $stmt->rowCount();
    echo '<h1>Le nombre de chambre réservées :' . $count . '</h1>';
    // --------------------LES CHAMBRES SONT EPUISEES---
    if ($count >= 20) {
        header("Location: error.php");
        exit;
    } else {
        // ----------------------POUR TROUVER LA CHAMBRE RESERVEES---------------------
        $sql = 'SELECT * FROM booking WHERE checkin>= "' . $booking->getCheckin() . '" AND checkout<="' . $booking->getCheckout() . '" AND hotel_name="' . $booking->getHotelName() . '"';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $res[] = intval($row['room_number']);
        }
        if ($res === null) {
            $res[] = array(0);
            $room_dispo[0] = 1;
            $booking->setRoomNumber($room_dispo[0]);
            var_dump($booking);
            $bookingManager->addBooking($booking);
            $bookingManager->addClient($booking);
            $dbh = null;
            header("Location: merci.php");
            exit;
        } else {
            $room_dispo = array_diff($rooms, $res);
            $booking->setRoomNumber($room_dispo[0]);

            $bookingManager->addBooking($booking);
            $bookingManager->addClient($booking);
            $dbh = null;
            header("Location: merci.php");
            exit;
        }
    }
}

function verify()
{
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
    <?php
    ?>
    <form action="" method="POST">
        <h1>Reservez une chambre dans un de nos hotel</h1>
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
        <form action="./consulte.php" method="post">
            <p>Consultez votre reservation</p>
            <p>
                <label for="consulter">saisissez votre mail</label>
                <input type="email" name="email">
                <input type="submit" name="consulte" value="consulter">
            </p>

        </form>
</body>

</html>