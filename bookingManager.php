<?php

$hotel_name = $_POST['hotel_name'];
$client_name = $_POST['client_name'];
$client_email = $_POST['client_email'];
$submitBooking = $_POST['submitBooking'];
$submitConsulte = $_POST['submitConsulte'];
$chambres = $_POST['chambres'];
$hotels = $_POST['hotels'];
class BookingManager
{
    private $_db;
    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $dbh)
    {
        $this->_db = $dbh;
    }
    // -------------CREATION-----------------------
    public function addBooking(Booking $booking)
    {
        $sql = 'INSERT INTO booking (hotel_name, client_email,checkin,checkout)VALUES(:hotel_name, :client_email,:checkin,;checkout) ';
        $stmt = $this->_db->prepar($sql);
        $stmt->bindParam(':hotel_name', htmlspecialchars($booking->getBooking));
        $stmt->BindParam(':checkin', $booking->getCheckin());
        $stmt->execute();
    }
    //--------------------RECUPERER------------------------
    public function getBooking($booking)
    {
        if (empty($booking)) {
            $sql = 'SELECT * FROM booking';
            $stmt = $this->_db->prepare($sql);
        } else {
            $sql = 'SELECT * FROM booking WHERE booking_id=>:booking_id';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':booking_id', $booking->getBooking_id());
            $stmt->execute();
        }
    }
    //--------------------MODIFIER-------------------------
    public function updateBooking(Booking $booking)
    {
        if (!empty($booking)) {
            $sql = 'UPDATE booking SET hotel_name=:hotel_name, client_email=:client_email, checkin=:checkin, checkout=:checkout';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':hotel_name', $booking->getHotelName());
            $stmt->bindParam(':client_email', $booking->getClientEmail());
            $stmt->bindParam(':checkin', $booking->getCheckin());
            $stmt->bindParam(':checkout', $booking->getCheckout());
            $stmt->execute();
        }
    }
    //----------------------SUPPRIMER-------------------------
    public function deleteBooking(Booking $booking)
    {
        if (!empty($booking)) {
            $sql = 'DELETE FROM booking WHERE booking_id=:booking_id';
            $stmt = $this->_db->prapare($sql);
            $stmt->bindParam(':booking_id', $booking->getBooking_id());
            $stmt->execute();
            $count = $stmt->rowCount();
            return $count;
        }
    }
}

$booking_data = array('hotel_name' => $hotel_name, 'client_email' => $client_name, 'checkin' => $checkin, 'checkout' => $checkout);
$booking = new Booking($booking_data);
$dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');

// la foncion addManager prend en param l'objet $booking et les details seront saisies par l'utilisateur;
$bookingManager = new BookingManager($db);
$bookingManager->addBooking($booking);
