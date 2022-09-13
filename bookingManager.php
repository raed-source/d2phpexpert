<?php
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
    public function addBooking(Booking $booking)
    {
        $sql = 'INSERT INTO booking (hotel_name, client_email,checkin,checkout)VALUES(:hote_lname, :client_email,:checkin,;checkout) ';
        $stmt = $this->_db->prepar($sql);
        $stmt->bindParam(':hotel_name', htmlspecialchars($booking->getBooking));
        $stmt->BindParam(':checkin', $booking->getCheckin());
        $stmt->execute();
    }
}

$booking_data = array('booking_id' => 1, 'hotel_name' => 'ibiz', 'client_email' => 'raed.a@hotmail.com', 'checkin' => 01 - 02 - 2022, 'checkout' => 02 - 02 - 2022);
$booking = new Booking($booking_data);
$db = new PDO('mysql:host=localhost;dbname=bookingdb', 'root', '');
// la foncion addManager prend en param l'objet $booking et les details seront saisies par l'utilisateur;
$bookingManager = new BookingManager($db);
$bookingManager->addBooking($booking);
