<?php
// require('booking.php');
echo ('Bienvenue<br/>');

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
        $sql = 'INSERT INTO booking (hotel_name, client_name, rooms_number, client_mail,checkin,checkout)VALUES(:hotel_name, :client_name,:rooms_number, :client_mail,:checkin,:checkout) ';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':hotel_name', htmlspecialchars($booking->getHotelName()));
        $stmt->bindValue(':client_name', htmlspecialchars($booking->getClientName()));
        $stmt->bindValue(':rooms_number', htmlspecialchars($booking->getRoomsNumber()));
        $stmt->bindValue(':client_mail', htmlspecialchars($booking->getClientMail()));
        $stmt->bindValue(':checkin', $booking->getCheckin());
        $stmt->bindValue(':checkout', $booking->getCheckout());


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
            $stmt->bindParam(':client_email', $booking->getClientMail());
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
